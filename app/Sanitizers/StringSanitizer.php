<?php declare(strict_types=1);

namespace App\Sanitizers;

final class StringSanitizer implements SanitizerInterface
{
    private const RUSSIAN_ALPHABET = [
        'а', 'б', 'в', 'г', 'д', 'е',
        'ё', 'ж', 'з', 'и', 'й', 'к',
        'л', 'м', 'н', 'о', 'п', 'р',
        'с', 'т', 'у', 'ф', 'х', 'ц',
        'ч', 'ш', 'щ', 'ъ', 'ы', 'ь',
        'э', 'ю', 'я'
    ];

    private const ENGLISH_ALPHABET = [
        'a', 'b', 'v', 'g', 'd', 'e',
        'e', 'g', 'z', 'i', 'y', 'k',
        'l', 'm', 'n', 'o', 'p', 'r',
        's', 't', 'u', 'f', 'h', 'c',
        'ch', 'sh', 'sh', '', 'y', 'y',
        'e', 'yu', 'ya'
    ];
    /**
     * @param string $string
     * @return string
     */
    public function sanitize(string $string): string
    {
        $string = trim($string);

        return mb_strtolower($string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function removeSpecialSymbols(string $string): string
    {
        $isRussia = (bool)preg_match('/[а-яё]/u', $string);

        if($isRussia){
            return preg_replace('/[^а-яё0-9\s+]/u', '', $string);
        }

        return preg_replace('/[^a-z0-9\s+]/i', '', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function changeWordsRusToEng(string $string): string
    {
        $string = mb_strtolower($string, 'UTF-8');

        return str_replace(static::RUSSIAN_ALPHABET, static::ENGLISH_ALPHABET, $string);
    }
}