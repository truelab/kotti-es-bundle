<?php

namespace Truelab\KottiEsBundle\Response;
use Elastica\Response;

/**
 * Class ErrorResponse
 * @package Truelab\KottiEsBundle\Response
 */
class ErrorResponse extends Response
{
    public function  __construct($status = 500)
    {
        $this->_responseString = '';
        $this->_status = $status;
    }

    public function getData()
    {
        return [
            'hits' => [
                'hits' => []
            ],
            'timed_out' => false
        ];
    }
}
