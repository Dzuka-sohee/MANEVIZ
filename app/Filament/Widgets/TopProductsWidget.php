<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Str;

class TopProductsWidget extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Best Selling Products';
    
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        $topProducts = Product::orderBy('total_penjualan', 'desc')
            ->take(10)
            ->get();

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($topProducts as $product) {
            $labels[] = Str::limit($product->name, 20);
            $data[] = $product->total_penjualan;
            $colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random colors
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Sales',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => array_map(fn($color) => $color . '80', $colors),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y', // Horizontal bar chart
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}