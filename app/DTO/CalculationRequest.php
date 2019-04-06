<?php declare(strict_types=1);

namespace App\DTO;

final class CalculationRequest
{
    /**
     * @var string
     */
    public $stringOne;

    /**
     * @var string
     */
    public $stringTwo;

    /**
     * @var bool
     */
    public $special;

    /**
     * @var string
     */
    public $algorithm;

    public function __construct(string $one, string $two, bool $special, string $algorithm)
    {
        $this->stringOne = $one;
        $this->stringTwo = $two;
        $this->special = $special;
        $this->algorithm = $algorithm;
    }
}