<?php
/**
 * Outputs a JSON array of featured items
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 19, 2014
 * @copyright Scottsdale Diamonds, Inc
 */

$diamonds = \controllers\Diamond::find(['featured' => '1']);
$jewelry  = \controllers\Jewelry::find(['featured' => '1']);

echo json_encode(array_merge($diamonds, $jewelry));
die();