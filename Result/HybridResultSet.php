<?php

namespace Truelab\KottiEsBundle\Result;

use Elastica\Result;
use Elastica\ResultSet;

/**
 * Class HybridResult
 * @package Truelab\KottiEsBundle
 */
class HybridResultSet implements HybridResultSetInterface
{
    private $transformedResults;

    private $resultSet;

    /**
     * @param ResultSet $resultSet
     * @param array $transformedResults
     */
    public function __construct(ResultSet $resultSet, array $transformedResults)
    {
        $this->resultSet = $resultSet;
        $this->transformedResults = $transformedResults;
    }

    /**
     * @return \Elastica\ResultSet
     */
    public function getResultSet()
    {
        return $this->resultSet;
    }

    /**
     * @return array
     */
    public function getTransformedResults()
    {
        return $this->transformedResults;
    }
}
