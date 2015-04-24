<?php

namespace Truelab\KottiEsBundle\Finder;

use Truelab\KottiEsBundle\Search\Searcher;
use Truelab\KottiEsBundle\Transformer\ElasticaToModelTransformerInterface;

/**
 * Class Finder
 * @package Truelab\KottiEsBundle\Finder
 */
class Finder
{
    private $searcher;
    private $transformer;

    public function __construct(Searcher $searcher, ElasticaToModelTransformerInterface $transformer)
    {
        $this->searcher = $searcher;
        $this->transformer = $transformer;
    }

    /**
     * @param string $query
     * @param null $options
     *
     * @return \Truelab\KottiEsBundle\Result\HybridResultSetInterface
     */
    public function search($query = '', $options = null)
    {
        $resultSet = $this->searcher->search($query, $options);

        return $this->transformer->hybridTransform($resultSet);
    }
}
