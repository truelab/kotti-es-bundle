<?php

namespace Truelab\KottiEsBundle\Tests\Functional\Search;

use Elastica\Search;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SearchFactoryTest
 * @package Truelab\KottiEsBundle\Tests\Functional\Search
 */
class SearchFactoryTest extends WebTestCase
{
    /**
     * @var Search
     */
    private $search;


    public function setUp()
    {
        $client = self::createClient();
        $this->search = $client->getContainer()->get('truelab_kotti_es.search');
    }

    public function testFactorizedService()
    {
        $this->assertInstanceOf('Elastica\Search', $this->search);
    }
}
