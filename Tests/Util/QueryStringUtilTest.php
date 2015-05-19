<?php

namespace Truelab\KottiEsBundle\Tests\Util;

use Truelab\KottiEsBundle\Util\QueryStringUtil;
use Truelab\KottiEsBundle\Util\QueryStringUtilInterface;


/**
 * Class QueryStringUtilTest
 * @package Truelab\KottiEsBundle\Tests\Util
 */
class QueryStringUtilTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var QueryStringUtilInterface
     */
    private $queryStringUtil;

    public function setUp()
    {
        $this->queryStringUtil = new QueryStringUtil();
    }

    /**
     * @param string $input - user input
     * @param string $expected - expected clean text
     *
     * @dataProvider cleanQueryTextProvider
     */
    public function testClean($input, $expected)
    {
        $this->assertEquals($expected, $this->queryStringUtil->clean($input));
    }

    public static function cleanQueryTextProvider()
    {
        return [
            ['foo bar john', 'foo bar john'],
            ['topo&& gigio, ma che fai?','topo gigio, ma che fai'],
            ['foo*: |  \bar~ & /john".? doe+- =^ ! ( ) && { } < > ||', 'foo | bar & john doe'],
        ];
    }


    /**
     * @param $input
     * @param $expected
     *
     * @dataProvider escapeQueryTextProvider
     */
    public function testEscape($input, $expected)
    {
        $this->assertEquals($expected, $this->queryStringUtil->escape($input));
    }

    public static function escapeQueryTextProvider()
    {
        return [
            ['foo bar john', 'foo bar john'],
            ['topo&& gigio, ma che fai?','topo\&& gigio, ma che fai\?'],
            [
                'foo*: |  \bar~ & /john".? doe+- =^ ! ( ) && { } < > ||',
                'foo\*\: |  \\\bar\~ & \/john\"\.\? doe\+\- \=\^ \! \( \) \&& \{ \} \< \> \||'
            ],
        ];
    }


}
