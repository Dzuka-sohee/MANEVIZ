<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Reviews')
                ->badge(fn () => \App\Models\Review::count()),

            'verified' => Tab::make('Verified')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_verified', true))
                ->badge(fn () => \App\Models\Review::where('is_verified', true)->count()),

            'unverified' => Tab::make('Unverified')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_verified', false))
                ->badge(fn () => \App\Models\Review::where('is_verified', false)->count()),

            'high_rating' => Tab::make('High Rating (4-5 ⭐)')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('rating', [4, 5]))
                ->badge(fn () => \App\Models\Review::whereIn('rating', [4, 5])->count()),

            'low_rating' => Tab::make('Low Rating (1-2 ⭐)')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('rating', [1, 2]))
                ->badge(fn () => \App\Models\Review::whereIn('rating', [1, 2])->count()),

            'with_images' => Tab::make('With Images')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('images'))
                ->badge(fn () => \App\Models\Review::whereNotNull('images')->count()),
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'all';
    }
}