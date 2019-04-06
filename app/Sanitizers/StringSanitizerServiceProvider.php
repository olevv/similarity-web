<?php declare(strict_types=1);

namespace App\Sanitizers;

use Illuminate\Support\ServiceProvider;

/**
 * Class StringSanitizerServiceProvider
 * @package Sanitizers
 */
final class StringSanitizerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SanitizerInterface::class, StringSanitizer::class);
    }
}