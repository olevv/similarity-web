<?php declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\ServiceProvider;

final class SimilarityStringCalculatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            StringCalculatorInterface::class,
            SimilarityStringCalculator::class
        );
    }
}