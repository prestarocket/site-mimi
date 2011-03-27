<?php

$comparator_filename = 'leguide_fr';
$in_stock = 0;

// Titre des colonnes
$header_file = array(
    1 => 'categorie',
    2 => 'identifiant_unique',
    3 => 'titre',
    4 => 'description',
    5 => 'prix',
    6 => 'URL_produit',
    7 => 'URL_image',
    8 => 'frais_de_port',
    9 => 'disponibilite',
    10 => 'delai_de_livraison',
    11 => 'garantie',
    12 => 'reference_modele',
    13 => 'D3E',
    14 => 'marque',
    15 => 'EAN',
    16 => 'prix_barre',
    17 => 'devise',
    18 => 'occasion',
    19 => 'type_promotion',
    20 => 'URL_mobile',
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    1 => 1, // catégorie        pos1
    2 => 2, // id produit       pos2
    3 => 3, // nom produit      pos3
    4 => 4, // desc. courte     pos4
    5 => 5, // prix ttc         pos5
    6 => 6, // url produit      pos6
    7 => 7, // url image        pos7
    8 => 8, // prix exped.      pos8
    9 => 9, // en stock         pos9
    10 => 10, // temps expéd.   pos10
    11 => 11, // garantie       pos11
    12 => 12, // référence f.   pos12
    13 => 13, // écotax         pos13
    14 => 14, // fabriquant     pos14
    15 => 15, // ean13          pos15
    16 => 16, // prix barré     pos16
    17 => 17, // iso monnaie    pos17
    18 => 18, // occasion       pos18
    19 => 19, // type promotion pos19
    20 => 20, // url mobile     pos20
);
$active_fields = 20;

?>