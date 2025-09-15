<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateReview extends CreateRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Review created')
            ->body('The review has been created successfully.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function afterCreate(): void
    {
        // You can add any additional logic here after creating a review
        // For example, sending notifications, updating product ratings, etc.
    }
}