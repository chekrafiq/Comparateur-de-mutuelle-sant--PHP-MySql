<?php

if (empty($p_deb) || empty($p_end) || empty($p_email))
{
  show_response("des informations sont manquantes.");
  show_back();
  return 0;
}

$l_deb = date2bdd($p_deb) . " 0:0:0";
$l_end = date2bdd($p_end) . " 23:59:59";

$l_sql = "SELECT C.*, Z.* FROM $table_client AS C, $table_zone as Z WHERE C.idportzone = Z.id_portzone AND C.date >= '$l_deb' AND C.date <= '$l_end'";
$c_db->query($l_sql);
$n = $c_db->numrows;

$l_out = "IDCLIENT\t";
$l_out .= "TITLE\t";
$l_out .= "FIRSTNAME\t";
$l_out .= "LASTNAME\t";
$l_out .= "ADDRESS\t";
$l_out .= "ZIPCODE\t";
$l_out .= "TOWN\t";
$l_out .= "COUNTRY\t";
$l_out .= "EMAIL\t";
$l_out .= "PHONE\t";
$l_out .= "WORKPHONE\t";
$l_out .= "MOBILE\t";
$l_out .= "FAX\t";
$l_out .= "COMPANY\t";
$l_out .= "JOB\t";
$l_out .= "LOGIN\t";
$l_out .= "PASSWORD\t";
$l_out .= "DATE\r\n";

while ($client = $c_db->object_result())
{
  $l_out .= $client->idclient . "\t";
  $l_out .= $client->title . "\t";
  $l_out .= $client->firstname . "\t";
  $l_out .= $client->lastname . "\t";
  $client->address = ereg_replace("\r?\n"," ",$client->address);
  $l_out .= $client->address . "\t";
  $l_out .= $client->zipcode . "\t";
  $l_out .= $client->town . "\t";
  $l_out .= $client->zone_name . "\t";
  $l_out .= $client->email1 . "\t";
  $l_out .= $client->phone . "\t";
  $l_out .= $client->workphone . "\t";
  $l_out .= $client->cellphone . "\t";
  $l_out .= $client->fax . "\t";
  $l_out .= $client->company . "\t";
  $l_out .= $client->job . "\t";
  $l_out .= $client->login . "\t";
  $l_out .= $client->password . "\t";
  $l_out .= show_date($client->date) . "\r\n";
}

//print("<br>$l_out");

$l_header  = "";
$l_header .= "From: boutique $g_sitename <$adm->email>\n";
$l_header .= "Reply-To: $adm->email\n";
$l_header .= "Errors-To: $adm->email\n";
$l_header .= "MIME-Version: 1.0\n";
$l_header .= "Content-Type: multipart/alternative; boundary=B97C1230\n";

$l_text  = "\nThis is a multi-part message in MIME format.";
$l_text .= "\n--B97C1230\nContent-Type: text/html; charset=\"iso-8859-1\"\n\n";
$l_text .= "FICHIER CLIENTS : de $p_deb à $p_end<br> $n lignes\n";
$l_text .= "\n--B97C1230\nContent-Type: text/plain; name=\"fichier_clients.txt\"\nContent-Transfer-Encoding: quoted-printable\nContent-Disposition: attachment; filename=\"fichier_clients.txt\"\n\n";
$l_text .= $l_out;
$l_text .= "\n--B97C1230--\n end of the multi-part";

if ($g_sendflag == 1) mail($p_email,"boutique $g_sitename : fichier clients [$p_deb,$p_end]",$l_text,$l_header);

show_response("email envoyé : $n lignes");
include("sub/files_home.inc.php3");

?>
