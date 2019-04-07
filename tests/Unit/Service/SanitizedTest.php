<?php declare(strict_types=1);

namespace Tests\Unit\Service;

use App\DTO\CalculationRequest;
use App\Factory\AlgorithmFactory;
use App\Sanitizers\StringSanitizer;
use App\Service\Sanitized;
use App\Service\SimilarityStringCalculator;
use PHPUnit\Framework\TestCase;

final class SanitizedTest extends TestCase
{
    /**
     * @var Sanitized
     */
    private $sanitized;

    protected function setUp()
    {
        $this->sanitized = new Sanitized(
            new SimilarityStringCalculator(
                new AlgorithmFactory
            ),
            new StringSanitizer
        );
    }

    /**
     * @test
     */
    public function it_return_response(): void
    {
        $request = new CalculationRequest('пап', 'паппа', true, 'three_sets');

        $response = $this->sanitized->calculate($request);

        var_dump($response);
    }
}