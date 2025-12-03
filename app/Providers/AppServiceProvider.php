<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\LoanNotificationComposer;

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
        Carbon::setLocale('id');

        View::composer(
            'components.header',     // view target
            LoanNotificationComposer::class // composer yg dibuat
        );

        view()->composer('frontend.partials.navbar', function ($view) {
            $latestActivities = Activity::latest()->take(5)->get();
            $view->with('latestActivities', $latestActivities);
        });
    }
}
