<?php
namespace controllers;

use \Exception;
use lib\database\Mongo;

/**
 * This class is responsible for finding, saving, and deleting diamonds
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 */
abstract class Item
{
    /**
     * This method calls Mongo::find() and returns an array of collection instances
     * @param array query (optional)
     * @param array sort (optional)
     * @param int limit (optional)
     * @return array:diamond instances
     * @throws Exception
     */
    public static function find(array $query = null, array $sort = null, $limit = null)
    {
        $query = empty($query) ? [] : $query;
        $objects = [];

        try {
            // get the result
            $result = Mongo::get(static::COLLECTION)->find($query);

            if (!$result->count()) {
                return $objects;
            }

            // use sort
            if ($sort !== null) {
                $result = $result->sort($sort);
            }

            // use limit
            if ($limit !== null) {
                $result = $result->limit($limit);
            }

            // set the objects
            foreach ($result as $doc) {
                $objects[] = static::get_model($doc);
            }

        } catch (\MongoException $e) {
            // exception wrapper
            throw new Exception(__METHOD__ . ' Failed - ' . $e->getMessage(), $e->getCode(), $e);
        }

        return $objects;
    }

    /**
     * This method calls Mongo::save() on a single or array of diamond objects
     * @param array
     * @throws Exception
     */
    public static function save(array $objects)
    {
        try {

            foreach ($objects as $key => $item) {

                // only save diamonds to this collection
                if (!$item instanceof \models\Item) {
                    continue;
                }

                $item->search_text = $item->get_search_text();

                $result = Mongo::get(static::COLLECTION)->update(
                    ['product_id' => $item->product_id], 
                    $item,
                    ['upsert' => true]
                );
                if (!$result['ok']) {
                    throw new Exception(__METHOD__ . " Invalid response: $result[err]", $e->getCode(), $e);
                }
            }

        } catch (\MongoException $e) { // catches a potential database error
            throw new Exception(__METHOD__ . ' Failed - ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * This method calls Mongo::remove() on an array of diamond objects
     * @param array or diamond
     * @throws Exception
     */
    public static function remove($item)
    {
        try {

            if (!$item instanceof \models\Item) {
                return;
            }

            if (isset($item->product_id)) {
                $query = ['product_id' => $item->product_id];

            } else {
                $query = get_object_vars($item);
                unset($query['_id']);
            }

            $result = Mongo::get(static::COLLECTION)->remove($query);

            if (!$result['ok']) {
                throw new Exception(__METHOD__ . " Invalid response: $result[err]");
            }

        } catch (\MongoException $e) { // catches a potential database error
            throw new Exception(__METHOD__ . ' Failed - ' . $e->getMessage(), $e);
        }
    }

}