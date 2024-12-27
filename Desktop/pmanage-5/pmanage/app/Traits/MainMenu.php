<?php
namespace App\Traits;
use Filament\Navigation\MenuItem;
use Filament\Facades\Filament;

trait MainMenu {
    public function rebuidMenu() {
        $current_workspace = Filament::getTenant();

        //ramener les worskpace ou je suis invite
        $tmenu =[];
        if (auth()->check() && $current_workspace != null) {

        foreach (auth()->user()->memberships as $item) {

            if(auth()->user()->id != $item->owner_id && $item->id != $current_workspace->id) {
            $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($item->name) . '&rounded=true&color=ffffff&background=007bff';
            $tmenu[] = MenuItem::make()
            ->label($item->name)
            ->url(route('filament.account.pages.dashboard', $item->id))
            ->icon($avatarUrl);
            }

        }
        // config le menuuuu
        Filament::getCurrentPanel()->tenantMenuItems($tmenu);

        // s'il n'est pas locataire desactive menu tenant(edit)
        if (auth()->user()->id != $current_workspace->owner_id) {
            Filament::getCurrentPanel()->tenantProfile(null);
        }
    }

    }
}
