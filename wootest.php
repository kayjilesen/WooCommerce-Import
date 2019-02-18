<?php

// PHP Errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//$url = $_POST['url'];
$url = "https://nl.aliexpress.com/item/2017-NAVIFORCE-Men-s-Fashion-Sport-Watches-Men-Quartz-Digital-LED-Clock-Man-Leather-Military-Waterproof/32787190847.html?spm=a2g01.11715694.fdpcl001.1.6eb325c4S6WsoC&pvid=f0e33fa8-4676-4c66-94e2-a3b4d10ed50a&gps-id=5547572&scm=1007.19201.111800.0&scm-url=1007.19201.111800.0&scm_id=1007.19201.111800.0";
//$url = "https://nl.aliexpress.com/item/NEO-STER-Grote-Muismat-Oude-Wereldkaart-Notebook-Computer-Mousepad-Gaming-Muis-Matten-Praktische-Bureau-Rusten-Oppervlak/32855064811.html?spm=a2g01.11715694.fdpcl001.6.6eb325c4S6WsoC&pvid=f0e33fa8-4676-4c66-94e2-a3b4d10ed50a&gps-id=5547572&scm=1007.19201.111800.0&scm-url=1007.19201.111800.0&scm_id=1007.19201.111800.0";


// Product Finding
include('dom.php');
include('find.php');

if(empty($url)){
    ?>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="url"><br>
        <input type="submit" name="submit" value="Voeg product toe"><br>
    </form>
    <?php
}

if(!empty($url)){

    // REST API Koppeling
    require_once "class-wc-api-client.php";
    $consumer_key = 'ck_f71380000d860c40a231ee20d5809b1b7750297a'; // Add your own Consumer Key here
    $consumer_secret = 'cs_17c5ea1d8250369d20a8671194307d638f93194f'; // Add your own Consumer Secret here
    $store_url = 'http://test.alleenvandaaggratis.nl'; // Add the home URL to the store you want to connect to here

    // Initialize the class
    $wc_api = new WC_API_Client( $consumer_key, $consumer_secret, $store_url );

    /*
    // Get index
    $index = $wc_api->get_index();
    //print_r( $index );

    // Get Products
    $products = $wc_api->get_products();
    //print_r( $products );
    //

    //print_r( $wc_api->get_products_count() );
    //success
    */

    include('import.php');
   
    $title = findTitle($html);
    $price = findPrice($html);
    $promoPrice = findPromoPrice($html);
    $stock = findStock($html);
    $thumbnail = findThumbnail($html);
    $images = findImages($html);

    /* Not writable 
    $rating = findRating($html);

    */


    $data['product'] = [
        'title' => $title,
        'type' => 'simple',
        'regular_price' => $price,
        'description' => $metaData->description,
        'short_description' => $metaData->description,
        'rating_count' => $rating,
        'categories' => [
            [
                'id' => 9
            ],
            [
                'id' => 14
            ]
        ],
        'images' => [
            [
                'src' => $images[0]
            ],
            [
                'src' => $images[1]
            ],
            [
                'src' => $images[2]
            ],
            [
                'src' => $images[3]
            ],
            [
                'src' => $images[4]
            ],
            [
                'src' => $images[5]
            ]
        ]
    ];

    echo "<pre>";    
    print_r($wc_api->add_product($data));
    echo "</pre>";
    
    //$wc_api->add_product($data);




}

?>