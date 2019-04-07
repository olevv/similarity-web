<?php declare(strict_types=1);

namespace App\Service;

use App\Algorithm\Algorithm;
use App\DTO\CalculationRequest;
use App\DTO\CalculationResponse;
use App\Factory\AlgorithmFactoryInterface;
use App\Sanitizers\SanitizerInterface;

final class SimilarityStringCalculator implements StringCalculatorInterface
{
    /**
     * @var AlgorithmFactoryInterface
     */
    private $factory;
    /**
     * @var SanitizerInterface
     */
    private $sanitizer;

    /**
     * CalculateSimilarityController constructor.
     * @param AlgorithmFactoryInterface $factory
     * @param SanitizerInterface $sanitizer
     */
    public function __construct(AlgorithmFactoryInterface $factory, SanitizerInterface $sanitizer)
    {
        $this->factory = $factory;
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

        $preset = mb_strtolower($request->algorithm);

        $stringsSimilarity = [];

        /** @var Algorithm $similarity */
        foreach ($this->factory->build($preset) as $algorithm) {
            $stringsSimilarity[(string)$algorithm] = $algorithm->method()->calculate($one, $two);
        }

        return new CalculationResponse(
            $request->stringOne,
            $request->stringTwo,
            $request->special,
            $preset,
            $stringsSimilarity
        );
    }
}