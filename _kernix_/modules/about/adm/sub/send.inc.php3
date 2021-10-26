<?php

$l_email = $adm->email;

$l_header  = "";
$l_header .= "From: $g_sitename <$l_email>\n";
$l_header .= "Reply-To: $l_email\n";
$l_header .= "Errors-To: $adm->email\n";
if ($g_sendflag == 1)
{
     mail($g_kernixcontact,"[$g_sitename] $p_type " . show_date($l_date),$p_txt,$l_header);
}
     
show_response("le message a bien été transmis.");


include("$g_modulespath/about/adm/sub/infos.inc.php3");
show_hr();
include("$g_modulespath/about/adm/sub/comments.inc.php3");

?>
