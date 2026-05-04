<?php

namespace App\Console\Commands;

use App\Models\Pledge;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeDuplicatePledges extends Command
{
    protected $signature   = 'pledges:merge-duplicates {--dry-run : Show what would be merged without making changes}';
    protected $description = 'Merge duplicate pledges — matches by name+mobile, name+address, or name-only';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY RUN mode — no changes will be made.');
        }

        // Load all pledges once
        $all = Pledge::with('items')->get();

        // ── Group by name + mobile (most specific) ────────────────────────
        $mobileGroups = $all
            ->filter(fn ($p) => filled($p->donor_mobile))
            ->groupBy(fn ($p) => strtolower(trim($p->donor_name)) . '|' . trim($p->donor_mobile))
            ->filter(fn ($g) => $g->count() > 1);

        // IDs already handled by mobile match — exclude from further checks
        $handledIds = $mobileGroups->flatten()->pluck('id')->toArray();

        // ── Group by name + address (no mobile) ───────────────────────────
        $addressGroups = $all
            ->filter(fn ($p) => !in_array($p->id, $handledIds) && blank($p->donor_mobile) && filled($p->donor_address))
            ->groupBy(fn ($p) => strtolower(trim($p->donor_name)) . '|' . strtolower(trim($p->donor_address)))
            ->filter(fn ($g) => $g->count() > 1);

        $handledIds = array_merge($handledIds, $addressGroups->flatten()->pluck('id')->toArray());

        // ── Group by name only (no mobile, no address) ────────────────────
        $nameOnlyGroups = $all
            ->filter(fn ($p) => !in_array($p->id, $handledIds) && blank($p->donor_mobile) && blank($p->donor_address))
            ->groupBy(fn ($p) => strtolower(trim($p->donor_name)))
            ->filter(fn ($g) => $g->count() > 1);

        $allGroups = collect()
            ->merge($mobileGroups)
            ->merge($addressGroups)
            ->merge($nameOnlyGroups);

        if ($allGroups->isEmpty()) {
            $this->info('✅ No duplicate pledges found.');
            return 0;
        }

        $this->info("Found {$allGroups->count()} duplicate group(s):");
        $this->newLine();

        $mergedCount  = 0;
        $deletedCount = 0;

        foreach ($allGroups as $key => $group) {
            $sorted  = $group->sortBy('id');
            $primary = $sorted->first();
            $others  = $sorted->slice(1);

            $this->line("  👤 <fg=cyan>{$primary->donor_name}</> (ID: {$primary->id}) ← merging " . $others->count() . " duplicate(s)");

            foreach ($others as $duplicate) {
                $this->line("     ↳ Duplicate ID: {$duplicate->id}");

                $dupItems = $duplicate->items()->withPivot('pledged_quantity')->get();
                foreach ($dupItems as $item) {
                    $qty = $item->pivot->pledged_quantity ?? 'unknown';
                    $this->line("       + {$item->name}: {$qty} {$item->unit}");
                }

                if (!$dryRun) {
                    DB::transaction(function () use ($primary, $duplicate) {
                        foreach ($duplicate->items()->withPivot('pledged_quantity')->get() as $item) {
                            $existingInPrimary = $primary->items()->where('item_id', $item->id)->first();

                            if ($existingInPrimary) {
                                $existingQty  = (float) ($existingInPrimary->pivot->pledged_quantity ?? 0);
                                $duplicateQty = (float) ($item->pivot->pledged_quantity ?? 0);
                                $newQty       = ($existingQty + $duplicateQty) ?: null;
                                $primary->items()->updateExistingPivot($item->id, ['pledged_quantity' => $newQty]);
                            } else {
                                $primary->items()->attach($item->id, ['pledged_quantity' => $item->pivot->pledged_quantity]);
                            }
                        }

                        if (!$primary->donor_address && $duplicate->donor_address) {
                            $primary->update(['donor_address' => $duplicate->donor_address]);
                        }
                        if (!$primary->donor_mobile && $duplicate->donor_mobile) {
                            $primary->update(['donor_mobile' => $duplicate->donor_mobile]);
                        }

                        $duplicate->delete();
                    });

                    // Refresh primary for next iteration
                    $primary->load('items');
                }

                $deletedCount++;
            }

            if (!$dryRun) {
                $primary->touch();
            }

            $mergedCount++;
            $this->newLine();
        }

        if ($dryRun) {
            $this->warn("DRY RUN complete — {$mergedCount} group(s), {$deletedCount} duplicate(s) would be merged.");
        } else {
            $this->info("✅ Done — {$mergedCount} group(s) merged, {$deletedCount} duplicate pledge(s) removed.");
        }

        return 0;
    }
}
