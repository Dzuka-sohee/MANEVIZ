<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Products by Status';
    
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $active = Product::where('status', 'active')->count();
        $inactive = Product::where('status', 'inactive')->count();
        $outOfStock = Product::where('status', 'out_of_stock')->count();

        return [
            'datasets' => [
                [
                    'data' => [$active, $inactive, $outOfStock],
                    'backgroundColor' => [
                        '#10b981', // green for active
                        '#6b7280', // gray for inactive
                        '#f59e0b', // amber for out of stock
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Active', 'Inactive', 'Out of Stock'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}