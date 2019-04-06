<?php declare(strict_types=1);

namespace App\DTO;

use App\Algorithm\AlgorithmEnum;

final class CalculationResponse
{
    /**
     * @var array
     */
    private $algorithmList;
    /**
     * @var string
     */
    private $stringOne;
    /**
     * @var string
     */
    private $stringTwo;
    /**
     * @var bool
     */
    private $special;
    /**
     * @var string
     */
    private $preset;
    /**
     * @var array
     */
    private $stringsSimilarity;

    public function __construct(
        string $stringOne,
        string $stringTwo,
        bool $special,
        string $preset,
        array $stringsSimilarity
    ) {
        $this->algorithmList = AlgorithmEnum::SELECT_ALGORITHMS;
        $this->stringOne = $stringOne;
        $this->stringTwo = $stringTwo;
        $this->special = $special;
        $this->preset = $preset;
        $this->stringsSimilarity = $stringsSimilarity;
    }

    public function printWith(callable $printer): array
    {
        return $printer(
            $this->algorithmList,
            $this->stringOne,
            $this->stringTwo,
            $this->special,
            $this->preset,
            $this->stringsSimilarity
        );
    }
}