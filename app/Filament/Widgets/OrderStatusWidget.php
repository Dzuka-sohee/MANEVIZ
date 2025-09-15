<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderStatusWidget extends ChartWidget
{
    protected static ?string $heading = 'Order Status Distribution';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $data = [];
        $labels = [];
        $colors = [];

        foreach ($statuses as $status) {
            $count = Order::where('status', $status)->count();
            $data[] = $count;
            $labels[] = ucfirst($status);
            
            // Add colors for each status
            switch ($status) {
                case 'pending':
                    $colors[] = '#f59e0b'; // amber
                    break;
                case 'processing':
                    $colors[] = '#3b82f6'; // blue
                    break;
                case 'shipped':
                    $colors[] = '#06b6d4'; // cyan
                    break;
                case 'delivered':
                    $colors[] = '#10b981'; // green
                    break;
                case 'cancelled':
                    $colors[] = '#ef4444'; // red
                    break;
            }
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}