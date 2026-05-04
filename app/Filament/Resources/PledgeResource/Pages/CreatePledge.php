<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use App\Models\Pledge;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePledge extends CreateRecord
{
    protected static string $resource = PledgeResource::class;

    /** Flag set when we merged into an existing pledge instead of creating a new one */
    protected bool $mergedIntoExisting = false;

    /**
     * Handle the record creation - merge with existing pledge if donor matches
     */
    protected function handleRecordCreation(array $data): Model
    {
        // Extract donor info and items
        $donorName    = $data['donor_name']    ?? null;
        $donorMobile  = $data['donor_mobile']  ?? null;
        $donorAddress = $data['donor_address'] ?? null;
        $items        = $data['pledge_items']  ?? [];

        // Try to find existing pledge with same donor details
        $existingPledge = null;
        
        if ($donorName && $donorMobile) {
            // Match by name AND mobile (most reliable)
            $existingPledge = Pledge::where('donor_name', $donorName)
                ->where('donor_mobile', $donorMobile)
                ->first();
        } elseif ($donorName && $donorAddress) {
            // Match by name AND address (if no mobile)
            $existingPledge = Pledge::where('donor_name', $donorName)
                ->where('donor_address', $donorAddress)
                ->whereNotNull('donor_address')
                ->where('donor_address', '!=', '')
                ->first();
        }

        if ($existingPledge) {
            // Merge items into existing pledge
            foreach ($items as $item) {
                $itemId = $item['item_id'] ?? null;
                $quantity = $item['pledged_quantity'] ?? null;
                
                if ($itemId) {
                    // Check if this item already exists in the pledge
                    $existingItem = $existingPledge->items()->where('item_id', $itemId)->first();
                    
                    if ($existingItem) {
                        // Update quantity (add to existing)
                        if ($quantity) {
                            $newQuantity = ($existingItem->pivot->pledged_quantity ?? 0) + $quantity;
                            $existingPledge->items()->updateExistingPivot($itemId, [
                                'pledged_quantity' => $newQuantity
                            ]);
                        }
                    } else {
                        // Add new item to existing pledge
                        $existingPledge->items()->attach($itemId, [
                            'pledged_quantity' => $quantity
                        ]);
                    }
                }
            }

            // Update address if it was empty before
            if (!$existingPledge->donor_address && $donorAddress) {
                $existingPledge->update(['donor_address' => $donorAddress]);
            }

            // Show notification about merge
            $this->mergedIntoExisting = true;
            Notification::make()
                ->success()
                ->title('භාණ්ඩ එකතු කරන ලදී ✓')
                ->body("දායකයා \"{$donorName}\" ගේ පවතින පොරොන්දුවට භාණ්ඩ එකතු කරන ලදී.")
                ->duration(5000)
                ->send();

            return $existingPledge;
        }

        // No existing pledge found - create new one
        $pledge = Pledge::create([
            'donor_name' => $donorName,
            'donor_mobile' => $donorMobile,
            'donor_address' => $donorAddress,
        ]);

        // Attach items
        foreach ($items as $item) {
            $itemId = $item['item_id'] ?? null;
            $quantity = $item['pledged_quantity'] ?? null;
            
            if ($itemId) {
                $pledge->items()->attach($itemId, [
                    'pledged_quantity' => $quantity
                ]);
            }
        }

        return $pledge;
    }

    // After save — stay on create page with donor details prefilled
    protected function getRedirectUrl(): string
    {
        $record = $this->record;
        return $this->getResource()::getUrl('create', [
            'donor_name'    => $record->donor_name,
            'donor_mobile'  => $record->donor_mobile,
            'donor_address' => $record->donor_address,
        ]);
    }

    // Prefill donor details from URL params
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['donor_name']    = request('donor_name',    $data['donor_name']    ?? '');
        $data['donor_mobile']  = request('donor_mobile',  $data['donor_mobile']  ?? '');
        $data['donor_address'] = request('donor_address', $data['donor_address'] ?? '');
        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        // When a merge happened, we already sent a custom notification in handleRecordCreation.
        // Detect merge by checking if the record already existed before this request.
        // We use a simple flag set during handleRecordCreation.
        if ($this->mergedIntoExisting ?? false) {
            return null; // suppress default notification
        }

        return Notification::make()
            ->success()
            ->title('පොරොන්දුව සුරකින ලදී ✓')
            ->body('දායකයාගේ නම prefill වී ඇත — තවත් භාණ්ඩයක් එකතු කළ හැකිය.')
            ->duration(5000);
    }
}
