<?php

namespace Truelab\KottiEsBundle\Elastica;
use Psr\Log\LoggerInterface;
use Elastica\Connection;

/**
 * Interface ClientInterface
 * @package TruelabKottiEsBundle\Elastica
 */
interface ClientInterface
{
    /**
     * Sets specific config values (updates and keeps default values)
     *
     * @param  array            $config Params
     * @return \Elastica\Client
     */
    public function setConfig(array $config);

    /**
     * Returns a specific config key or the whole
     * config array if not set
     *
     * @param  string                               $key Config key
     * @throws \Elastica\Exception\InvalidException
     * @return array|string                         Config value
     */
    public function getConfig($key = '');

    /**
     * Sets / overwrites a specific config value
     *
     * @param  string           $key   Key to set
     * @param  mixed            $value Value
     * @return \Elastica\Client Client object
     */
    public function setConfigValue($key, $value);

    /**
     * @param  array|string $keys    config key or path of config keys
     * @param  mixed        $default default value will be returned if key was not found
     * @return mixed
     */
    public function getConfigValue($keys, $default = null);

    /**
     * Returns the index for the given connection
     *
     * @param  string          $name Index name to create connection to
     * @return \Elastica\Index Index for the given name
     */
    public function getIndex($name);

    /**
     * Adds a HTTP Header
     *
     * @param  string                               $header      The HTTP Header
     * @param  string                               $headerValue The HTTP Header Value
     * @throws \Elastica\Exception\InvalidException If $header or $headerValue is not a string
     */
    public function addHeader($header, $headerValue);

    /**
     * Remove a HTTP Header
     *
     * @param  string                               $header The HTTP Header to remove
     * @throws \Elastica\Exception\InvalidException IF $header is not a string
     */
    public function removeHeader($header);

    /**
     * Uses _bulk to send documents to the server
     *
     * Array of \Elastica\Document as input. Index and type has to be
     * set inside the document, because for bulk settings documents,
     * documents can belong to any type and index
     *
     * @param  array|\Elastica\Document[]           $docs Array of Elastica\Document
     * @return \Elastica\Bulk\ResponseSet           Response object
     * @throws \Elastica\Exception\InvalidException If docs is empty
     * @link http://www.elasticsearch.org/guide/reference/api/bulk.html
     */
    public function updateDocuments(array $docs);

    /**
     * Uses _bulk to send documents to the server
     *
     * Array of \Elastica\Document as input. Index and type has to be
     * set inside the document, because for bulk settings documents,
     * documents can belong to any type and index
     *
     * @param  array|\Elastica\Document[]           $docs Array of Elastica\Document
     * @return \Elastica\Bulk\ResponseSet           Response object
     * @throws \Elastica\Exception\InvalidException If docs is empty
     * @link http://www.elasticsearch.org/guide/reference/api/bulk.html
     */
    public function addDocuments(array $docs);

    /**
     * Update document, using update script. Requires elasticsearch >= 0.19.0
     *
     * @param  int                                       $id      document id
     * @param  array|\Elastica\Script|\Elastica\Document $data    raw data for request body
     * @param  string                                    $index   index to update
     * @param  string                                    $type    type of index to update
     * @param  array                                     $options array of query params to use for query. For possible options check es api
     * @return \Elastica\Response
     * @link http://www.elasticsearch.org/guide/reference/api/update.html
     */
    public function updateDocument($id, $data, $index, $type, array $options = array());


    /**
     * Bulk deletes documents
     *
     * @param  array|\Elastica\Document[]           $docs
     * @return \Elastica\Bulk\ResponseSet
     * @throws \Elastica\Exception\InvalidException
     */
    public function deleteDocuments(array $docs);

    /**
     * Returns the status object for all indices
     *
     * @return \Elastica\Status Status object
     */
    public function getStatus();

    /**
     * Returns the current cluster
     *
     * @return \Elastica\Cluster Cluster object
     */
    public function getCluster();

    /**
     * @param  \Elastica\Connection $connection
     * @return \Elastica\Client
     */
    public function addConnection(Connection $connection);

    /**
     * Determines whether a valid connection is available for use.
     *
     * @return bool
     */
    public function hasConnection();
    /**
     * @throws \Elastica\Exception\ClientException
     * @return \Elastica\Connection
     */
    public function getConnection();
    /**
     * @return \Elastica\Connection[]
     */
    public function getConnections();

    /**
     * @return \Connection\Strategy\StrategyInterface
     */
    public function getConnectionStrategy();

    /**
     * @param  array|\Elastica\Connection[] $connections
     * @return \Elastica\Client
     */
    public function setConnections(array $connections);

    /**
     * Deletes documents with the given ids, index, type from the index
     *
     * @param  array                                $ids     Document ids
     * @param  string|\Elastica\Index               $index   Index name
     * @param  string|\Elastica\Type                $type    Type of documents
     * @param  string|false                         $routing Optional routing key for all ids
     * @throws \Elastica\Exception\InvalidException
     * @return \Elastica\Bulk\ResponseSet           Response  object
     * @link http://www.elasticsearch.org/guide/reference/api/bulk.html
     */
    public function deleteIds(array $ids, $index, $type, $routing = false);

    /**
     * Bulk operation
     *
     * Every entry in the params array has to exactly on array
     * of the bulk operation. An example param array would be:
     *
     * array(
     *         array('index' => array('_index' => 'test', '_type' => 'user', '_id' => '1')),
     *         array('user' => array('name' => 'hans')),
     *         array('delete' => array('_index' => 'test', '_type' => 'user', '_id' => '2'))
     * );
     *
     * @param  array                                 $params Parameter array
     * @throws \Elastica\Exception\ResponseException
     * @throws \Elastica\Exception\InvalidException
     * @return \Elastica\Bulk\ResponseSet            Response object
     * @link http://www.elasticsearch.org/guide/reference/api/bulk.html
     */
    public function bulk(array $params);

    /**
     * Makes calls to the elasticsearch server based on this index
     *
     * It's possible to make any REST query directly over this method
     *
     * @param  string                                   $path   Path to call
     * @param  string                                   $method Rest method to use (GET, POST, DELETE, PUT)
     * @param  array                                    $data   OPTIONAL Arguments as array
     * @param  array                                    $query  OPTIONAL Query params
     * @throws \Exception
     * @return \Elastica\Response                       Response object
     */
    public function request($path, $method = Request::GET, $data = array(), array $query = array());

    /**
     * Optimizes all search indices
     *
     * @param  array              $args OPTIONAL Optional arguments
     * @return \Elastica\Response Response object
     * @link http://www.elasticsearch.org/guide/reference/api/admin-indices-optimize.html
     */
    public function optimizeAll($args = array());

    /**
     * Refreshes all search indices
     *
     * @return \Elastica\Response Response object
     * @link http://www.elasticsearch.org/guide/reference/api/admin-indices-refresh.html
     */
    public function refreshAll();
    /**
     * @return \Elastica\Request
     */
    public function getLastRequest();

    /**
     * @return \Elastica\Response
     */
    public function getLastResponse();

    /**
     * set Logger
     *
     * @param  LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger);
}
