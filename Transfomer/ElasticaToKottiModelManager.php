<?php

namespace Truelab\KottiEsBundle\Transformer;

use Elastica\ResultSet;
use Truelab\KottiEsBundle\Result\HybridResult;
use Truelab\KottiEsBundle\Result\HybridResultInterface;

/**
 * Class ElasticaToKottiModelManager
 * @package Truelab\KottiEsBundle\Transformer
 */
class ElasticaToKottiModelManager implements ElasticaToModelManagerInterface
{
    private $transformer;

    public function __construct(ElasticaToModelInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param ResultSet $results
     *
     * @return HybridResultInterface[]
     */
    public function transform(ResultSet $results)
    {
        $results = $results->getResults();
        $hybridResults = [];

        foreach($results as $result) {
            $transformed = $this->transformer->transform($result);
            $hybridResults[] = new HybridResult($result, $transformed);
        }

        return $hybridResults;
    }
}
