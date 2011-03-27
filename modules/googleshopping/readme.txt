//@copyright igwane.com 2010
/********************************/
/     Google Shopping Module     /
/********************************/
Ce module est offert à la communauté par la société Igwane.com. (http://www.igwane.com)
N'hésitez pas à nous envoyer vos commentaires sur ce module.
Si vous avez des besoins particuliers, nous pouvons aussi développer des modules sur demande.


Nom du module: googleshopping
Compatibilité: 1.3.2
Base de donnée: non
Lead developer: Matthieu Fradcourt <matthieu@igwane.com>

Balises google shopping implémentées :
	<title> : Récupération automatique du nom du magasin
	<link> : Génération automatique de l'url du magasin
	<g:id> : L'id des produits
	<title> : Est actuellement le nom du produit
	<link> : Lien vers la fiche produit
	<g:price> : Le prix du produit avec taxes
	<g:description> : Description longue du produit
	<g:condition> : Est toujours à "new"
	<g:mpn> : Référence fabricant (*optionnel)
	<g:image_link> : Liste des images pour un produit
	<g:quantity> : Quantité disponible pour un produit
	<g:gtin> : Code EAN13 pour l'europe
	<g:brand> : Marque
	<g:availability> : Disponibilité du produit

v1.61
Limitation du nombre d'images à 10
	
v1.6
Mise à jour de la présentation du module dans le back-office
Ajout de la balise <g:availability>
Nettoyage du champ description

v1.5
Correction de bugs

v1.4
Choix de description longue ou courte
Mise en petits caractères pour les titres en gras
Coupe le titre si plus de 70 caractères
Coupe la description si plus de 10000 caractères
	
v1.3
Ajout de traductions
Ajout d'un test pour ne pas ajouter de balise vide pour les produits n'ayant pas certaines propriétés
Ajout de l'option "Marque"
ajout de l'option "Code EAN13"

v1.2
Ajout de l'option "Générer le fichier à la racine du site" qui permet de générer le fichier à la racine du site (sinon dans le dossier du module)
Ajout de l'option "Références fabricants" qui permet d'ajouter les refs fabricants au fichier
Création d'un fichier myTools perso qui permet de garder la compatibilité avec les versions précédente de Prestashop

v1.1
Suppression de quelques lignes qui n'avaient rien à faire dans le code pour le moment :)

V1.0
Les balises disponibles:
	<title> : Récupération automatique du nom du magasin
	<link> : Génération automatique de l'url du magasin
	
	<g:id> : L'id des produits
	<title> : Est actuellement le nom du produit
	<link> : Lien vers la fiche produit
	<g:price> : Le prix du produit avec taxes
	<g:description> : Description longue du produit
	<g:condition> : Est toujours à "new"
	<g:mpn> : Référence fabricant
	<g:image_link> : Liste des images pour un produit
	<g:quantity> : Quantité disponible pour un produit