<?php

namespace Truelab\KottiEsBundle\Elastica;

/**
 * Class Client
 * @package TruelabKottiEsBundle\Elastica
 */
class Client extends \Elastica\Client implements ClientInterface
{
    /**
     * Creates a new Elastica client
     *
     * @param array    $config   OPTIONAL Additional config options
     * @param callback $callback OPTIONAL Callback function which can be used to be notified about errors (for example connection down)
     */
    public function __construct(array $config = array(), $callback = null)
    {
        parent::__construct($config, $callback);
    }
}
