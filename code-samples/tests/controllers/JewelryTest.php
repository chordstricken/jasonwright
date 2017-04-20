<?php
namespace tests\controllers;

require_once(__DIR__ . '/../../sdi.conf.php');

use \PHPUnit_Framework_TestCase;

/**
 * This class is responsible for testing the Jewelry controller
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 19, 2014
 * @copyright Scottsdale Jewelrys, Inc
 */
class JewelryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var array - diamond test object
     */
    private $_Jewelry = [
        'product_id'  => 'PHPUnit',
        'type'        => 'necklace',
        'color'       => 'brilliant',
        'comment'     => 'some comment',
        'created'     => '2014-01-01',
    ];

    /**
     * Sets the Jewelry object to manipulate
     */
    public function setup()
    {
        $this->_Jewelry = new \models\Jewelry($this->_Jewelry);
    }

    /**
     * Tests the save method
     */
    public function test_save()
    {
        \controllers\Jewelry::save([$this->_Jewelry]);
        $this->assertTrue(isset($this->_Jewelry->_id), '_id was not set: ' . print_r($this->_Jewelry, true));
    }

    /**
     * Tests the find method
     * @depends test_save
     */
    public function test_find()
    {
        $diamonds = \controllers\Jewelry::find([
            'product_id' => $this->_Jewelry->product_id
        ]);

        $this->assertCount(1, $diamonds, 'Failed to pull exactly 1 diamond');
        $this->assertContainsOnlyInstancesOf('models\\Jewelry', $diamonds, 'Failed to pull models\\Jewelry classes');
        $Jewelry = $diamonds[0];

        foreach (get_object_vars($this->_Jewelry) as $field => $value) {
            $this->assertEquals($value, $Jewelry->$field, "$field does not match");
        }
    }

    /**
     * Tests the remove method
     * @depends test_find
     */
    public function test_remove()
    {
        \controllers\Jewelry::remove($this->_Jewelry);

        $Jewelry = \controllers\Jewelry::find([
            'product_id' => $this->_Jewelry->product_id
        ]);

        $this->assertEmpty($Jewelry, 'Failed to delete diamond');
    }

}