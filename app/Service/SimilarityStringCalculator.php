<?php declare(strict_types=1);

namespace App\Service;

use App\Algorithm\Algorithm;
use App\DTO\CalculationRequest;
use App\DTO\CalculationResponse;
use App\Factory\AlgorithmFactoryInterface;

final class SimilarityStringCalculator implements StringCalculatorInterface
{
    /**
     * @var AlgorithmFactoryInterface
     */
    private $factory;

    /**
     * CalculateSimilarityController constructor.
     * @param AlgorithmFactoryInterface $factory
     */
    public function __construct(AlgorithmFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param CalculationRequest $request
     * @return CalculationResponse
     */
    public function calculate(CalculationRequest $request): CalculationResponse
    {
        $preset = mb_strtolower($request->algorithm);

        $stringsSimilarity = [];

        /** @var Algorithm $similarity */
        foreach ($this->factory->build($preset) as $algorithm) {
            $stringsSimilarity[(string)$algorithm] = $algorithm->method()->calculate(
                $request->stringOne,
                $request->stringTwo
            );
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