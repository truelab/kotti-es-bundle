<?php

namespace Truelab\KottiEsBundle\Exception;

/**
 * Class AliasNotFoundException
 * @package Truelab\KottiEsBundle\Exception
 */
class AliasNotFoundException extends \Exception
{
    public function __construct($type)
    {
        $message = sprintf('An alias for elastica type = "%s"  was not found', $type);
        parent::__construct($message);
    }
}
