<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPledge extends EditRecord
{
    protected static string $resource = PledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('මකන්න')
                ->successNotification(
                    Notification::make()
                        ->danger()
                        ->title('පොරොන්දුව මකා දමන ලදී')
                        ->body('පොරොන්දුව සාර්ථකව ඉවත් කරන ලදී.')
                ),
        ];
    }

    /**
     * Load existing pivot data into the Repeater field when the form opens.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['pledge_items'] = $this->record
            ->items()
            ->withPivot('pledged_quantity')
            ->get()
            ->map(fn ($item) => [
                'item_id'          => $item->id,
                'pledged_quantity'  => $item->pivot->pledged_quantity,
            ])
            ->toArray();

        return $data;
    }

    /**
     * Save pivot data manually — sync the pledge_items pivot table.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // We handle pivot saving in afterSave(), just strip the key from $data
        // so Eloquent doesn't try to save it as a column.
        $this->pledgeItemsToSync = $data['pledge_items'] ?? [];
        unset($data['pledge_items']);
        return $data;
    }

    protected array $pledgeItemsToSync = [];

    protected function afterSave(): void
    {
        // Build sync array: [item_id => ['pledged_quantity' => ...]]
        $syncData = [];
        foreach ($this->pledgeItemsToSync as $row) {
            $itemId = $row['item_id'] ?? null;
            if ($itemId) {
                $syncData[$itemId] = [
                    'pledged_quantity' => isset($row['pledged_quantity']) && $row['pledged_quantity'] !== ''
                        ? (float) $row['pledged_quantity']
                        : null,
                ];
            }
        }

        // sync() removes old pivot rows and inserts/updates new ones
        $this->record->items()->sync($syncData);

        // Touch updated_at so the pledge appears at the top of "newest" sort
        $this->record->touch();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('පොරොන්දුව යාවත්කාලීන විය')
            ->body('පොරොන්දු විස්තර සාර්ථකව යාවත්කාලීන කරන ලදී.')
            ->duration(4000);
    }
}
