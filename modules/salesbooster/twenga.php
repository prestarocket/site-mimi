<?php

$in_stock = 'Y';

// Titre des colonnes
$header_file = array(
    1 => 'product_url',
    2 => 'designation',
    3 => 'price',
    4 => 'category',
    5 => 'image_url',
    6 => 'description',
    7 => 'merchand_id',
    8 => 'manufacturer_id',
    9 => 'shipping_cost',
    10 => 'in_stock',
    11 => 'stock_detail',
    12 => 'condition',
    13 => 'upc_ean',
    14 => 'product_type',
    15 => 'ISBN',
    16 => 'brand',
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    6 => 1, // url produit      pos1
    3 => 2, // nom produit      pos2
    5 => 3, // prix_ttc         pos3
    1 => 4, // catégorie        pos4
    7 => 5, // image_url        pos5
    4 => 6, // desc. courte     pos6
    2 => 7, // id               pos7
    12 => 8, // référence f.    pos8
    8  => 9, // prix exped.     pos9
    9  => 10,// en stock.       pos10
    67 => 11,// nb. stock       pos11
    18 => 12,// occasion        pos11
    15 => 13,// ean13           pos13
    86 => 14,// product type    pos14
    87 => 15,// ISBN            pos15
    88 => 16,// marque          pos16
);
$active_fields = 16;

?>