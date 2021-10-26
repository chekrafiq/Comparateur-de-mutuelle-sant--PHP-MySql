<?php

if (empty($p_deb) || empty($p_end) || empty($p_email))
{
  show_response("des informations sont manquantes.");
  show_back();
  return 0;
}

$l_deb = date2bdd($p_deb) . " 0:0:0";
$l_end = date2bdd($p_end) . " 23:59:59";

$l_sql = "SELECT * FROM $table_command WHERE validatedate >= '$l_deb' AND validatedate <= '$l_end' AND status = 20";
$c_db->query($l_sql);

$i = 0;
while ($command = $c_db->object_result())
{
  $tab_command[$i] = $command->idcommand;
  $i++;
}

$l_sql = "SELECT idsupplier, code FROM $table_supplier";
$c_db->query($l_sql);

while ($supplier = $c_db->object_result())
{
  $tab_supplier[$supplier->idsupplier] = $supplier->code;
}

$i     = 0;
$k     = 0;
$l_out = "";
while ($l_idcommand = $tab_command[$i])
{
  $l_sql = "SELECT * FROM $table_command WHERE idcommand = '$l_idcommand'";
  $c_db->query($l_sql);
  $command = $c_db->object_result();
  
  $l_sql = "SELECT * FROM $table_client WHERE idclient = '$command->idclient'";
  $c_db->query($l_sql);
  $client = $c_db->object_result();

  $l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
  $c_db->query($l_sql);
  while ($session = $c_db->object_result())
  {
    $j = 0;
    while ($j < $session->quantity)
    {
      $l_out .= show_date($command->date) . "\t";            // * DATE
      $l_out .= $client->lastname . "\t";                    // * NOM 
      $l_out .= $client->firstname . "\t";                   // * PRENOM
      $l_out .= $command->idcommand . "\t";                  // * REF.COM
      $l_out .= $session->productcode . "\t";                // * REF.PRODUIT
      $l_out .= $tab_supplier[$session->idsupplier] . "\t";  // * CODE FOURNISSEUR
      $l_out .= $session->description . "\t";                // * LIBELLE PRODUIT
      $l_out .= $session->pricettc . "\t";                   // * PRIX VENTE TTC
      $l_out .= $session->taxe . "\t";                       // * TAUX DE TVA
      $l_tvav = $session->pricettc - $session->priceht;      
      $l_out .= $l_tvav . "\t";                              // * TVA VENTE
      $l_out .= $session->priceht      . "\t";               // * PRIX DE VENTE HT
      $l_tmp  = $session->purchasepriceht + ($session->purchasepriceht * $session->taxe) / 100;
      $l_tvaa = $l_tmp - $session->purchasepriceht;
      $l_out .= $l_tmp . "\t";                               // * PRIX ACHAT TTC
      $l_out .= $session->purchasepriceht . "\t";            // * PRIX ACHAT HT
      $l_out .= $l_tvaa . "\t";                              // * TVA ACHAT
      $l_tmp  = $session->priceht - $session->purchasepriceht; 
      $l_out .= $l_tmp . "\t";                               // * MARGE HT
      $l_tmp  = $l_tvav - $l_tvaa;  
      $l_out .= $l_tmp . "\t";                               // * TVA SUR MARGE 
      $l_out .= $session->pricettc . "\t";                   // * MONTANT TTC PAYE CLIENT
      $l_tmp  = $command->pricettcport - $command->pricettc; 
      $l_out .= $l_tmp                 . "\t";               // * FRAIS DE PORT 
      $l_out .= $command->mode         . "\t";               // * MOYEN DE PAIEMENT 
      $l_out .= $command->infos        . "\t";               // * REFERENCES PAIEMENT
      $l_out .= $command->currency     . "\n";               // * DEVISE
      $j++;
      $k++;
    }
  }
  $i++;
}

//print("<br>$l_out");

$l_nblines = $k;

$l_header  = "";
$l_header .= "From: boutique $g_sitename <$adm->email>\n";
$l_header .= "Reply-To: $adm->email\n";
$l_header .= "Error-To: $adm->email\n";
$l_header .= "MIME-Version: 1.0\n";
$l_header .= "Content-Type: multipart/alternative; boundary=B97C1230\n";

$l_text  = "\nThis is a multi-part message in MIME format.";
$l_text .= "\n--B97C1230\nContent-Type: text/html; charset=\"iso-8859-1\"\n\n";
$l_text .= "FICHIER COMPTABLE : de $p_deb à $p_end<br> $l_nblines lignes\n";
$l_text .= "\n--B97C1230\nContent-Type: text/plain; name=\"fichier_comptable.txt\"\nContent-Transfer-Encoding: quoted-printable\nContent-Disposition: attachment; filename=\"fichier_comptable.txt\"\n\n";
$l_text .= "DATE\tNOM\tPRENOM\tREF.COM\tREF.PRODUIT\tCODE FOURNISSEUR\tLIBELLE PRODUIT\tPRIX VENTE TTC\tTAUX DE TVA\tTVA VENTE\tPRIX DE VENTE HT\tPRIX D'ACHAT TTC\tPRIX D'ACHAT HT\tTVA ACHAT\tMARGE HT\tTVA SUR MARGE\tMONTANT TTC PAYE CLIENT\tFRAIS DE PORT\tMOYEN DE PAIEMENT\tREFERENCES PAIEMENT\tDEVISE\n";
$l_text .= $l_out;
$l_text .= "\n\n--B97C1230--\n end of the multi-part";

if ($g_sendflag == 1) mail($p_email,"boutique $g_sitename : fichier comptable [$p_deb,$p_end]",$l_text,$l_header);

show_response("email envoyé : $l_nblines lignes");
include("sub/files_home.inc.php3");

?>
