<?php

$in_stock = 'O';

// Titre des colonnes
$header_file = array(
    1 => 'SKU',
    2 => 'MPN',
    3 => 'CUP',
    4 => 'Marque',
    5 => 'Nom du produit',
    6 => 'Url du produit',
    7 => 'Mobile URL',
    8 => 'Prix actuel',
    9 => 'Prix d\'origine',
    10 => 'Numéro de la catégorie',
    11 => 'Nom de la catégorie',
    12 => 'Sous catégorie',
    13 => 'Numéro de référence article parent',
    14 => 'Nom parent',
    15 => 'Description du produit ',
    16 => 'Stock description',
    17 => 'Puce produit 1',
    18 => 'Puce produit 2',
    19 => 'Puce produit 3',
    20 => 'Puce produit 4',
    21 => 'Puce produit 5',
    22 => 'URL de l\'image',
    23 => 'URL de l\'image alternative 1',
    24 => 'URL de l\'image alternative 2',
    25 => 'URL de l\'image alternative 3',
    26 => 'URL de l\'image alternative 4',
    27 => 'URL de l\'image alternative 5',
    28 => 'Type de produit',
    29 => 'Style',
    30 => 'Sexe',
    31 => 'Section',
    32 => 'Tranche d\'âge',
    33 => 'Couleur',
    34 => 'Matière',
    35 => 'Sport ou activité',
    36 => 'Equipe',
    37 => 'Ligue',
    38 => 'Plateforme logicielle',
    39 => 'Catégorie logicielle',
    40 => 'Type d\'affichage',
    41 => 'Type de téléphone portable',
    42 => 'Opérateur',
    43 => 'Type de formule tarifaire',
    44 => 'Profil de l\'utilisateur',
    45 => 'Taille',
    46 => 'Unité de mesure de la taille',
    47 => 'Longueur du produit',
    48 => 'Unité de mesure de la longueur',
    49 => 'Largeur du produit',
    50 => 'Unité de mesure de la largeur',
    51 => 'Hauteur du produit',
    52 => 'Unité de mesure de la hauteur',
    53 => 'Poids du produit',
    54 => 'Unité de mesure du poids',
    55 => 'Prix à l\'unité',
    56 => 'Meilleures ventes',
    57 => 'Date de lancement du produit',
    58 => 'Disponibilité',
    59 => 'Frais de port',
    60 => 'Poids du colis',
    61 => 'Code postal',
    62 => 'Date d\'envoi estimée',
    63 => 'Code avantage',
    64 => 'Description du code avantage',
    65 => 'Type de marchandisage',
    66 => 'Offre groupée',
    67 => 'Produits associés',
    68 => 'Personnalisation'
);
$this->file[] = $header_file;
// attribution de la colonne
$order_fields = array(
    2 =>  1, // sku - id produit
   89 =>  2, // MPN
   90 =>  3, // CUP
   14 =>  4, // fabricant
    3 =>  5, // nom du produit
    6 =>  6, // url du produit
   91 =>  7, // url mobile
    5 =>  8, // prix ttc
   16 =>  9, // prix barré
   92 => 10, // id cat
   93 => 11, // nom cat
   94 => 12, // nom sous-cat
   95 => 13, // ref. parent
   96 => 14, // nom parent
   4  => 15, // desc. longue
   98 => 16, // desc. stock
   99 => 17, // puce produit 1
   100 => 18, // puce produit 2
   101 => 19, // puce produit 3
   102 => 20, // puce produit 4
   103 => 21, // puce produit 5
     7 => 22, // url image principale
   104 => 23, // url image alt. 1
   105 => 24, // url image alt. 2
   106 => 25, // url image alt. 3
   107 => 26, // url image alt. 4
   108 => 27, // url image alt. 5
   109 => 28, // type de produit
   110 => 29, // style
   111 => 30, // sexe
   112 => 31, // section
   113 => 32, // tranche d'âge
   114 => 33, // couleur
   115 => 34, // matière
   117 => 35, // sport ou activité
   118 => 36, // équipe
   119 => 37, // ligue
   121 => 38, // plat. logi.
   122 => 39, // cat. logi.
   123 => 40, // type affichage
   124 => 41, // type tél. port.
   125 => 42, // opérateur
   126 => 43, // type formule
   127 => 44, // prof. utilisateur
   128 => 45, // taille
   129 => 46, // unité de mesure taille
   130 => 47, // long. prod.
   131 => 48, // unité. long.
   132 => 49, // larg. prod.
   133 => 50, // unité larg.
   134 => 51, // haut. prod.
   135 => 52, // unité haut.
    59 => 53, // poids
   136 => 54, // unité mes. poids
   137 => 55, // prix à l'uni.
   138 => 56, // meill. ventes
   139 => 57, // date lanc.
     9 => 58, // dispo.
     8 => 59, // frais de port
   140 => 60, // poids du colis
   141 => 61, // code post.
   142 => 62, // date envoi
   143 => 63, // code av.
   144 => 64, // desc. code av.
   145 => 65, // type de march.
   146 => 66, // offre gr.
   147 => 67, // produits assoc.
   148 => 68, // perso.
);
$active_fields = 68;

?>