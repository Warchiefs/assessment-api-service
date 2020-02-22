<?php

namespace App\Providers;

use App\Interfaces\LanguageTranslatorClientInterface;
use App\Interfaces\LanguageTranslatorInterface;
use App\Service\LanguageTranslator\LanguageTranslator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LanguageTranslatorServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(LanguageTranslatorClientInterface::class, function ($app) {
            $clientConfigKey = config('translation.client');
            $clientClass = config('translation.clients_mapping')[$clientConfigKey] ?? null;
            return new $clientClass();
        });

        $this->app->bind(LanguageTranslatorInterface::class, function ($app) {
            $translatorClient = app()->make(LanguageTranslatorClientInterface::class);
            return new LanguageTranslator($translatorClient);
        });
    }

    public function provides()
    {
        return [LanguageTranslatorClientInterface::class, LanguageTranslatorInterface::class];
    }
}
