<?php

namespace App\Providers;

use App\Interfaces\QuestionsListRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class QuestionsListRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->bind(QuestionsListRepositoryInterface::class, function ($app) {
            $clientConfigKey = config('repositories.questions_list_repository');
            $clientClass = config('repositories.questions_list_repositories_mapping')[$clientConfigKey] ?? null;
            return new $clientClass();
        });
    }

    public function provides()
    {
        return [QuestionsListRepositoryInterface::class];
    }
}
