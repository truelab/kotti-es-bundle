<?php

namespace Truelab\KottiEsBundle\Result;

use Elastica\Result;

/**
 * Class HybridResult
 * @package Truelab\KottiEsBundle
 */
class HybridResult implements HybridResultInterface
{
    private $transformed;

    private $result;

    /**
     * @param Result $result
     * @param $transformed
     */
    public function __construct(Result $result, $transformed)
    {
        $this->result = $result;
        $this->transformed = $transformed;
    }

    /**
     * @return \Elastica\Result
     */
    public function getResult()
    {
       return $this->result;
    }

    /**
     * @return mixed
     */
    public function getTransformed()
    {
        return $this->transformed;
    }
}
