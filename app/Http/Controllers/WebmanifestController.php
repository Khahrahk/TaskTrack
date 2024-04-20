<?php

namespace App\Http\Controllers;

class WebmanifestController extends Controller
{
    public function __invoke()
    {
        $appName = config('app.name');
        return response()->json([
            'name' => $appName,
            'short_name' => $appName,
            'start_url' => '/?source=homescreen',
            'id' => '/?source=homescreen',
            'display' => 'standalone',
            'scope' => '/',
            'background_color' => '#30b5bf',
            'theme_color' => '#f8f8f8',
            'description' => $appName,
            'icons' => [
                [
                    'src' => 'images/touch/homescreen48.png',
                    'sizes' => '48x48',
                    'type' => 'image/png',
                ],
                [
                    'src' => 'images/touch/homescreen72.png',
                    'sizes' => '72x72',
                    'type' => 'image/png',
                ],
                [
                    'src' => 'images/touch/homescreen96.png',
                    'sizes' => '96x96',
                    'type' => 'image/png',
                ],
                [
                    'src' => 'images/touch/homescreen144.png',
                    'sizes' => '144x144',
                    'type' => 'image/png',
                ],
                [
                    'src' => 'images/touch/homescreen168.png',
                    'sizes' => '168x168',
                    'type' => 'image/png',
                ],
                [
                    'src' => 'images/touch/homescreen192.png',
                    'sizes' => '192x192',
                    'type' => 'image/png',
                ],
            ],
        ]);
    }
}
