<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $sidebarMenuJson = file_get_contents(base_path('resources/data/verticalMenu.json'));
        $sidebarMenuData = json_decode($sidebarMenuJson);
        View::share('sidebarMenu', $sidebarMenuData);
    }
}
