<?php
namespace models;

/**
 * This class represents an item and is extended by all models
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
abstract class Item
{
    public $product_id        = null;
    public $tracking          = 0;
    public $tracking_note     = null;
    public $tracking_customer = null;
    public $tracking_sent     = null;
    public $featured          = 0;
    public $search_text       = "";

    /**
     * Maps the provided array into the object
     * @param array $data
     */
    public function __construct($data)
    {
        foreach ($data as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }

        $this->featured = intval($this->featured);
        $this->tracking = intval($this->tracking);
    }
    
    abstract public function get_search_text();
}