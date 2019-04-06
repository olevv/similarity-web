<?php declare(strict_types=1);

namespace App\Sanitizers;

/**
 * Interface SanitizerInterface
 * @package Sanitizers
 */
interface SanitizerInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function sanitize(string $string): string;

    /**
     * @param string $string
     * @return string
     */
    public function removeSpecialSymbols(string $string): string;

    /**
     * @param string $string
     * @return string
     */
    public function changeWordsRusToEng(string $string): string;
}