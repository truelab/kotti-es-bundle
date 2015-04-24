<?php

namespace Truelab\KottiEsBundle\Result;

/**
 * interface HybridResultInterface
 * @package Truelab\KottiEsBundle\Result
 */
interface HybridResultSetInterface
{
    /**
     * @return \Elastica\ResultSet
     */
    public function getResultSet();

    /**
     * @return array
     */
    public function getTransformedResults();
}
