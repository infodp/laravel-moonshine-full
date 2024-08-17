<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\Request;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Metrics\ValueMetric;

/**
 * @extends ModelResource<Player>
 */
class PlayerResource extends ModelResource
{
    protected string $model = Player::class;

    protected string $title = 'Players';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailModal = false;

    protected bool $withPolicy = true;

    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Name', 'name')->required(),
                BelongsTo::make('Team', 'teams', 'name'),
                Text::make('Position', 'position')->required()
            ]),
        ];
    }

    /**
     * @param Player $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function metrics(): array
    {
        $totalPlayers = Player::count();
        $totalTeams = Team::count();
		return [
            Grid::make([
                Column::make([
                    ValueMetric::make('Players Count')
                    ->value($totalPlayers)
                    ->icon('heroicons.user'),
                ])->columnSpan(6),
                Column::make([
                    ValueMetric::make('Teams Count')
                    ->value($totalTeams)
                    ->icon('heroicons.users')
                    ->withAttributes([
                        'style'=>'background-color: #4c1d95'
                    ]),
                ])->columnSpan(6)
            ])
        ];
    }
}
