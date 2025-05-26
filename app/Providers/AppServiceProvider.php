<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modules = ['Auth', 'Tasks', 'Dashboard'];
        
        foreach ($modules as $module) {
            $config = require app_path("Modules/{$module}/config.php");
            
            View::addNamespace(
                $config['views']['namespace'],
                $config['views']['path']
            );
        }
    }
}
