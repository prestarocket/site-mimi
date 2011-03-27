<?php
$this->_html .= '
<div id="leguide" class="comparator" style="display:none;">
    <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
    <input type="hidden" name="comparator" value="leguide"/>
    <hr/>
    <h2>'.$this->l('Export Leguide').'</h2>
    <hr/>
    '.$this->l('Exporter en').' '.$form_languages.'
    <hr/>
    <table>
        <tr><td>'.$this->l('Exporter les produits avec un stock à 0').'</td><td>'.$form_stock_zero.'</td></tr>
        <tr><td>'.$this->l('Exporter les déclinaisons').'</td><td>'.$form_combination.'</td></tr>
        <tr><td>'.$this->l('Transporteur').'</td><td>'.$form_carriers.'</td></tr>
        <tr><td>'.$this->l('Délais de livraison').'</td><td>'.$form_shipping_time.'</td></tr>
        <tr><td>'.$this->l('Calcul des frais de port selon la zone').'</td><td>'.$form_zones.'</td></tr>
        <tr><td>'.$this->l('Offrir les frais de port').'</td><td>'.$form_shipping.'</td></tr>
        <tr><td>'.$this->l('Garantie').'</td><td>'.$form_warranty.'</td></tr>
    </table>
    <hr/>
    <b>'.$this->l('Catégories').'</b><br/>
    '.$ulTree.'
    <hr/>
    <input class="button" name="btnSubmit" value="'.$this->l('Exporter').'" type="submit" />
    </form>
</div>'
?>
