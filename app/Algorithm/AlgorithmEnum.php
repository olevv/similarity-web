<?php declare(strict_types=1);

namespace App\Algorithm;

abstract class AlgorithmEnum
{
    public const ALL = 'all';
    public const LEVENSTEIN = 'levenshtein';
    public const JACCARD = 'jaccard';
    public const JARO_WINKLER = 'jaro_winkler';
    public const COSINE_DISTANCE = 'cosine_distance';
    public const THREE_SETS = 'three_sets';
    public const SIMILAR_TEXT = 'similar_text';

    public const SELECT_ALGORITHMS = [
        self::ALL,
        self::LEVENSTEIN,
        self::JACCARD,
        self::JARO_WINKLER,
        self::COSINE_DISTANCE,
        self::THREE_SETS,
        self::SIMILAR_TEXT,
    ];
}