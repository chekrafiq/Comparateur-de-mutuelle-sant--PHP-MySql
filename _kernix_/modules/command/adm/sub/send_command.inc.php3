<?php

$l_email = $adm->email;

$l_header  = "";
$l_header .= "From: $g_sitename <$l_email>\n";
$l_header .= "Reply-To: $l_email\n";
$l_header .= "Errors-To: $adm->email\n";


$l_sql = "SELECT * FROM $table_command where idcommand = '$p_idcommand'";
$c_db->query($l_sql);
$l_row = $c_db->object_result();

$l_body = "";
$l_body .= "numero      : $l_row->idcommand \n";
$l_body .= "date        : " . show_datetime($l_row->date) . "\n\n\n";
$l_body .= "la commande :\n";
$l_body .= "-=-=-=-=-=-=-\n\n";

$l_command = ereg_replace(";", "\n\n-----------------\n\n", $l_row->description);
$l_command = ereg_replace("-", "\n", $l_command);

$l_body .= "$l_command";


if ($p_mailinfos == "commandclient")
{
     $l_body .= "le client :\n";
     $l_body .= "-=-=-=-=-=-\n\n";
     $l_sql = "SELECT * FROM client WHERE idclient = '$p_idclient'";
     $c_db->query($l_sql);
     $l_row = $c_db->object_result();
     $l_body .= "nom = $l_row->lastname\n";
     $l_body .= "prenom = $l_row->firstname\n";
     $l_body .= "email = $l_row->email1\n";
     $l_body .= "telephone = $l_row->phone\n";
     $l_body .= "adresse = $l_row->address\n";
     $l_body .= "ville = $l_row->town\n";
     $l_body .= "pays = $l_row->country\n";
}

if ($g_sendflag == 1) mail($p_email,"commande",$l_body,$l_header);

show_response("mail envoyé");

show_back();
?>





