<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer("*", function ($view) {
            if (auth()->check()) {
                $view->with(
                    "cart",
                    Cart::where("user_id", auth()->id())->with("course")->get()
                );
            }
        });
    }
}
