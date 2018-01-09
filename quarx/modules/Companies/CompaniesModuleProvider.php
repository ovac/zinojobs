<?php

namespace Quarx\Modules\Companies;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CompaniesModuleProvider extends ServiceProvider
{
    public function register()
    {
        // Publishes
        $this->publishes([
            __DIR__.'/Publishes/app' => base_path('app'),
            __DIR__.'/Publishes/routes' => base_path('routes'),
            __DIR__.'/Publishes/resources' => base_path('resources'),
        ]);

        // Load events
        $this->app->events->listen('eloquent.saved: Quarx\Modules\Companies\Models\Company', 'Quarx\Modules\Companies\Models\Company@afterSaved');

        // Load Routes
        $this->app->router->group(['middleware' => ['web']], function ($router) {
            require __DIR__.'/Routes/web.php';
        });

        // View namespace
        $this->app->view->addNamespace('companies', __DIR__.'/Views');

        // Configs
        $this->app->config->set('quarx.modules.companies', include(__DIR__.'/config.php'));
    }
}
