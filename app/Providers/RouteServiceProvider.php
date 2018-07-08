<?php

namespace App\Providers;

use App\Model\BlogCategory;
use App\Model\BlogContent;
use App\Model\Category;
use App\Model\City;
use App\Model\Company;
use App\Model\District;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
        \Route::model('company', Company::class);
        \Route::model('user', User::class);
        \Route::model('category', Category::class);
        \Route::bind('categorySlug', function ($value) {
            if (!$value) {
                return null;
            }

            return Category::where('slug', $value)->first();
        });

        \Route::model('blogCategorySlug', BlogCategory::class);
        \Route::model('blogContentSlug', BlogContent::class);

        \Route::model('city', City::class);
        \Route::model('district', District::class);
        \Route::bind('citySlug', function ($value) {
            if (!$value) {
                return null;
            }

            return City::where('slug', $value)->first();
        });
        \Route::bind('districtSlug', function ($value) {
            if (!$value) {
                return null;
            }

            $city = request()->route('citySlug');

            return District::where('slug', $value)
                ->where('city_id', $city->id)
                ->first();
        });
        \Route::bind('companySlug', function ($value) {
            return Company::where('slug', $value)->first() ?? abort(404);
        });
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
