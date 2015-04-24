<?php

namespace Truelab\KottiEsBundle\Search;
use Elastica\SearchableInterface;
use Elastica\Search;

/**
 * Class Tru
 * @package Truelab\KottiEsBundle\Search
 */
class Searcher implements SearchableInterface
{
    private $esSearch;

    public function __construct(Search $esSearch)
    {
        $this->esSearch = $esSearch;
    }

    /**
     * {@inheritdoc}
     */
    public function search($query = '', $options = null)
    {
        return $this->esSearch->search($query, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function count($query = '')
    {
        return $this->esSearch->count($query);
    }

    /**
     * {@inheritdoc}
     */
    public function createSearch($query = '', $options = null)
    {
        return $this->esSearch;
    }
}
