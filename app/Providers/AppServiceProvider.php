<?php

namespace App\Providers;

use App\Support\StudyActivity;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewInstance;

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
        View::composer('layouts.student', function (ViewInstance $view): void {
            $user = Auth::user();

            if ($user === null) {
                return;
            }

            $viewData = $view->getData();
            if (array_key_exists('weeklyActivity', $viewData) && array_key_exists('studyStreak', $viewData)) {
                return;
            }

            $view->with(StudyActivity::forUser((int) $user->id));
        });
    }
}
