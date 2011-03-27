<?php

$in_stock = 'in stock';
$secondhand = 'new';

// Titre des colonnes
$header_file = array(
    1 => 'id',
    2 => 'title',
    3 => 'link',
    4 => 'price',
    5 => 'description',
    6 => 'condition',
    7 => 'gtin',
    8 => 'brand',
    9 => 'mpn', // réf. fab.
    10 => 'image_link',
    11 => 'product_type',
    12 => 'availability',
    13 => 'quantity',
    14 => 'shipping',
    15 => 'TVA',
    16 => 'feature',
    17 => 'online_only',
    18 => 'manufacturer',
    19 => 'expiration_date',
    20 => 'shipping_weight',
    21 => 'genre',
    22 => 'featured_product',
    23 => 'color',
    24 => 'size',
    25 => 'year',
    26 => 'author',
    27 => 'edition',
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    2  => 1, // id               pos1
   81  => 2, // nom produit      pos2
    6  => 3, // lien             pos3
    5  => 4, // prix ttc         pos4
    4  => 5, // desc             pos5
    18 => 6, // état             pos6
    66 => 7, // gtin             pos7
    80 => 8, // marque           pos8
    12 => 9, // référence f.     pos9
    7  => 10,// url image        pos10
    1  => 11,// catégorie        pos11
    9  => 12,// en stock         pos12
    67 => 13,// quantité         pos13
    68 => 14,// prix exped.      pos14
    69 => 15,// tva              pos15
    70 => 16,// caractérist.     pos16
    71 => 17,// vente en ligne   pos17
    14 => 18,// fabricant        pos18
    72 => 19,// date expiration  pos19
    59 => 20,// poids            pos20
    73 => 21,// genre            pos21
    74 => 22,// offre spéciale   pos22
    75 => 23,// couleur          pos23
    76 => 24,// taille           pos24
    77 => 25,// année            pos25
    78 => 26,// auteur           pos26
    79 => 27,// édition          pos27
);
$active_fields = 27;

?>