<?php
/**
 * This file is responsible for outputing a dump of diamonds
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Dec 3, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
$query = [];

$items = controllers\Jewelry::find();
foreach ($items as $item) {
    $item->image_path = "/share/inventory_images/$item->product_id" . '_thumb';
    $item->image_path = file_exists(ROOTPATH . $item->image_path) ? $item->image_path : '/share/inventory_images/no-image';
}
echo json_encode($items);
