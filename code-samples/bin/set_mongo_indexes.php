#!/usr/bin/php
<?php
require_once(__DIR__ . '/../global.conf.php');

use \lib\database\Mongo;

// set Diamonds indexes
$collection = \controllers\Diamond::COLLECTION;
echo "Setting indexes on $collection collection\n";
Mongo::get($collection)->createIndex(['product_id'      => 1], ['unique' => 1]);
Mongo::get($collection)->createIndex(['search_text'     => -1]);
Mongo::get($collection)->createIndex(['tracked'         => -1]);
Mongo::get($collection)->createIndex(['featured'        => -1]);
Mongo::get($collection)->createIndex(['carat'           => 1]);
Mongo::get($collection)->createIndex(['color'           => 1]);
Mongo::get($collection)->createIndex(['clarity'         => 1]);
Mongo::get($collection)->createIndex(['cut'             => 1]);
Mongo::get($collection)->createIndex(['polish'          => 1]);
Mongo::get($collection)->createIndex(['symmetry'        => 1]);
Mongo::get($collection)->createIndex(['fluorescence'    => 1]);
Mongo::get($collection)->createIndex(['table'           => 1]);
Mongo::get($collection)->createIndex(['depth'           => 1]);
Mongo::get($collection)->createIndex(['length'          => 1]);
Mongo::get($collection)->createIndex(['width'           => 1]);
Mongo::get($collection)->createIndex(['shape'           => 1]);
Mongo::get($collection)->createIndex(['price_per_carat' => 1]);
Mongo::get($collection)->createIndex(['net_price'       => 1]);
echo "Done!\n";

$collection = \controllers\Jewelry::COLLECTION;
echo "Setting indexes on $collection collection\n";
Mongo::get($collection)->createIndex(['product_id'  => 1], ['unique' => 1]);
Mongo::get($collection)->createIndex(['search_text' => -1]);
Mongo::get($collection)->createIndex(['tracked'     => -1]);
Mongo::get($collection)->createIndex(['featured'    => -1]);
Mongo::get($collection)->createIndex(['type'        => 1]);
Mongo::get($collection)->createIndex(['color'       => 1]);
echo "Done!\n";