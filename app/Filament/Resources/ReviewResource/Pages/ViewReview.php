<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReview extends ViewRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
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
                })
                ->requiresConfirmation()
                ->modalDescription(fn () => 
                    $this->record->is_verified 
                        ? 'Are you sure you want to mark this review as unverified?' 
                        : 'Are you sure you want to mark this review as verified?'
                ),

            Actions\Action::make('view_product')
                ->label('View Product')
                ->icon('heroicon-o-eye')
                ->url(fn () => route('products.show', $this->record->product->slug ?? '#'))
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->product && isset($this->record->product->slug)),

            Actions\Action::make('view_order')
                ->label('View Order')
                ->icon('heroicon-o-document-text')
                ->url(fn () => '/admin/orders/' . $this->record->order->id)
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->order),
        ];
    }
}