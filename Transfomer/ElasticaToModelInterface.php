<?php

namespace Truelab\KottiEsBundle\Transformer;
use Elastica\Result;

/**
 * Interface ElasticaToModelInterface
 * @package Truelab\KottiEsBundle\Transformer
 */
interface ElasticaToModelInterface
{
    /**
     * @param Result $result
     *
     * @return mixed
     */
    public function transform(Result $result);
}
