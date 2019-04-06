<?php

namespace App\Http\Controllers;

use App\DTO\CalculationRequest;
use App\Service\SimilarityStringCalculator;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;

/**
 * Class CalculateSimilarityController
 * @package App\Http\Controllers
 */
final class CalculateSimilarityController
{
    /**
     * @var SimilarityStringCalculator
     */
    private $stringCalculator;
    /**
     * @var ViewFactory
     */
    private $viewFactory;

    public function __construct(ViewFactory $viewFactory, SimilarityStringCalculator $stringCalculator)
    {
        $this->viewFactory = $viewFactory;
        $this->stringCalculator = $stringCalculator;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function handle(HttpRequest $request): View
    {
        $allRequest = $request->all();

        $response = $this->stringCalculator->calculate(
            new CalculationRequest(
                (string)$allRequest['stringOne'],
                (string)$allRequest['stringTwo'],
                isset($allRequest['special']),
                (string)$allRequest['algorithm']
            )
        );

        $data = $response->printWith(
            function (
                array $algorithmList,
                string $stringOne,
                string $stringTwo,
                bool $special,
                string $preset,
                array $similarity
            ) {
                return [
                    'algorithms' => $algorithmList,
                    'one' => $stringOne,
                    'two' => $stringTwo,
                    'special' => $special,
                    'preset' => $preset,
                    'stringsSimilarity' => $similarity,
                ];
            }
        );

        return $this->viewFactory->make('similarity', $data);
    }
}
