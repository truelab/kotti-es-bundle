<?php

namespace Truelab\KottiEsBundle\Transformer;
use Elastica\ResultSet;
use Truelab\KottiModelBundle\Repository\RepositoryInterface;
use Psr\Log\LoggerInterface;
use Truelab\KottiModelBundle\Model\ContentInterface;
use Truelab\KottiEsBundle\Result\HybridResultSet;
use Truelab\KottiEsBundle\Exception\ContentNotFoundException;
use Truelab\KottiEsBundle\Exception\AliasNotFoundException;

/**
 * Class ElasticaToKottiModelTransformer
 * @package Truelab\KottiEsBundle\Transformer
 */
class ElasticaToKottiModelTransformer implements ElasticaToModelTransformerInterface
{
    private $repository;
    private $aliasMap;
    private $logger;

    public function __construct(RepositoryInterface $repository, array $aliasMap = [], LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->aliasMap = $aliasMap;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function hybridTransform(ResultSet $resultSet)
    {
        $transformedResults = [];

        foreach($resultSet->getResults() as $result) {

            try{
                $alias = $this->getAlias($result->getType());

            }catch (AliasNotFoundException $e) {
                $this->logger->error($e);
                continue;
            }

            try{
                $transformed = $this->repository->find($alias, $result->getId());


                if(!$transformed instanceof ContentInterface) {
                    throw new ContentNotFoundException($alias, $result->getId());
                }

            }catch(\Exception $e) {
                $this->logger->error($e);
                continue;
            }

            $transformedResults[] = $transformed;
        }

        return new HybridResultSet($resultSet, $transformedResults);
    }

    protected function getAlias($type)
    {
        if(isset($this->aliasMap[$type])) {
            return $this->aliasMap[$type];
        }else{
            throw new AliasNotFoundException($type);
        }
    }
}
