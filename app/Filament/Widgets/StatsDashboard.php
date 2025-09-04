<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Users as UsersModel;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countUsers = UsersModel::count();
        return [
            Stat::make('Jumlah User', $countUsers . ' users'),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
