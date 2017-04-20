<?php
namespace tests\controllers;

require_once(__DIR__ . '/../../sdi.conf.php');

use \PHPUnit_Framework_TestCase;

/**
 * This class is responsible for testing the Diamond controller
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 19, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
class DiamondTest extends PHPUnit_Framework_TestCase {

    /**
     * @var array - diamond test object
     */
    private $_Diamond = [
        "product_id"      => "PHPUnit",
        "carat"           => 31,
        "color"           => "G",
        "clarity"         => "SI3",
        "cut"             => "round",
        "shape"           => "N/A",
        "polish"          => "fair",
        "symmetry"        => "poor",
        "fluorescence"    => "very slight white",
        "table"           => 13,
        "depth"           => 42,
        "length"          => 42,
        "width"           => 35,
        "net_price"       => null,
        "price_per_carat" => null,
        "comment"         => "test-61056a33d0c27f418a3b",
        "created"         => "2013-09-15 16:28:26"
    ];

    /**
     * Sets the Diamond object to manipulate
     */
    public function setup()
    {
        $this->_Diamond = new \models\Diamond($this->_Diamond);
    }

    /**
     * Tests the save method
     */
    public function test_save()
    {
        \controllers\Diamond::save([$this->_Diamond]);
        $this->assertTrue(isset($this->_Diamond->_id), '_id was not set: ' . print_r($this->_Diamond, true));
    }

    /**
     * Tests the find method
     * @depends test_save
     */
    public function test_find()
    {
        $diamonds = \controllers\Diamond::find([
            'product_id' => $this->_Diamond->product_id
        ]);

        $this->assertCount(1, $diamonds, 'Failed to pull exactly 1 diamond');
        $this->assertContainsOnlyInstancesOf('models\\Diamond', $diamonds, 'Failed to pull models\\Diamond classes');
        $Diamond = $diamonds[0];

        foreach (get_object_vars($this->_Diamond) as $field => $value) {
            $this->assertEquals($value, $Diamond->$field, "$field does not match");
        }
    }

    /**
     * Tests the remove method
     * @depends test_find
     */
    public function test_remove()
    {
        \controllers\Diamond::remove($this->_Diamond);

        $Diamond = \controllers\Diamond::find([
            'product_id' => $this->_Diamond->product_id
        ]);

        $this->assertEmpty($Diamond, 'Failed to delete diamond');
    }

}