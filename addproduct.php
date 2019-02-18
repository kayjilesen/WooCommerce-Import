<?php 

$prod_data = [
	'name'          => 'A great product',
	'type'          => 'simple',
	'regular_price' => '15.00',
	'description'   => 'A very meaningful product description',
	'images'        => [
		[
			'src'      => 'https://shop.local/path/to/image.jpg',
			'position' => 0,
		],
	],
	'categories'    => [
		[
			'id' => 1,
		],
	],
];

$woocommerce->post( 'products', $prod_data );