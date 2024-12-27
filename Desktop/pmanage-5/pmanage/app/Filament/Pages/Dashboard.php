<?php
namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentIcon;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Navigation\MenuItem;
use App\Filament\Pages\Tenancy\EditWorkSpace;
use App\Traits\MainMenu;
class Dashboard extends BaseDashboard
{
use MainMenu;
    public $current_workspace;
    public $is_owner;
    public $member_count;
    public $project_count;
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;
    //protected static bool $shouldRegisterNavigation = false;

    /**
     * @var view-string
     */
    protected static string $view = 'workspaces.board';

    public function mount() {
        // Ramener le locataire
        $this->current_workspace = Filament::getTenant();
        $this->is_owner = $this->current_workspace->owner_id === auth()->user()->id;
        $this->member_count =  $this->current_workspace->members->count();
        $this->project_count =  $this->current_workspace->projects->count();
        $this->rebuidMenu();

    }

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ??
            static::$title ??
            __('filament-panels::pages/dashboard.title');
    }

    public static function getNavigationIcon(): string | Htmlable | null
    {
        return static::$navigationIcon
            ?? FilamentIcon::resolve('panels::pages.dashboard.navigation-item')
            ?? (Filament::hasTopNavigation() ? 'heroicon-m-home' : 'heroicon-o-home');
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return 2;
    }

    public function getTitle(): string | Htmlable
    {
        return static::$title ?? __('filament-panels::pages/dashboard.title');
    }
}
