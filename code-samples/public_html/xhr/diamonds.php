<?php
/**
 * This file is responsible for outputing a dump of diamonds
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 21, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
$query = [];

error_log(date(DATE_ATOM) . ' ' . print_r($_JSON, true) . PHP_EOL, 3, '/tmp/xhr.diamonds.log');

// search query
if (!empty($_JSON['search_text'])) {
    $_JSON['search_text'] = str_replace(' ', '.+', $_JSON['search_text']);
    $query['search_text'] = new MongoRegex("/$_JSON[search_text]/i");
}

// normal parameter groupings
if (isset($_JSON['color']) && count($_JSON['color'])) {
    $query['color'] = ['$in' => array_values($_JSON['color'])];
}
if (isset($_JSON['clarity']) && count($_JSON['clarity'])) {
    $query['clarity'] = ['$in' => array_values($_JSON['clarity'])];
}
if (isset($_JSON['cut']) && count($_JSON['cut'])) {
    $query['cut'] = ['$in' => array_values($_JSON['cut'])];
}
if (isset($_JSON['shape']) && count($_JSON['shape'])) {
    $query['shape'] = ['$in' => array_values($_JSON['shape'])];
}
if (isset($_JSON['polish']) && count($_JSON['polish'])) {
    $query['polish'] = ['$in' => array_values($_JSON['polish'])];
}
if (isset($_JSON['symmetry']) && count($_JSON['symmetry'])) {
    $query['symmetry'] = ['$in' => array_values($_JSON['symmetry'])];
}
if (isset($_JSON['fluorescence']) && count($_JSON['fluorescence'])) {
    $query['fluorescence'] = ['$in' => array_values($_JSON['fluorescence'])];
}

// set carat min/max
if (isset($_JSON['carat']['min'])) {
    $query['carat']['$gte'] = floatval($_JSON['carat']['min']);
}
if (isset($_JSON['carat']['max'])) {
    $query['carat']['$lte'] = floatval($_JSON['carat']['max']);
}

// set table min/max
if (isset($_JSON['table']['min'])) {
    $query['table']['$gte'] = floatval($_JSON['table']['min']);
}
if (isset($_JSON['table']['max'])) {
    $query['table']['$lte'] = floatval($_JSON['table']['max']);
}

// depth min/max
if (isset($_JSON['depth']['min'])) {
    $query['depth']['$gte'] = floatval($_JSON['depth']['min']);
}
if (isset($_JSON['depth']['max'])) {
    $query['depth']['$lte'] = floatval($_JSON['depth']['max']);
}

// length min/max
if (isset($_JSON['length']['min'])) {
    $query['length']['$gte'] = floatval($_JSON['length']['min']);
}
if (isset($_JSON['length']['max'])) {
    $query['length']['$lte'] = floatval($_JSON['length']['max']);
}

// width min/max
if (isset($_JSON['width']['min'])) {
    $query['width']['$gte'] = floatval($_JSON['width']['min']);
}
if (isset($_JSON['width']['max'])) {
    $query['width']['$lte'] = floatval($_JSON['width']['max']);
}

// price_per_carat min/max
if (isset($_JSON['price_per_carat']['min'])) {
    $query['price_per_carat']['$gte'] = floatval($_JSON['price_per_carat']['min']);
}
if (isset($_JSON['price_per_carat']['max'])) {
    $query['price_per_carat']['$lte'] = floatval($_JSON['price_per_carat']['max']);
}

// net_price min/max
if (isset($_JSON['net_price']['min'])) {
    $query['net_price']['$gte'] = floatval($_JSON['net_price']['min']);
}
if (isset($_JSON['net_price']['max'])) {
    $query['net_price']['$lte'] = floatval($_JSON['net_price']['max']);
}


$diamonds = controllers\Diamond::find($query);
foreach ($diamonds as $diamond) {
    $diamond->image_path = "/share/inventory_images/$diamond->product_id" . '_thumb';
    $diamond->image_path = file_exists(ROOTPATH . $diamond->image_path) ? $diamond->image_path : '/share/inventory_images/no-image';
    $diamond->cert_path  = "/share/inventory_certs/$diamond->product_id";
    $diamond->cert_path  = file_exists(ROOTPATH . $diamond->cert_path) ? $diamond->cert_path : null;
}
echo json_encode($diamonds);
