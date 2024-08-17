<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Player;
use App\Models\Team;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
        $totalPlayers = Player::count();
        $totalTeams = Team::count();
		return [
            Grid::make([
                ValueMetric::make('Players Count')
                    ->value($totalPlayers)
                    ->icon('heroicons.user'),
                ValueMetric::make('Teams Count')
                    ->value($totalTeams)
                    ->icon('heroicons.users'),
            ])
        ];
	}
}
