<?php

namespace Truelab\KottiEsBundle\Transformer;
use Elastica\ResultSet;

/**
 * Interface ElasticaToModelManagerInterface
 * @package Truelab\KottiEsBundle\Transformer
 */
interface ElasticaToModelManagerInterface
{
    /**
     * @param array|\Elastica\ResultSet $results
     *
     * @return mixed
     */
    public function transform(ResultSet $results);
}
