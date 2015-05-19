<?php

namespace Truelab\KottiEsBundle\Tests\Functional\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Truelab\KottiEsBundle\Util\QueryStringUtilInterface;


/**
 * Class QueryStringUtilTest
 * @package Truelab\KottiEsBundle\Tests\Functional\Util
 */
class QueryStringUtilTest extends WebTestCase
{

    /**
     * @var QueryStringUtilInterface
     */
    private $queryStringUtil;

    public function setUp()
    {
        $client = self::createClient();
        $this->queryStringUtil = $client->getContainer()->get('truelab_kotti_es.util.query_string');
    }

    public function testService()
    {
        $this->assertInstanceOf('Truelab\KottiEsBundle\Util\QueryStringUtilInterface', $this->queryStringUtil);
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
