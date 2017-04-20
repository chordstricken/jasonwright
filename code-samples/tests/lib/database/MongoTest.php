<?php 
namespace tests\lib\database;

use lib\database;

/**
 * This PHPUnit class is responsible testing the Mongo class
 * 
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 * @copyright Scottsdale Diamonds, Inc
 */

require_once(__DIR__ . '/../../../sdi.conf.php');

class MongoTest extends \PHPUnit_Framework_TestCase
{
    private $_collection = 'phpunit_collection';

    private $_test_document = [
        'param1' => true,
        'param2' => false
    ];

    /**
     * verifies the object returned by the Mongo class is a collection
     */
    public function test_collection()
    {
        echo "Testing whether Mongo returns a MongoCollection\n";
        $collection = database\Mongo::get($this->_collection);
        $this->assertInstanceOf('MongoCollection', $collection, 'Collection is not an instance of MongoCollection');
    }

    /**
     * Tests the mongo connection performance
     */
    public function test_performance()
    {
        $max = 3000;
        echo "Instantiating Mongo class $max times... ";

        $start = microtime(true);

        for ($i = 0; $i < $max; $i++) {
            $collection = database\Mongo::get($this->_collection);
        }
        $end = microtime(true);
        $ms  = ($end - $start) * 1000;

        echo " took $ms ms\n";
    }

    /**
     * Tests adding an object to the testData collection
     * @depends test_collection
     */
    public function test_insert()
    {
        echo "Testing a Mongo insert\n";
        $result = database\Mongo::get($this->_collection)->insert($this->_test_document);
        $this->assertEquals($result['ok'], 1, 'Result[ok] is not 1');
    }

    /**
     * Tests updating an object to the testData collection
     * @depends test_insert
     */
    public function test_save()
    {
        echo "Testing a Mongo save\n";
        $this->_test_document['param3'] = ['foo' => 'bar'];

        $result = database\Mongo::get($this->_collection)->save($this->_test_document);
        $this->assertEquals($result['ok'], 1, 'Result[ok] is not 1');
    }

    /**
     * Tests the find method, checks document integrity
     * @depends test_save
     */
    public function test_find()
    {
        echo "Testing a Mongo find\n";
        $result = database\Mongo::get($this->_collection)->find($this->_test_document);
        $i = 0;
        foreach ($result as $doc) {
            $i++;
            $this->assertNotNull($doc['_id'], 'Result "_id" asserted null');
            $this->assertNotNull($doc['param1'], 'Result "param1" asserted null');
            $this->assertNotNull($doc['param2'], 'Result "param2" asserted null');
            $this->assertEquals($this->_test_document['param1'], $doc['param1'], 'Test Document is not equal to doc param');
            $this->assertEquals($this->_test_document['param2'], $doc['param2'], 'Test Document is not equal to doc param');
        }

        $this->assertGreaterThan(0, $i, 'Result returned no results');
    }

    /**
     * Tests the find_and_modify method
     * @depends test_find
     */
    public function test_find_and_modify()
    {
        echo "Testing a Mongo findAndModify\n";
        $new_document = [
            'param1' => false,
            'param2' => true
        ];

        unset($this->_test_document['_id']); // _id is getting set somehow

        $result1 = database\Mongo::get($this->_collection)->findAndModify($this->_test_document, $new_document);
        $this->assertInternalType('array', $result1, 'Result 1 is not an array');

        $result2 = database\Mongo::get($this->_collection)->findAndModify($new_document, $this->_test_document);
        $this->assertInternalType('array', $result2, 'Result 2 is not an array');
    }

    /**
     * Tests the remove method
     * @depends test_find_and_modify
     */
    public function test_remove()
    {
        echo "Testing a Mongo remove\n";
        $result = database\Mongo::get($this->_collection)->remove($this->_test_document);
        $this->assertEquals($result['ok'], 1, 'Result[ok] is not 1');
    }

    /**
     * Tests dropping the _collection
     * @depends test_remove
     */
    public function test_drop()
    {
        echo "Testing a Mongo drop\n";
        $result = database\Mongo::get($this->_collection)->drop();
        $this->assertEquals($result['ok'], 1, 'Result[ok] is not 1');
    }

    /**
     * Verify the exceptions can be caught in a name spaced file
     */
    public function test_verify_namespace_catch()
    {
        echo 'This tests that a mongo exception can be caught in a namespaced file (the test is namespaced)'.PHP_EOL;   
        try {
            throw new \MongoException("Exception Not Caught");
        } catch (\MongoException $e) {
            return true;
        }
    }

    /**
    *  This tests forcing an actual MongoException and verifying it is caught
    */
    public function test_catching_mongo_exception()
    {
        echo 'Testing a duplicate add and verifying the right type of exception is thrown'.PHP_EOL;
        $doc1 = [
            '_id' => 1,
            'test' => 'doc1'
        ];
        $doc2 = [
            '_id' => 1,
            'test' => 'doc2'
        ];

        try {
            $result1 = database\Mongo::get($this->_collection)->insert($doc1);
            $result2 = database\Mongo::get($this->_collection)->insert($doc2);
        } catch (\MongoException $e) {
            $this->assertInstanceOf('MongoException', $e, 'Exception was not a MongoException');
        }
    }

}
