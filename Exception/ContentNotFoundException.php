<?php

namespace Truelab\KottiEsBundle\Exception;

/**
 * Class ContentNotFoundException
 * @package Truelab\KottiEsBundle\Exception
 */
class ContentNotFoundException extends \Exception
{
    public function __construct($alias, $id)
    {
        $message = sprintf('A content with alias = "%s" and id = "%s" was not found on database', $alias, $id);
        parent::__construct($message);
    }
}
