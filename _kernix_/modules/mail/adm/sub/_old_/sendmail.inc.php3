<?php

$l_header  = "";
$l_header .= "From: $g_sitename <$p_from>\n";
$l_header .= "Reply-To: $p_from\n";

if ($g_pubflag == 1) {$p_body .= $g_pubmsg;}
if ($g_sendflag == 1) {mail($p_to,$p_subject,$p_body,$l_header,"-f$adm->email");}

include("sub/list.inc.php3");

?>
