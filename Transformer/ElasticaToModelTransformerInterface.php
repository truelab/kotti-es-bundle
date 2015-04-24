<?php

namespace Truelab\KottiEsBundle\Transformer;
use Elastica\ResultSet;
use Truelab\KottiEsBundle\Result\HybridResultSetInterface;

/**
 * Interface ElasticaToModelTransformerInterface
 * @package Truelab\KottiEsBundle\Transformer
 */
interface ElasticaToModelTransformerInterface
{
    /**
     * Transforms an array of elastica objects into an array of
     * model objects fetched from the doctrine repository.
     *
     * @param \Elastica\ResultSet $resultSet
     *
     * @return HybridResultSetInterface
     */
    public function hybridTransform(ResultSet $resultSet);
}
