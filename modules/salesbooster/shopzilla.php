<?php

$in_stock = 'En Stock';
$secondhand = 'Neuf';

// Titre des colonnes
$header_file = array(
    1 => 'Catégorie',
    2 => 'Fabricant',
    3 => 'Titre',
    4 => 'Desc',
    5 => 'Lien',
    6 => 'Image',
    7 => 'SKU',
    8 => 'Stock',
    9 => 'Condition',
    10 => 'Poids',
    11 => 'Frais de Livraison',
    12 => 'Enchère',
    13 => 'Promo',
    14 => 'EAN/UPC',
    15 => 'Prix'
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    1  => 1,     // catégorie        pos1
    14 => 2,     // fabriquant       pos2
    3  => 3,     // nom produit      pos3
    4  => 4,     // desc. courte     pos4
    6  => 5,     // url produit      pos5
    7  => 6,     // url image        pos6
    2  => 7,     // SKU (id)         pos7
    9  => 8,     // stock            pos8
    18 => 9,     // neuf/occ.        pos9
    59 => 10,    // poids            pos10
    8  => 11,    // prix exped.      pos11
    28 => 12,    // US seulement
    26 => 13,    // Offre spéciale   pos13
    15 => 14,    // ean13            pos14
    5  => 15,    // prix ttc         pos15
);
$active_fields = 15;

?>