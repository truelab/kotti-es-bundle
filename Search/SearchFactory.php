<?php

namespace Truelab\KottiEsBundle\Search;

use Psr\Log\LoggerInterface;

use Truelab\KottiEsBundle\Elastica\Client;
use Elastica\Search;

/**
 * Class SearchFactory
 * @package Truelab\KottiEsBundle\Search
 */
class SearchFactory
{
    private $logger;

    private static $search;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $host
     * @param string $port
     * @param string $index
     *
     * @return Search
     */
    public function create($host, $port, $index)
    {
        if(self::$search instanceof Search) {
            return self::$search;
        }

        $client = new Client([
            'host' => $host,
            'port' => $port,
        ], function ($connection, $exception) {
           if(isset($exception) && $exception instanceof \Exception) {
               $this->logger->error($exception);
           }
        });

        $search = new Search($client);
        $search->addIndex($index);

        self::$search = $search;

        return self::$search;
    }
}
