<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculationRequest;
use App\DTO\CalculationResponse;

interface StringCalculatorInterface
{
    /**
     * @param CalculationRequest $request
     * @return CalculationResponse
     */
    public function calculate(CalculationRequest $request): CalculationResponse;
}