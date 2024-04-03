<?php

namespace App\Filament\Widgets;

use App\Models\Relawan;
use App\Models\Koordinator;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Data', Koordinator::count() + Relawan::count()),
            Stat::make('Koordinator', Koordinator::count()),
            Stat::make('Relawan', Relawan::count()),
        ];
    }
}
