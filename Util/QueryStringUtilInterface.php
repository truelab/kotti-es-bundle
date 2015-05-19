<?php

namespace Truelab\KottiEsBundle\Util;

/**
 * Interface QueryStringUtilInterface
 * @package Truelab\KottiEsBundle\Util
 */
interface QueryStringUtilInterface
{
    /**
     * @param string $text - input query string text to clean
     *
     * @return string
     */
    public function clean($text);

    /**
     * @param string $text - input query text to escape
     *
     * @return string
     */
    public function escape($text);
}
