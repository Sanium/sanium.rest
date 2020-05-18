<?php

namespace App\Providers;

use App\Client;
use App\Employer;
use App\JobOfferResponse;
use App\Offer;
use App\Policies\ClientPolicy;
use App\Policies\EmployerPolicy;
use App\Policies\JobOfferResponsePolicy;
use App\Policies\OfferPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Employer::class => EmployerPolicy::class,
        Client::class => ClientPolicy::class,
        Offer::class => OfferPolicy::class,
        JobOfferResponse::class => JobOfferResponsePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
