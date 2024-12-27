<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Facades\Filament;

class WsStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
    $current_workspace = Filament::getTenant();
    $member_count = $current_workspace->members->count();
        $project_count = $current_workspace->projects->count();

        return [
            Stat::make('Total users', $member_count)->icon('heroicon-o-users'),
            Stat::make('Total Projects', $project_count)->icon('heroicon-o-rectangle-stack'),

            Stat::make('Average time on page', '3:12'),
        ];
    }
}
