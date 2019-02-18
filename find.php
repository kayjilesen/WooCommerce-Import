<?php

// Get html content
$html = file_get_html($url, false, null, 0 );

// Title
function findTitle($html){
    foreach($html->find('h1') as $element) 
        return $element->text();
}

// Price
function findPrice($content){
    $price = $content->find('.p-price');
    $price = $price[0]->text();
    str_replace('.', ',', $price);
    return $price;
}

// Promo Price // Stock
function findPromoPrice($content){
    $promo = $content->find('#j-sku-discount-price')[0]->text();
    if(!empty($promo)) return $promo;
    return "";
}

// Stock
function findStock($content){
    $stock = $content->find('#j-sku-limitd-num');
    //$stock = $content->find('em[id=j-sell-stock-num]');
    echo count($stock) . " " . gettype($stock);
    echo $stock[0]->plaintext;
    if(!empty($stock)) return $stock;
    return "Nothing";
}

// Rating
function findRating($content){
    $rating = $content->find('.percent-num');
    $rating = $rating[0]->text();
    return $rating;
}

// Thumbnail
function findThumbnail($content){
    $thumbnail = $content->find('.img-thumb-item img');
    return $thumbnail[0]->src;
}

// Images
function findImages($content){
    $array = [];
    $images = $content->find('.img-thumb-item img');
    foreach($images as $img)
        $array[] = $img->src; 
    return $array;
}

// Print Array
function printArray($array){
    foreach($array as $i)
        echo $i . "<br>";
}

// Print Image source 
function printSource($array){
    foreach($array as $i)
    echo $i->src;
}
