<?php declare(strict_types=1);

namespace App\Algorithm;

use Olevv\SimilarityStrings\Algorithm\AlgorithmInterface;

final class Algorithm
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var AlgorithmInterface
     */
    private $method;

    public function __construct(string $type, AlgorithmInterface $method)
    {
        $this->type = $type;
        $this->method = $method;
    }

    public function __toString(): string
    {
        return $this->type;
    }

    public function method(): AlgorithmInterface
    {
        return $this->method;
    }
}