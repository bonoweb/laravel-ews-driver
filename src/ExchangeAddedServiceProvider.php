<?php

namespace Bonoweb\LaravelExchangeDriver;

use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;
use \jamesiarmes\PhpEws\Enumeration\MessageDispositionType;

use Bonoweb\LaravelExchangeDriver\Transport\ExchangeTransport;


class ExchangeAddedServiceProvider extends ServiceProvider
{
    /**
     * Register the Swift Transport instance.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving(MailManager::class, function (MailManager $mail_manager) {
            $mail_manager->extend("exchange", function ($config) {
                $config = $this->app['config']->get('mail.mailers.exchange', []);
                $host = $config['host'];
                $username = $config['username'];
                $password = $config['password'];
                $messageDispositionType = $config['messageDispositionType'] ?: MessageDispositionType::SEND_AND_SAVE_COPY;
                $clientVersion = $config['clientVersion'];
                $caFile = $config['caFile'];
                $fromName = $this->app['config']->get('mail.from.name');
                $fromEmailAddress = $this->app['config']->get('mail.from.address');

                return new ExchangeTransport($host, $username, $password, $messageDispositionType, $clientVersion, $caFile, $fromName, $fromEmailAddress );
            });
        });
    }
}
