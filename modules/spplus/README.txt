test
Installation

Après avoir installé le module dans votre back office PrestaShop, cliquez sur le lien "configurer" à côté du nom du module.
La page de configuration vous demande 3 éléments :
- La clé marchand et le code SIRET vous ont été fournis par SP Plus par e-mail sous forme crypté. Décryptez les avec l'utilitaire fourni et renseignez les sur la page de configuration. Attention, ne mettez pas le -001 qui suit le SIRET, seule la première partie est demandée.
- L'URL du HMAC permet de générer la clé HMAC nécessaire au focntionnement du module sans installer la librairie PECL SP Plus en utilisant un binaire hébergé directement sur les serveurs SP Plus. L'URL de base est celle de la boutique de démo, vous devez la remplacer par votre propre URL HMAC que vous pouvez demander auprès de l'assistance SP Plus.

Configuration du back office SP Plus

Vous devez impérativement configurer une notification complémentaire dans votre back office SP Plus, à l'adresse suivante http://www.votreboutique.tld/modules/spplus/servervalidation.php.
Attention à ne pas confondre avec l'URL de retour paiement internaute.

Problèmes éventuels

1) Extension SP Plus et fonction dl()
Sur le front office sur la page de choix du paiement, l'erreur suivante peut apparaître.
Warning: dl() has been disabled for security reasons in /modules/spplus/spplus.php
Fatal error: Call to undefined function calculhmac() in /modules/spplus/spplus.php

Vérifiez l'extension PECL SP Plus est installée sur votre serveur et chargez là dans votre fichier de configuration de PHP. Si vous ne souhaitez pas qu'elle soit chargée constamment, il suffit alors d'autoriser l'appel à la fonction dl() qui la chargera automatiquement.
Cette extension est proposée par la Caisse d'Epargne et est fortement conseillée pour un fonctionnement correct du module.
Si vous le souhaitez vous pouvez néanmoins vous en passer, il vous faudra alors spécifier l'URL du script de cryptage mis à votre disposition par SP Plus. Notez que cet outil ne crypte que les données envoyées au serveur de paiement, pas sa réponse.

2) Les commandes n'apparaissent pas dans le back office
Si après les commandes ne sont pas prises en compte sur votre boutique, c'est probablement que vous n'avez pas renseigné l'adresse de validation sur votre interface de gestion de la caisse d'épargne.
Connectez-vous sur https://www.spplus.net/bo-war/identification.do?action=login et indiquez l'adresse http://www.votresite.tld/modules/spplus/servervalidation.php

3) Problèmes spécifiques à l'hébergeur mutualisé 1&1

Si des erreurs s'affichent concernant l'impossibilité d'utiliser la fonction PHP fopen(),
créez un fichier php.ini à la racine de prestashop contenant cette ligne :
allow_url_fopen = On
