<?php

namespace Truelab\KottiEsBundle\Finder;

use Elastica\SearchableInterface;
use Elastica\Query;

use Truelab\KottiEsBundle\Transformer\ElasticaToModelManagerInterface;

/**
 * Class Finder
 * @package Truelab\KottiEsBundle\Finder
 */
class Finder
{
    private $searchable;
    private $transformerManager;

    public function __construct(SearchableInterface $searchable, ElasticaToModelManagerInterface $transformerManager)
    {
        $this->searchable = $searchable;
        $this->transformerManager = $transformerManager;
    }

    public function find($query, $limit = null, $options = array())
    {
        $results = $this->search($query, $limit, $options);
        return $this->transformerManager->transform($results);
    }

    /**
     * @param $query
     * @param null|int $limit
     * @param array    $options
     *
     * @return array
     */
    protected function search($query, $limit = null, $options = array())
    {
        $queryObject = Query::create($query);
        if (null !== $limit) {
            $queryObject->setSize($limit);
        }
        $results = $this->searchable->search($queryObject, $options)->getResults();
        return $this->transformerManager->transform($results);
    }
}
