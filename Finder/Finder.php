<?php

namespace Truelab\KottiEsBundle\Finder;

use Elastica\Query;
use Elastica\ResultSet;
use Psr\Log\LoggerInterface;
use Truelab\KottiEsBundle\Response\ErrorResponse;
use Truelab\KottiEsBundle\Result\HybridResultSet;
use Truelab\KottiEsBundle\Search\Searcher;
use Truelab\KottiEsBundle\Transformer\ElasticaToModelTransformerInterface;

/**
 * Class Finder
 * @package Truelab\KottiEsBundle\Finder
 */
class Finder
{
    private $searcher;
    private $transformer;
    private $logger;

    public function __construct(Searcher $searcher, ElasticaToModelTransformerInterface $transformer, LoggerInterface $logger)
    {
        $this->searcher = $searcher;
        $this->transformer = $transformer;
        $this->logger = $logger;
    }

    /**
     * @param string $query
     * @param null $options
     *
     * @return \Truelab\KottiEsBundle\Result\HybridResultSetInterface
     */
    public function search($query = '', $options = null)
    {
        try{

            $resultSet = $this->searcher->search($query, $options);

        }catch (\Exception $e) {

            $this->logger->critical($e);

            return new HybridResultSet(
                new ResultSet(new ErrorResponse(), Query::create($query)),
                []
            );
        }

        return $this->transformer->hybridTransform($resultSet);
    }

    public function count($query = '')
    {
        try {
            return $this->searcher->count($query);
        }catch (\Exception $e) {
            $this->logger->critical($e);
            return 0;
        }
    }
}
