<?php declare(strict_types=1);

namespace App\Factory;

use Generator;
use Olevv\Similarity\Algorithm\Algorithm;

interface AlgorithmFactoryInterface
{
    /**
     * @param string $preset
     * @return Algorithm[]|Generator
     */
    public function build(string $preset): Generator;
}