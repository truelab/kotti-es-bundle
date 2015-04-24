<?php

namespace Truelab\KottiEsBundle\Tests\Elastica;
use Elastica\Query;
use Elastica\Search;
use Truelab\KottiEsBundle\Elastica\Client;

/**
 * Class ClientTest
 * @package Truelab\KottiEsBundle\Tests\Elastica
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testFirstRequestThrowsAnExceptionWithWrongClient()
    {
        $error_callback_called = false;

        $client = new Client([
        'host' => 'localhost',
        'port' => '1200' // wrong
        ], function (/* $connection, $exception, $client */) use (&$error_callback_called) {
            $error_callback_called = true;
        });

        $search = new Search($client);
        $search->setQuery((new Query()));

        try{
            // this cause an error
            $search->count();
            $this->fail('An expected \Elastica\Exception\Connection\HttpException has not been raised.');
        }catch (\Exception $e) {
            $this->assertEquals(true, $error_callback_called, 'An expected client error callback was not called.');
            $this->assertInstanceOf('\Elastica\Exception\Connection\HttpException', $e);
        }
    }
}
