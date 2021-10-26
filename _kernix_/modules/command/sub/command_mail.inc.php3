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

$l_body  =  ($client->title == "M.") ? "Cher" : "Ch�re";
$l_body .= " $client->title $client->lastname,\n\n";
$l_body .= "Nous vous remercions d'avoir souscrit votre compl�mentaire sant� aupr�s d'AssurSant�.\n\n";
$l_body .= "Votre num�ro de commande est le : " . sprintf("%05d",$command->idcommand) . ".\n\n";
if ($command->mode == "CHQ")
{
  $l_body .= "Nous traitons votre dossier et vous renvoyons dans les plus brefs d�lais le contrat en 2 exemplaires�.\n\n";
  $l_body .= "A r�ception de votre contrat, veuillez nous retourner un exemplaire sign� ainsi que votre premier r�glement par ch�que.\n\n";
}
else
{
  $l_body .= "Nous traitons votre dossier et vous renvoyons dans les plus brefs d�lais le contrat en 2 exemplaires ainsi qu'une autorisation de pr�l�vement automatique.\n\n";
  $l_body .= "A r�ception de ces documents, veuillez nous retourner, sign�s, un exemplaire du contrat ainsi que l'autorisation de pr�l�vement.\n\n";
}
$l_body .= "D�s la souscription en ligne, vous b�n�ficiez d'une garantie imm�diate sans d�lais d'attente (sauf si date d'effet souhait�e post�rieure � la date du jour).\n\n";
$l_body .= "------------------------------------------------------------------------------\n";
$l_body .= "Rappel de votre commande :\n";

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);
$session = $c_db->object_result();

$l_body .= "Swiss Sant� Formule ".$session->productcode."\n";

$l_body .= "Total (TTC) : $command->pricettcport $command->currency\n";

$l_body .= "------------------------------------------------------------------------------\n\n";
$l_body .= "Nous restons � votre enti�re disposition pour plus d'informations sur notre site www.assursante.fr ou au 03 44 48 21 21.\n\n";
$l_body .= "Cordialement.\n\n";
$l_body .= "AssurSant�\n\n";

$l_title = "Accus� de r�ception de votre commande n�" . sprintf("%05d",$command->idcommand);

if (($adm->commandwarningflag == 1) && ($g_sendflag == 1) && $command->idcommand)
{
  mail($adm->email, $l_title . " [$command->mode]", $l_body, $l_header . "Bcc: $adm->commandwarningemail, $g_kernixemail\n");
}

if ($g_pubflag == 1) $l_body .= $g_pubmsg;
if (($g_sendflag == 1) && $command->idcommand) mail($client->email1, $l_title, $l_body, $l_header);

?>
