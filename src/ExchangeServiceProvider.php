<?php

namespace Bonoweb\LaravelExchangeDriver;

use Bonoweb\LaravelExchangeDriver\ExchangeAddedServiceProvider;
use Illuminate\Mail\MailServiceProvider;

class ExchangeServiceProvider extends MailServiceProvider
{

    public function register()
    {
        parent::register();

        $this->app->register(ExchangeAddedServiceProvider::class);
    }
}
