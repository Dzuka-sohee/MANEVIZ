<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;

class ReviewsStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Reviews Distribution';
    
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $ratings = [];
        $colors = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#16a34a']; // Red to Green

        for ($i = 1; $i <= 5; $i++) {
            $count = Review::where('rating', $i)->count();
            $ratings[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Reviews',
                    'data' => $ratings,
                    'backgroundColor' => $colors,
                    'borderColor' => array_map(fn($color) => $color . '80', $colors),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}