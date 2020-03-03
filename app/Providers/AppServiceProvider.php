<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::addNamespace('quarx-frontend', base_path('resources/themes/application'));
        View::addLocation(base_path('resources/themes/application'));

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        });

        Blade::directive('edit', function ($type = null, $id = null) {
            return '';
            if (Gate::allows('quarx', Auth::user())) {
                if (!is_null($id)) {
                    return '<a href="' . url(config('quarx.backend-route-prefix', 'quarx') . '/' . $type . '/' . $id . '/edit') . '" class="btn btn-xs btn-default pull-right"><span class="fa fa-pencil"></span> Edit</a>';
                } else {
                    return '<a href="' . url(config('quarx.backend-route-prefix', 'quarx') . '/' . $type) . '" class="btn btn-xs btn-default pull-right"><span class="fa fa-pencil"></span> Edit</a>';
                }
            }
        });

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $theme = Config::get('quarx.frontend-theme');
            $view = '"quarx-frontend::' . str_replace('"', '', str_replace("'", '', $expression)) . '"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
