<?php

namespace Truelab\KottiEsBundle\Transformer;
use Elastica\Result;
use Truelab\KottiModelBundle\Repository\AliasRepository;
use Truelab\KottiModelBundle\Repository\RepositoryInterface;

/**
 * Class ElasticaToKottiModel
 * @package Truelab\KottiEsBundle\Transformer
 */
class ElasticaToKottiModel implements ElasticaToModelInterface
{
    private $map;
    private $repository;

    public function __construct(RepositoryInterface $repository, array $elasticaTypesToAliasMap = [])
    {
        $this->repository = $repository;
        $this->map = $elasticaTypesToAliasMap;
    }

    /**
     * @param Result $result
     *
     * @return mixed
     */
    public function transform(Result $result)
    {
        $alias = $this->getAlias($result->getType());
        $identifier = $result->getId();

        return $this->repository->find($alias, $identifier);
    }

    protected function getAlias($type)
    {
        if(isset($this->map[$type])) {
            return $this->map[$type];
        }else{
            throw new \Exception(sprintf('Can\'t map "%s" elastica _type to an existing kotti model type', $type));
        }
    }
}
