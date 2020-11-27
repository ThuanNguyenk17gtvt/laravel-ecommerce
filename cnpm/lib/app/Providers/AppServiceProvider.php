<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
// use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data['cates']=Category::all();
        view()->share($data);
        // URL::forceScheme('https');
    }
}
