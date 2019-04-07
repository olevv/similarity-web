<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculationRequest;
use App\DTO\CalculationResponse;
use App\Sanitizers\SanitizerInterface;

final class Sanitized implements StringCalculatorInterface
{
    /**
     * @var StringCalculatorInterface
     */
    private $stringCalculator;
    /**
     * @var SanitizerInterface
     */
    private $sanitizer;

    public function __construct(StringCalculatorInterface $stringCalculator, SanitizerInterface $sanitizer)
    {
        $this->stringCalculator = $stringCalculator;
        $this->sanitizer = $sanitizer;
    }

    /**
     * @param CalculationRequest $request
     * @return CalculationResponse
     */
    public function calculate(CalculationRequest $request): CalculationResponse
    {
        $one = $this->sanitizer->sanitize($request->stringOne);

        $two = $this->sanitizer->sanitize($request->stringTwo);

        if ($request->special) {
            $one = $this->sanitizer->removeSpecialSymbols($one);
            $two = $this->sanitizer->removeSpecialSymbols($two);
        }

        if ((bool)preg_match('/[а-яё]/u', $one)) {
            $one = $this->sanitizer->changeWordsRusToEng($one);
        }

        if ((bool)preg_match('/[а-яё]/u', $two)) {
            $two = $this->sanitizer->changeWordsRusToEng($two);
        }

        return $this->stringCalculator->calculate(
            new CalculationRequest(
                $one,
                $two,
                $request->special,
                $request->algorithm
            )
        );
    }
}