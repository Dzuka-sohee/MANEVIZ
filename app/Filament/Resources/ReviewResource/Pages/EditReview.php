<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditReview extends EditRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),

            Actions\Action::make('toggle_verified')
                ->label(fn () => $this->record->is_verified ? 'Mark as Unverified' : 'Mark as Verified')
                ->icon(fn () => $this->record->is_verified ? 'heroicon-o-x-mark' : 'heroicon-o-check-badge')
                ->color(fn () => $this->record->is_verified ? 'danger' : 'success')
                ->action(function () {
                    $this->record->update([
                        'is_verified' => !$this->record->is_verified
                    ]);
                    
                    $this->refreshFormData([
                        'is_verified',
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Review updated')
                        ->body($this->record->is_verified ? 'Review marked as verified.' : 'Review marked as unverified.')
                        ->send();
                })
                ->requiresConfirmation()
                ->modalDescription(fn () => 
                    $this->record->is_verified 
                        ? 'Are you sure you want to mark this review as unverified?' 
                        : 'Are you sure you want to mark this review as verified?'
                ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Review updated')
            ->body('The review has been updated successfully.');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure images is properly formatted
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = array_values(array_filter($data['images']));
            if (empty($data['images'])) {
                $data['images'] = null;
            }
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // You can add any additional logic here after updating a review
        // For example, updating product ratings, sending notifications, etc.
    }
}