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

            $this->logQuery('debug', $query);

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

            $this->logQuery('debug', $query);

            return $this->searcher->count($query);

        }catch (\Exception $e) {

            $this->logger->critical($e);
            return 0;
        }
    }

    /**
     * @param string $method - logger method name
     * @param string $query  - query
     * @return void
     */
    protected function logQuery($method, $query)
    {

        if(is_string($query)) {
            $message = $query;
        }elseif(method_exists($query, 'toArray')) {
            $message = json_encode($query->toArray());
        }else{
            $message = 'can\'t log es query';
        }

        $this->logger->{$method}($message);
    }
}
