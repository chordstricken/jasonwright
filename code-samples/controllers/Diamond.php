<?php
namespace controllers;

/**
 * This class is responsible for finding, saving, and deleting diamonds
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 */
class Diamond extends Item
{
    /**
     * Name of the mongo collection
     */
    const COLLECTION = 'Diamonds';

    /**
     * Name of the model to instantiate
     * @param array $data
     */
    public static function get_model(array $data)
    {
        return new \models\Diamond($data);
    }
}