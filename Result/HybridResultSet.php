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
    private $hybridResults;

    private $resultSet;

    /**
     * @param ResultSet $resultSet
     * @param HybridResult[] hybridResults
     */
    public function __construct(ResultSet $resultSet, array $hybridResults)
    {
        $this->resultSet = $resultSet;
        $this->hybridResults = $hybridResults;
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
    public function getHybridResults()
    {
        return $this->hybridResults;
    }
}
