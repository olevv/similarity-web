<?php declare(strict_types=1);

namespace App\Service;

use App\Sanitizers\StringSanitizer;
use Illuminate\Support\ServiceProvider;

final class SimilarityStringCalculatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            StringCalculatorInterface::class,
            function () {
                $calculator = $this->app->make(SimilarityStringCalculator::class);
                $sanitizer = $this->app->make(StringSanitizer::class);

                return new Sanitized($calculator, $sanitizer);
            }
        );
    }
}