<?php

if ($g_pubflag == 1) $l_content .= $g_pubmsg;
if ($g_sendflag == 1) mail($l_email, $l_title, $l_content, "From: boutique $g_sitename <$adm->email>\nErrors-to: $adm->email\n");

?>
