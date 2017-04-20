<?php
namespace lib\database;

use \Exception;
use \MongoDB;
use \MongoClient;
use \MongoCollection;

/**
 * This class interfaces with Mongo
 * 
 * @author      Jason Wright <jason.dee.wright@gmail.com>
 * @since       Nov 18, 2014
 * @see         http://us2.php.net/manual/en/book.mongo.php
 * 
 */

class Mongo extends MongoCollection
{
    /**
     * @var MongoClient
     */
    private static $_mongo_client = null;

    /**
     * @var MongoDB
     */
    private static $_mongo_db = null;

    /**
     * This should be called whenever a database call is to be made to the primary database
     * @param collection name
     * @return MongoCollection
     * @see http://us2.php.net/manual/en/class.mongocollection.php
     * @throws exceptions\Mongo
     */
    public static function get($collection)
    {
        try {

            return new self($collection);

        } catch (\MongoException $e) {
            throw new Exception(__METHOD__ . ': ' . $e->getMessage());
        }

    }

    /**
     * pass in custom connect params for separate DB connections
     * @param string collection
     * @param string db host
     * @param array of params (to override user, password, db, etc.)
     * @see http://us2.php.net/manual/en/mongoclient.construct.php for a list of $params
     * @throws exceptions\Mongo
     * 
     */
    public function __construct($collection, $host = null, array $params = null)
    {
        try {
            $host   = $host === null ? 'localhost' : $host;
            $params = $params === null ? [] : $params;
            $params['username'] = MONGO_USER;
            $params['pass']     = MONGO_PASS;

            $host = "mongodb://$host";

            self::$_mongo_client = new MongoClient($host, $params);
            self::$_mongo_db = self::$_mongo_client->selectDB(MONGO_DB);

            parent::__construct(self::$_mongo_db, $collection);

        } catch (\MongoConnectionException $e) {
            throw new Exception(__METHOD__ . ' Failed to connect to Mongo: ' . $e->getMessage(), $e);
        }

    }
}