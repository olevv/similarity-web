<?php declare(strict_types=1);

namespace App\Factory;

use App\Algorithm\Algorithm;
use App\Algorithm\AlgorithmEnum;
use Generator;
use InvalidArgumentException;
use Olevv\SimilarityStrings\Algorithm\CosineDistance;
use Olevv\SimilarityStrings\Algorithm\Jaccard;
use Olevv\SimilarityStrings\Algorithm\JaroWinkler;
use Olevv\SimilarityStrings\Algorithm\Levenstein;
use Olevv\SimilarityStrings\Algorithm\SimilarText;
use Olevv\SimilarityStrings\Algorithm\ThreeSets;

final class AlgorithmFactory implements AlgorithmFactoryInterface
{
    /**
     * @param string $preset
     * @return Algorithm[]|Generator
     */
    public function build(string $preset): Generator
    {
        switch ($preset) {
            case AlgorithmEnum::LEVENSTEIN:
                yield new Algorithm(AlgorithmEnum::LEVENSTEIN, new Levenstein);
                break;
            case AlgorithmEnum::JACCARD:
                yield new Algorithm(AlgorithmEnum::JACCARD, new Jaccard);
                break;
            case AlgorithmEnum::JARO_WINKLER:
                yield new Algorithm(AlgorithmEnum::JARO_WINKLER, new JaroWinkler);
                break;
            case AlgorithmEnum::COSINE_DISTANCE:
                yield new Algorithm(AlgorithmEnum::COSINE_DISTANCE, new CosineDistance);
                break;
            case AlgorithmEnum::THREE_SETS:
                yield new Algorithm(AlgorithmEnum::THREE_SETS, new ThreeSets);
                break;
            case AlgorithmEnum::SIMILAR_TEXT:
                yield new Algorithm(AlgorithmEnum::SIMILAR_TEXT, new SimilarText);
                break;
            case AlgorithmEnum::ALL:
                yield from $this->build(AlgorithmEnum::LEVENSTEIN);
                yield from $this->build(AlgorithmEnum::JACCARD);
                yield from $this->build(AlgorithmEnum::JARO_WINKLER);
                yield from $this->build(AlgorithmEnum::COSINE_DISTANCE);
                yield from $this->build(AlgorithmEnum::THREE_SETS);
                yield from $this->build(AlgorithmEnum::SIMILAR_TEXT);
                break;
            default:
                throw new InvalidArgumentException('No such algorithm preset');
        }
    }
}