<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Alisa\Services\Replier;
use Illuminate\Support\ServiceProvider;

class AlisaServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            Replier::class,
            fn() => new Replier(
                config('alisa.first_answer', 'Опа, не нашли в конфигах'),
                config('alisa.default_answer', 'Опа, не нашли в конфигах') ,
                config('alisa.answers', []),
                array_map(fn(string $action) => $this->app->make($action), config('alisa.actions', [])),
            )
        );
    }

}
