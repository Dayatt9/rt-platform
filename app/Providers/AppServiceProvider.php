<?php

namespace App\Providers;

use App\Listeners\ActivateVerifiedResidentAccount;
use App\Listeners\UpdateLastLogin;
use App\Models\GuestLocationLink;
use App\Models\House;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Tenant;
use App\Policies\GuestLocationLinkPolicy;
use App\Policies\HouseholdPolicy;
use App\Policies\HousePolicy;
use App\Policies\ResidentPolicy;
use App\Policies\TenantPolicy;
use App\Services\TenantContext;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Verified;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantContext::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Gate::policy(Tenant::class, TenantPolicy::class);
        Gate::policy(Resident::class, ResidentPolicy::class);
        Gate::policy(House::class, HousePolicy::class);
        Gate::policy(Household::class, HouseholdPolicy::class);
        Gate::policy(GuestLocationLink::class, GuestLocationLinkPolicy::class);
        RateLimiter::for('guest-location', fn (Request $request) => Limit::perMinute(60)->by($request->ip()));
        Event::listen(Verified::class, ActivateVerifiedResidentAccount::class);
        Event::listen(Login::class, UpdateLastLogin::class);

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
