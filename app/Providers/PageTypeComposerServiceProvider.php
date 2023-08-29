<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PageTypeComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['student.*', 'admin.*'], function ($view) {

            $viewName = $view->getName();

            // Determine the page type based on the view's path
            if (str_contains($viewName, 'student.')) {
                $pageType = 'student';
            } elseif (str_contains($viewName, 'admin.')) {
                $pageType = 'admin';
            } else {
                // Default to a generic page type
                $pageType = 'generic';
            }

            // Share the $pageType variable with the view
            $view->with('pageType', $pageType);
        });
    }
}
