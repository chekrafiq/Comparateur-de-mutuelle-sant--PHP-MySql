<?php

$table_admsite = "adm_site";
$table_admshop = "adm_shop";
$table_command = "command";
$table_session = "session";
$table_client  = "client";
$table_zone    = "port_zone";
$table_company = "company";

if (!($command->idcommand > 0))
{
  $l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
  $c_db->query($l_sql);
  if ($c_db->numrows < 1) return 0; 
  $command = $c_db->object_result();
}

$l_sql = "SELECT * FROM $table_admsite, $table_admshop";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$l_sql = "SELECT * FROM $table_client WHERE idclient = '$command->idclient'";
$c_db->query($l_sql);
$client = $c_db->object_result();

$l_header  = "From: ASSURSANTE <$adm->email>\n";
$l_header .= "Reply-To: $adm->email\n";
$l_header .= "Errors-To: $adm->email\n";
$l_header .= "X-Mailer: KerniX WEB OFFICE\n";

$l_body  =  ($client->title == "M.") ? "Cher" : "Chère";
$l_body .= " $client->title $client->lastname,\n\n";
$l_body .= "Nous vous remercions d'avoir souscrit votre complémentaire santé auprès d'AssurSanté.\n\n";
$l_body .= "Votre numéro de commande est le : " . sprintf("%05d",$command->idcommand) . ".\n\n";
if ($command->mode == "CHQ")
{
  $l_body .= "Nous traitons votre dossier et vous renvoyons dans les plus brefs délais le contrat en 2 exemplaires .\n\n";
  $l_body .= "A réception de votre contrat, veuillez nous retourner un exemplaire signé ainsi que votre premier règlement par chèque.\n\n";
}
else
{
  $l_body .= "Nous traitons votre dossier et vous renvoyons dans les plus brefs délais le contrat en 2 exemplaires ainsi qu'une autorisation de prélèvement automatique.\n\n";
  $l_body .= "A réception de ces documents, veuillez nous retourner, signés, un exemplaire du contrat ainsi que l'autorisation de prélèvement.\n\n";
}
$l_body .= "Dès la souscription en ligne, vous bénéficiez d'une garantie immédiate sans délais d'attente (sauf si date d'effet souhaitée postérieure à la date du jour).\n\n";
$l_body .= "------------------------------------------------------------------------------\n";
$l_body .= "Rappel de votre commande :\n";

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);
$session = $c_db->object_result();

$l_body .= "Swiss Santé Formule ".$session->productcode."\n";

$l_body .= "Total (TTC) : $command->pricettcport $command->currency\n";

$l_body .= "------------------------------------------------------------------------------\n\n";
$l_body .= "Nous restons à votre entière disposition pour plus d'informations sur notre site www.assursante.fr ou au 03 44 48 21 21.\n\n";
$l_body .= "Cordialement.\n\n";
$l_body .= "AssurSanté\n\n";

$l_title = "Accusé de réception de votre commande n°" . sprintf("%05d",$command->idcommand);

if (($adm->commandwarningflag == 1) && ($g_sendflag == 1) && $command->idcommand)
{
  mail($adm->email, $l_title . " [$command->mode]", $l_body, $l_header . "Bcc: $adm->commandwarningemail, $g_kernixemail\n");
}

if ($g_pubflag == 1) $l_body .= $g_pubmsg;
if (($g_sendflag == 1) && $command->idcommand) mail($client->email1, $l_title, $l_body, $l_header);

?>
