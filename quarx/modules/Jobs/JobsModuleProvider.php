<?php

namespace Quarx\Modules\Jobs;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class JobsModuleProvider extends ServiceProvider
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
        $this->app->events->listen('eloquent.saved: Quarx\Modules\Jobs\Models\Job', 'Quarx\Modules\Jobs\Models\Job@afterSaved');

        // Load Routes
        $this->app->router->group(['middleware' => ['web']], function ($router) {
            require __DIR__.'/Routes/web.php';
        });

        // View namespace
        $this->app->view->addNamespace('jobs', __DIR__.'/Views');

        // Configs
        $this->app->config->set('quarx.modules.jobs', include(__DIR__.'/config.php'));
    }
}
