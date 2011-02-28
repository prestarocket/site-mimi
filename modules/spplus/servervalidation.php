<?php

	require_once(dirname(__FILE__).'/../../config/config.inc.php');
	require_once(dirname(__FILE__).'/spplus.php');
	  
    echo("spcheckok"); 

   $liste_IP = array( "195.6.195.3",   "83.145.90.3",   "195.115.37.3", 
                      "195.6.195.8",   "83.145.90.8",   "195.115.37.8", 
                      "84.233.159.91", "84.233.159.92", "84.233.159.93", "84.233.159.94", 
                      "84.233.159.95", "84.233.159.96", "84.233.159.97", "84.233.159.98", 
                      "81.255.54.91",  "81.255.54.92",  "81.255.54.93",  "81.255.54.94", 
                      "81.255.54.95",  "81.255.54.96",  "81.255.54.97",  "81.255.54.98",
                      "212.99.102.96", "84.233.159.107", "81.255.54.107", "212.99.102.107");
					  
					  // Add 91.135.180.215 and 91.135.184.215

   $remote_addr = $_SERVER['REMOTE_ADDR'];
   //if( in_array($remote_addr, $liste_IP) )
   {
	 

      $clent = Configuration::get('SPPLUS_MERCHANT_KEY');
      $codesiret = Configuration::get('SPPLUS_MERCHANT_CODE_SIRET');


      @dl('php_spplus.so');
      if (extension_loaded('SPPLUS'))
      {
         $chaineParam = $_SERVER['QUERY_STRING'];
         $pos = strpos($chaineParam,"&hmac=");

         if ($pos != false && is_integer($pos))
         {
            $chaineCalcul = substr($chaineParam,0,$pos);
            $chaineCalcul .= substr($chaineParam,$pos+strlen($_GET["hmac"])+6,strlen($chaineParam));
            $chaineParam = "";
			
            $tok = strtok($chaineCalcul,"=&");
            while($tok)
            {
               if($_REQUEST[$tok] != "")
               {
                  $tok = strtok("&=");
                  $chaineParam .= $tok;
               }
               $tok = strtok("&=");
               $tok = urldecode($tok);
            }
			
            $hmac_calcule = nthmac($clent, $chaineParam);
			
            if ( strcmp( $hmac_calcule, $_GET["hmac"]) == 0 )
				spplus_validate('HMAC_OK');
            else
				echo "ERREUR_HMAC";
          }
      }
      else
      {
         spplus_validate('HMAC_KO');
      }

   }
   
   function spplus_validate($message)
   {
	   $montant    = 0;
	   $reference  = 0;
	   $refsfp     = 0;
	   $etat       = 0;
	   $email      = "";
	   $info       = "";

	   // Récupération des paramètres avec méthode GET (méthode par défaut)
	   if(isset($_GET['montant']))   { $montant     = $_GET['montant']; }
	   if(isset($_GET['reference'])) { $reference   = $_GET['reference']; }
	   if(isset($_GET['refsfp']))    { $refsfp      = $_GET['refsfp']; }
	   if(isset($_GET['etat']))      { $etat        = $_GET['etat']; }
	   if(isset($_GET['email']))     { $email       = $_GET['email']; }
	   
	   // Test de la valeur du paramètre Etat et exemple de traitement correspondant
	   switch ($etat)
	   {
		  case 0:
			 $info = "etat=0 : pas de traitement";
			 break;
		  case 1:
			 $info = "etat=1 : autorisation de paiement accepté - panier vidé - commande en attente";
				$spplus = new SPPlus();
				$cart = new Cart(intval($_GET['arg1']));
				if (Validate::isLoadedObject($cart))
				$spplus->validateOrder(intval($cart->id), _PS_OS_PAYMENT_, $cart->getOrderTotal(), $spplus->displayName, $message);
			 break;
		  case 2:
			 $info = "etat=2 : autorisation de paiement refusé - panier vidé - commande annulée";
				$spplus = new SPPlus();
				$cart = new Cart(intval(Tools::getValue('arg1')));
				if (Validate::isLoadedObject($cart))
				$spplus->validateOrder(intval($cart->id), _PS_OS_ERROR_, 0, $spplus->displayName, $message);
			 break;
		  case 4:
			 $info = "etat=4 : Echéance du paiement acceptée et en attente de remise ";
				 $spplus = new SPPlus();
				 $order = new Order(Order::getOrderByCartId(intval(Tools::getValue('arg1'))));
				 $message = new Message();
				 $texte = $spplus->displayName.' : Echéance n°'.$refsfp.' acceptée.';
				 $message->message = htmlentities($texte, ENT_COMPAT, 'UTF-8');
				 $message->id_order = intval($order->id);
				 $message->private = 1;
				 $message->add();
			 break;
		  case 5:
			 $info = "etat=5 : Echéance du paiement refusée";
			 	 $spplus = new SPPlus();
				 $order = new Order(Order::getOrderByCartId(intval(Tools::getValue('arg1'))));
				 $orderHistory = new OrderHistory();
				 $orderHistory->id_order = intval($order->id);
				 $orderHistory->changeIdOrderState(_PS_OS_ERROR_, intval($order->id));
				 $orderHistory->add();
				 $message = new Message();
				 $texte = $spplus->displayName.' : Echéance n°'.$refsfp.' refusée.';
				 $message->message = htmlentities($texte, ENT_COMPAT, 'UTF-8');
				 $message->id_order = intval($order->id);
				 $message->private = 1;
				 $message->add();
			 break;
		  case 6:
			 $info = "etat=6 : paiement par chèque accepté - panier vidé - commande en attente";
			 break;
		  case 8:
			 $info = "etat=8 : chèque encaissé - commande validée";
			 break;
		  case 10:
			 $info = "etat=10 : transaction terminée";
			 break;
		  case 11:
			 $info = "etat=11 : Paiement annulé par le commerçant - panier vidé - commande annulée";
			 break;
		  case 12:
			 $info = "etat=12 : Abandon de l’internaute - panier vidé - commande annulée";
			 break;
		  case 15:
			 $info = "etat=15 : remboursement - traitement compte client";
			 break;
		  case 99:
			 $info = "etat=99 : Paiement de test en production - panier vidé - commande annulée";
			 break;
	   }
	   echo ('<p>'.$info.'</p>');
   }
?>
