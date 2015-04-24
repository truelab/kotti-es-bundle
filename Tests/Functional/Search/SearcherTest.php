<?php

namespace Truelab\KottiEsBundle\Tests\Functional\Search;

use Elastica\Query;
use Elastica\Search;
use Elastica\SearchableInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SearcherTest
 * @package Truelab\KottiEsBundle\Tests\Functional\Search
 */
class SearcherTest extends WebTestCase
{
    /**
     * @var SearchableInterface
     */
    private $searcher;

    public function setUp()
    {
        $client = self::createClient();
        $this->searcher = $client->getContainer()->get('truelab_kotti_es.searcher');
    }

    public function testFactorizedService()
    {
        $this->assertInstanceOf('Elastica\SearchableInterface', $this->searcher);
    }

    public function testCount()
    {
        $count = $this->searcher->count('Lorem');
        $this->assertGreaterThan(0, $count);

        $count = $this->searcher->count('AAA');
        $this->assertEquals(0, $count);
    }
}
