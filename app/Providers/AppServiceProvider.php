<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SessionRepositoryInterface;
use App\Interfaces\MessageRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CardRepositoryInterface;
use App\Interfaces\OfferRepositoryInterface;
use App\Repositories\SessionRepository;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use App\Repositories\CardRepository;
use App\Repositories\OfferRepository;

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
        $this->app->bind(SessionRepositoryInterface::class, function(){
            return new SessionRepository;
        });
        $this->app->bind(MessageRepositoryInterface::class, function(){
            return new MessageRepository;
        });
        $this->app->bind(CardRepositoryInterface::class, function(){
            return new CardRepository;
        });
        $this->app->bind(UserRepositoryInterface::class, function(){
            return new UserRepository;
        });
        $this->app->bind(OfferRepositoryInterface::class, function(){
            return new OfferRepository;
        });
    }
}
