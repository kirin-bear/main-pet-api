<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Notion\Services\PropertyTag;
use Carbon\Laravel\ServiceProvider;
use FiveamCode\LaravelNotionApi\Notion;

class NotionServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(Notion::class, fn() => new Notion(config('notion.token')));
        $this->app->singleton(
            PropertyTag::class,
            fn() => new PropertyTag(config('notion.database_properties_tags'))
        );
    }

}
