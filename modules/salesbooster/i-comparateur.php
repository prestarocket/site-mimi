<?php

$in_stock = 'En stock';

// Titre des colonnes
$header_file = array(
    1 => 'nom',
    2 => 'marque',
    3 => 'reference_interne',
    4 => 'reference_fabricant',
    5 => 'code_ean',
    6 => 'categorie',
    7 => 'prix_ttc',
    8 => 'frais_de_port',
    9 => 'eco_participation',
    10 => 'disponibilite',
    11 => 'description',
    12 => 'texte_promotionnel',
    13 => 'lien_produit',
    14 => 'lien_image_vignette',
    15 => 'lien_image_normal',
    16 => 'poids'
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    3  => 1, // nom              pos1
    14 => 2, // marque           pos2
    2  => 3, // réf. int (id)    pos3
    12 => 4, // réf. fabr.       pos4
    15 => 5, // ean              pos5
    1  => 6, // catégorie        pos6
    5  => 7, // prix ttc         pos7
    8  => 8, // frais de p.      pos8
    13 => 9, // écotax           pos9
    9  => 10,// disponibilité    pos10
    4  => 11,// desc.            pos11
    58 => 12,// text promo.      pos12
    6  => 13,// lien article     pos13
    60 => 14,// lien vignette    pos14
    7  => 15,// lien image       pos15
    59 => 16,// poids            pos16
);
$active_fields = 16;

?>