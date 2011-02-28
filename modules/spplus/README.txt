test
Installation

Apr�s avoir install� le module dans votre back office PrestaShop, cliquez sur le lien "configurer" � c�t� du nom du module.
La page de configuration vous demande 3 �l�ments :
- La cl� marchand et le code SIRET vous ont �t� fournis par SP Plus par e-mail sous forme crypt�. D�cryptez les avec l'utilitaire fourni et renseignez les sur la page de configuration. Attention, ne mettez pas le -001 qui suit le SIRET, seule la premi�re partie est demand�e.
- L'URL du HMAC permet de g�n�rer la cl� HMAC n�cessaire au focntionnement du module sans installer la librairie PECL SP Plus en utilisant un binaire h�berg� directement sur les serveurs SP Plus. L'URL de base est celle de la boutique de d�mo, vous devez la remplacer par votre propre URL HMAC que vous pouvez demander aupr�s de l'assistance SP Plus.

Configuration du back office SP Plus

Vous devez imp�rativement configurer une notification compl�mentaire dans votre back office SP Plus, � l'adresse suivante http://www.votreboutique.tld/modules/spplus/servervalidation.php.
Attention � ne pas confondre avec l'URL de retour paiement internaute.

Probl�mes �ventuels

1) Extension SP Plus et fonction dl()
Sur le front office sur la page de choix du paiement, l'erreur suivante peut appara�tre.
Warning: dl() has been disabled for security reasons in /modules/spplus/spplus.php
Fatal error: Call to undefined function calculhmac() in /modules/spplus/spplus.php

V�rifiez l'extension PECL SP Plus est install�e sur votre serveur et chargez l� dans votre fichier de configuration de PHP. Si vous ne souhaitez pas qu'elle soit charg�e constamment, il suffit alors d'autoriser l'appel � la fonction dl() qui la chargera automatiquement.
Cette extension est propos�e par la Caisse d'Epargne et est fortement conseill�e pour un fonctionnement correct du module.
Si vous le souhaitez vous pouvez n�anmoins vous en passer, il vous faudra alors sp�cifier l'URL du script de cryptage mis � votre disposition par SP Plus. Notez que cet outil ne crypte que les donn�es envoy�es au serveur de paiement, pas sa r�ponse.

2) Les commandes n'apparaissent pas dans le back office
Si apr�s les commandes ne sont pas prises en compte sur votre boutique, c'est probablement que vous n'avez pas renseign� l'adresse de validation sur votre interface de gestion de la caisse d'�pargne.
Connectez-vous sur https://www.spplus.net/bo-war/identification.do?action=login et indiquez l'adresse http://www.votresite.tld/modules/spplus/servervalidation.php

3) Probl�mes sp�cifiques � l'h�bergeur mutualis� 1&1

Si des erreurs s'affichent concernant l'impossibilit� d'utiliser la fonction PHP fopen(),
cr�ez un fichier php.ini � la racine de prestashop contenant cette ligne :
allow_url_fopen = On
