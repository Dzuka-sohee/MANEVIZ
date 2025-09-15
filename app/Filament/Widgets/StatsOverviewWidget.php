<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Get total revenue from paid orders
        $totalRevenue = Order::where('payment_status', 'paid')->sum('grand_total');
        
        // Get monthly revenue
        $thisMonthRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('grand_total');
            
        $lastMonthRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('grand_total');
            
        $revenueChange = $lastMonthRevenue > 0 
            ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;

        // Get total orders and monthly comparison
        $totalOrders = Order::count();
        $thisMonthOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $ordersChange = $lastMonthOrders > 0 
            ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 
            : 0;

        // Get active products
        $activeProducts = Product::where('status', 'active')->count();
        $totalProducts = Product::count();

        // Get average rating
        $averageRating = Review::avg('rating');

        // Get new users this month
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $newUsersLastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $usersChange = $newUsersLastMonth > 0 
            ? (($newUsersThisMonth - $newUsersLastMonth) / $newUsersLastMonth) * 100 
            : 0;

        return [
            Stat::make('Total Revenue', 'IDR ' . number_format($totalRevenue, 0, ',', '.'))
                ->description($revenueChange >= 0 ? "↗️ {$revenueChange}% increase" : "↘️ {$revenueChange}% decrease")
                ->descriptionIcon($revenueChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueChange >= 0 ? 'success' : 'danger'),
                
            Stat::make('Total Orders', $totalOrders)
                ->description($ordersChange >= 0 ? "↗️ {$ordersChange}% from last month" : "↘️ {$ordersChange}% from last month")
                ->descriptionIcon($ordersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($ordersChange >= 0 ? 'success' : 'danger'),
                
            Stat::make('Active Products', $activeProducts)
                ->description("Total products: {$totalProducts}")
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),
                
            Stat::make('Average Rating', number_format($averageRating, 2) . '/5')
                ->description('From customer reviews')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
                
            Stat::make('New Users This Month', $newUsersThisMonth)
                ->description($usersChange >= 0 ? "↗️ {$usersChange}% from last month" : "↘️ {$usersChange}% from last month")
                ->descriptionIcon($usersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($usersChange >= 0 ? 'success' : 'danger'),
                
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Orders awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}