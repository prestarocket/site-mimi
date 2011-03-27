<?php
$this->_html .= '
 <div id="shopzilla" class="comparator" style="display:none;">
    <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
    <input type="hidden" name="comparator" value="shopzilla"/>
    <hr/>
    <h2>'.$this->l('Export Shopzilla').'</h2>
    <hr/>
    '.$this->l('Exporter en').' '.$form_languages.'
    <hr/>
    <table>
        <tr><td>'.$this->l('Exporter les produits avec un stock à 0').'</td><td>'.$form_stock_zero.'</td></tr>
        <tr><td>'.$this->l('Exporter les déclinaisons').'</td><td>'.$form_combination.'</td></tr>
        <tr><td>'.$this->l('Transporteur').'</td><td>'.$form_carriers.'</td></tr>
        <tr><td>'.$this->l('Calcul des frais de port selon la zone').'</td><td>'.$form_zones.'</td></tr>
        <tr><td>'.$this->l('Votre avantage').'</td>
            <td>
                <select name="special_offer">
                    <option value="" selected>'.$this->l('Effectuez une sélection').'
                    <option value="1">'.$this->l('Distributeur Autorisé').'
                    <option value="2">'.$this->l('Voir site pour meilleur prix').'
                    <option value="3">'.$this->l('Livraison le même jour').'
                    <option value="4">'.$this->l('Spécial Kit').'
                    <option value="5">'.$this->l('2 – 3 jours d’expédition').'
                    <option value="6">'.$this->l('Récupération au magasin').'
                    <option value="7">'.$this->l('Prix avant réduction').'
                    <option value="8">'.$this->l('Cadeau offert avec achat').'
                    <option value="9">'.$this->l('Achat directement au Fabricant').'
                    <option value="10">'.$this->l('Garantie prolongée').'
                    <option value="11">'.$this->l('Gagnez des points de fidélité').'
                    <option value="12">'.$this->l('Vérification de solvabilité').'
                    <option value="13">'.$this->l('Logiciel téléchargeable').'
                    <option value="14">'.$this->l('Livré depuis le fabricant').'
                    <option value="15">'.$this->l('Offre limitée dans le temps').'
                    <option value="16">'.$this->l('Réduction possible').'
                    <option value="17">'.$this->l('Livraison sous 7-14 jours').'
                    <option value="18">'.$this->l('Livraison entre 2 et 4 semaines').'
                    <option value="19">'.$this->l('% de réduction exceptionnelle').'
                    <option value="20">'.$this->l('Format téléchargeable').'
                    <option value="21">'.$this->l('Marchand étranger').'
                    <option value="22">'.$this->l('Prix avant le remboursement de 25 euro').'
                    <option value="23">'.$this->l('Prix avant le remboursement de 30 euro').'
                    <option value="24">'.$this->l('Prix avant le remboursement de 50 euro').'
                    <option value="25">'.$this->l('Prix avant le remboursement de 100 euro').'
                    <option value="26">'.$this->l('Offre d\'Imprimante Gratuite').'
                    <option value="27">'.$this->l('Carte de Cadeau Gratuite').'
                    <option value="28">'.$this->l('Produit gratuit avec un contrat de service').'
                    <option value="32">'.$this->l('Deux pour le prix d’un').'
                    <option value="38">'.$this->l('Options de payment').'
                    <option value="39">'.$this->l('Livraison sous 1-2 jours').'
                    <option value="40">'.$this->l('Support en ligne').'
                    <option value="41">'.$this->l('Livraison pour Noël garantie').'
                    <option value="42">'.$this->l('Livraison le lendemain garantie').'
                    <option value="43">'.$this->l('Date de livraison garantie').'
                    <option value="44">'.$this->l('Envoi le lendemain').'
                    <option value="45">'.$this->l('Options pour l’adresse de livraison').'
                    <option value="46">'.$this->l('Réductions possibles sur les frais de livraison').'
                    <option value="47">'.$this->l('Livraison le samedi possible').'
                    <option value="48">'.$this->l('Livraison possible le dimanche').'
                    <option value="49">'.$this->l('Livraison possible le weekend').'
                    <option value="50">'.$this->l('Livraison possible en soirée').'
                    <option value="51">'.$this->l('Réduction sur la première commande').'
                    <option value="52">'.$this->l('10% de réduction sur la première commande').'
                    <option value="53">'.$this->l('20% de réduction sur la première commande').'
                    <option value="54">'.$this->l('Réductions pour commandes groupées').'
                    <option value="55">'.$this->l('Tarif exclusif Shopzilla').'
                    <option value="56">'.$this->l('Article en solde').'
                    <option value="57">'.$this->l('Options de paiement').'
                    <option value="58">'.$this->l('Crédit disponible').'
                    <option value="59">'.$this->l('Achetez maintenant, payez plus tard').'
                    <option value="60">'.$this->l('Achetez maintenant, payez l’année prochaine').'
                    <option value="61">'.$this->l('Support téléphonique').'
                    <option value="62">'.$this->l('Emballage cadeau disponible').'
                    <option value="63">'.$this->l('Assurance disponible').'
                    <option value="64">'.$this->l('Demande gratuite de catalogue').'
                    <option value="65">'.$this->l('Stock France uniquement').'
                    <option value="66">'.$this->l('Cadeau offert pour la première commande').'
                    <option value="67">'.$this->l('Bon d’achat offert avec le premier achat').'
                </select>
            </td>
        </tr>
        <tr><td>'.$this->l('Offrir les frais de port').'</td><td>'.$form_shipping.'</td></tr>
    </table>
    <hr/>
    <b>'.$this->l('Catégories').'</b><br/>
    '.$ulTree.'
    <hr/>
    <input class="button" name="btnSubmit" value="'.$this->l('Exporter').'" type="submit" />
    </form>
</div>';
?>