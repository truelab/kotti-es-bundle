<?php

namespace Truelab\KottiEsBundle\Result;

/**
 * interface HybridResultInterface
 * @package Truelab\KottiEsBundle\Result
 */
interface HybridResultInterface
{
    /**
     * @return \Elastica\Result
     */
    public function getResult();

    /**
     * @return mixed
     */
    public function getTransformed();
}
