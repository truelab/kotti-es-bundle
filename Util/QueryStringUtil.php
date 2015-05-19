<?php

namespace Truelab\KottiEsBundle\Util;

/**
 * Class QueryStringUtil
 * @package Truelab\KottiEsBundle\Util
 */
class QueryStringUtil implements QueryStringUtilInterface
{
    private $options =[
        // Reserved characters ? * ~ . ! ( ) { } + - = \ / : && || ^ < > "
        'clean_query_text_pattern' => '/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/',
        'escape_query_text_pattern' => '/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/',
        'escape_query_text_replacement' => '\\\\${1}${2}${3}'
    ];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        $this->options['clean_query_text_pattern'] = '/' . trim($this->options['clean_query_text_pattern'], '/') . '/';
        $this->options['escape_query_text_pattern'] = '/' . trim($this->options['escape_query_text_pattern'], '/') . '/';

    }

    public function clean($text)
    {
        // replace "special" chars
        $output =  preg_replace($this->options['clean_query_text_pattern'], ' ', $text);

        // remove double white spaces
        $output = preg_replace('!\s+!', ' ', $output);

        // trim
        $output = trim($output);

        return $output;
    }

    public function escape($text)
    {
        $output =  preg_replace(
            $this->options['escape_query_text_pattern'],
            $this->options['escape_query_text_replacement'], $text);
        return $output;
    }
}
