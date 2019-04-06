<?php declare(strict_types=1);

namespace App\Factory;

use Illuminate\Support\ServiceProvider;

/**
 * Class AlgorithmServiceProvider
 * @package App\Factory
 */
final class AlgorithmFactoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AlgorithmFactoryInterface::class, AlgorithmFactory::class);
    }
}