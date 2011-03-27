<?php

$in_stock = '001';
$secondhand = 'New';

// Titre des colonnes
$header_file = array(
    1 => 'url',
    2 => 'Title',
    3 => 'offerID',
    4 => 'description',
    5 => 'price',
    6 => 'deliveryTime',
    7 => 'warranty',
    8 => 'ecotax',
    9 => 'unitaryPrice',
    10 => 'deliverycost',
    11 => 'image',
    12 => 'availability',
    13 => 'condition',
    14 => 'category',
    15 => 'expiration',
    16 => 'delete',
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    6  => 1, // url              pos1
    34 => 2, // nom produit      pos2
    2  => 3, // id               pos3
    35 => 4, // desc. court      pos4
    5  => 5, // prix ttc         pos5
    10 => 6, // délai de livr    pos6
    11 => 7, // garantie         pos7
    13 => 8, // écotax           pos8
    38 => 9, // prix unitaire    pos9
    8 => 10, // prix livr.       pos10
    7  => 11,// url image        pos11
    9  => 12,// disponibilité    pos12
    18 => 13,// état             pos13
    1  => 14,// catégorie        pos14
    36 => 15,// fin offre        pos15
    37 => 16,// delete           pos16
);
$active_fields = 16;

?>