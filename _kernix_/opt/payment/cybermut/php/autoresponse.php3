<?php

include("_kernix_/var.inc.php3");

$table_command = "command";
$table_session = "session";

putenv("CMKEYDIR=$g_absolutepath/_kernix_/opt/payment/cybermut");

/* DOC ----------
bool cybermut_testmac(string code_MAC, string version, string TPE, string cdate, string montant, string ref_commande, string texte_libre, string code_retour)
string cybermut_creerreponsecm(string phrase)
   -------------- */

if (cybermut_testmac($MAC,"1.2",$TPE,$date,$montant,$reference,$texte_libre,$code_retour))
{  
  $l_sql = "UPDATE $table_command SET status = '4', mode = 'CCB' WHERE idcommand = '$reference'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$texte_libre'";
  $c_db->query($l_sql);
  $l_title = "OK : ";
}
else            
{ 
  $l_sql = "UPDATE $table_command SET status = '3', mode = 'CCB' WHERE idcommand = '$reference'";
  $c_db->query($l_sql);
  $l_title = "ERROR : ";
}

cybermut_creerreponsecm($l_str);

mail($g_kernixemail,"[CYBERMUT] " . $l_title . "commande $reference : $montant [$g_sitename]","$TPE,$date,$montant,$reference,$texte_libre,$code_retour","From: boutique $g_sitename <$g_kernixemail>");

$c_db->close();

?>
