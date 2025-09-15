<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->visible(fn () => $this->record->status === 'cancelled'), // Only allow deletion of cancelled orders
        ];
    }

    protected function beforeSave(): void
    {
        $originalStatus = $this->record->getOriginal('status');
        $newStatus = $this->data['status'];
        
        // Auto-fill timestamps when status changes
        if ($originalStatus !== $newStatus) {
            if ($newStatus === 'shipped' && !$this->record->shipped_date) {
                $this->data['shipped_date'] = now();
            }
            
            if ($newStatus === 'delivered') {
                if (!$this->record->delivered_date) {
                    $this->data['delivered_date'] = now();
                }
                if (!$this->record->shipped_date) {
                    $this->data['shipped_date'] = now();
                }
            }
        }
    }

    protected function afterSave(): void
    {
        $originalStatus = $this->record->getOriginal('status');
        $newStatus = $this->record->status;
        
        if ($originalStatus !== $newStatus) {
            Notification::make()
                ->title('Order Status Updated')
                ->body("Order {$this->record->order_number} status changed from {$originalStatus} to {$newStatus}")
                ->success()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}