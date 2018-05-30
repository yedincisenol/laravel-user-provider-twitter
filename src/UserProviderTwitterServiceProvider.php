<?php

namespace yedincisenol\UserProviderTwitter;

use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use yedincisenol\UserProvider\UserProviderServiceProviderAbstract;

class UserProviderTwitterServiceProvider extends UserProviderServiceProviderAbstract
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/twitter.php', 'twitter');
    }

    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__ . '/config/twitter.php' => config_path('twitter.php')
        ], 'config');
    }

    /**
     * Create and configure a Password grant instance.
     *
     */
    protected function makeUserProviderGrant()
    {
        $grant = new UserProviderTwitterGrant(
            $this->config,
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}