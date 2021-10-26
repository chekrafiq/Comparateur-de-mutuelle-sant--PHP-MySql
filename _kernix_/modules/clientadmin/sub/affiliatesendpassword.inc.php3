<?php
$validator = new Validator();
$l_login = strtoupper($p_login);
$l_sql = "SELECT * FROM $table_affiliate WHERE login = '$l_login'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_ca_response("ce login n'est pas présent");
     show_ca_back();
     return 0;
     
}

$affiliate = $c_db->object_result();

$l_header  = "";
$l_header .= "From: $g_sitename <no@reply.mail>\n";
$l_header .= "Reply-To: $g_sitename <no@reply.mail>\n";
$l_header .= "Errors-to: $adm->email\n";

$l_title = "$g_sitename vous envoie votre mot de passe.";

$l_body = "";
$l_body .= "Bonjour $affiliate->firstname $affiliate->lastname,\n";
$l_body .= "\n\nvotre mot de passe d'affilié est : $affiliate->password\n";
$l_body .= "\n\nCordialement, \n";
$l_body .= "L'équipe de $g_sitename.\n";

if ($g_pubflag == 1) $l_body .= $g_pubmsg;
if ($g_sendflag == 1) mail($affiliate->email, $l_title, $l_body, $l_header);

show_ca_response("le password a été envoyé");
include("$g_modulespath/clientadmin/sub/affiliatehome.inc.php3");

?>
