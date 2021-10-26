 <HTML>
<center>
<H3><font color=009900 size=6>Champ Data en sortie d'API </H3></font>
</center>
<br><hr>
</HTML>
<?php
print("$DATA");
?>
<HTML>
<center>
<H3><font color=009900 size=6>Liste des champs en sortie d'API</H3></font>
</center>
<br><hr>
</HTML>

<?php

//Passage des 8 parametres à la fonction Response

$sips_result=exec("sips_response $DATA");

print("$sips_result");

//on separe les differents champs et on les met dans un tableau

$tableau = explode ("!", $sips_result);

$sips_code = $tableau[1];
$sips_error = $tableau[2];
$sips_merchant_id = $tableau[3];
$sips_amount = $tableau[4];
$sips_transaction_id = $tableau[5];
$sips_payment_means = $tableau[6];
$sips_payment_time = $tableau[7];
$sips_payment_date = $tableau[8];
$sips_response_code = $tableau[9];
$sips_payment_certificate = $tableau[10];
$sips_authorisation_id = $tableau[11];
$sips_currency_code = $tableau[12];
$sips_card_number = $tableau[13];
$sips_return_context = $tableau[14];
$sips_caddie = $tableau[15];
$sips_data = $tableau[16];

//si le code retour est egal a -1, on affiche un message d'erreur

if ($sips_code == "-1")
        {
        print("<br><hr><br>\n");
        print("<center><b><H3>\n");
        print(" API call error.\n");
        print("<br><br>\n");
        print("Error message :  $sips_error\n");
        print("</H3></b></center>\n");
        print("<br><hr><br>\n");
        }
print("<center>\n");
print("<H3><font color=009900 size=6>Reponse manuelle du serveur de paiement</H3></font>\n");
print("</center>\n");
print("<br><hr>\n");
print("<b><h4>\n");
print("<br>merchant_id : $sips_merchant_id\n");
print("<br>amount : $sips_amount\n");
print("<br>transaction_id : $sips_transaction_id\n");
print("<br>payment_means: $sips_payment_means\n");
print("<br>payment_time : $sips_payment_time\n");
print("<br>payment_date : $sips_payment_date\n");
print("<br>response_code : $sips_response_code\n");
print("<br>payment_certificate : $sips_payment_certificate\n");
print("<br>authorisation_id : $sips_authorisation_id\n");
print("<br>currency_code : $sips_currency_code\n");
print("<br>card_number : $sips_card_number\n");
print("<br>return_context: $sips_return_context\n");
print("<br>caddie : $sips_caddie\n");
print("<br>data: $sips_data\n");
print("<br><br><hr>");

?>
