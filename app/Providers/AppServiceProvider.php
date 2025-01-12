<?php

namespace App\Providers;

use App\Filament\Tiptap\Carousel;
use App\Filament\Tiptap\Stats;
use App\Models\User;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        TiptapEditor::configureUsing(function (TiptapEditor $component) {
            $component
                ->blocks([
                    Stats::class,
                    Carousel::class,
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(\Ramnzys\FilamentEmailLog\Models\Email::class, \App\Policies\EmailPolicy::class);
        Cashier::useCustomerModel(User::class);
    }
}
