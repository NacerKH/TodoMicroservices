<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The base module namespace.
     *
     * @var string
     */
    protected const BASE_INTERNAL_MODULE_NAMESPACE = 'App\ExternalServices';

    /**
     * The base module path.
     *
     * @var string
     */
    protected const BASE_MODULE_PATH = 'app/ExternalServices';

    /**
     * The names of external services.
     *
     * @var array
     */
    protected $externalServiceNames = [
        'Authorization',
        'TaskManagement',
    ];



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mapServicesRoutes();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Map the routes for external services.
     *
     * @return void
     */
    protected function mapServicesRoutes()
    {
        foreach ($this->externalServiceNames as $service) {

            $routeFile = self::BASE_MODULE_PATH . '/' . $service . '/Routes/api.php';

            $this->defineApiRoutes(self::BASE_INTERNAL_MODULE_NAMESPACE . '\\' . $service . "\Controllers", $routeFile);
        }
    }

    /**
     * Define API routes.
     *
     * @param  string  $namespace
     * @param  string  $routeFile
     * @return void
     */
    protected function defineApiRoutes($namespace, $routeFile)
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($namespace)
            ->group(base_path($routeFile));
    }

    /**
     * Define web routes.
     *
     * @param  string  $namespace
     * @param  string  $routeFile
     * @return void
     */
    protected function defineWebRoutes($namespace, $routeFile)
    {
        Route::middleware('web')
            ->namespace($namespace)
            ->group(base_path($routeFile));
    }
}
