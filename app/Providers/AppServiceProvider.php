<?php declare(strict_types=1);

namespace App\Providers;

use App\Domain\Entities\Times;
use App\Domain\Repositories\TimesRepository;
use App\Domain\Services\Times\GetService;
use App\Domain\Services\Times\TimesServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TimesController;
use App\Http\Controllers\ConvertedTimesController;
use App\Domain\Services\Times\ConverterService;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new  Client([
                'timeout'  => 10.0
            ]);
        });

        $this->app->bind(ConverterService::class, function () {
            return new ConverterService();
        });

        $this->app->bind(Times::class, function () {
            return new Times();
        });

        $this->app->bind(TimesRepository::class, function () {
            return new TimesRepository($this->app->make(Times::class));
        });

        $this->app->when([TimesController::class, ConvertedTimesController::class])
            ->needs(TimesServiceInterface::class)
            ->give(function () {
                return new GetService($this->app->make(TimesRepository::class));
            });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
