<?php

$l_sql = "SELECT * FROM $table_affiliate WHERE email != ''";
$c_db->query($l_sql);
if (($n =$c_db->numrows) == 0)
{
     show_response("ERREUR : aucun email."); 
     return 0;
}

$l_header  = "";
if ($p_reply != "")
{
     $l_header .= "From: $g_sitename <$p_reply>\n";
     $l_header .= "Reply-To: $p_reply\n";
     $l_header .= "Errors-to: $adm->email\n";
}

for ($i=0;$i<$n;$i++)
{
     $l_to = $c_db->result($i,"email");
     $l_body = "$p_body\n\n\n";
     if (isset($p_commandflag) || isset($p_accountflag))
     {
	  $l_body .= "Etat actuel de votre compte :\n\n";
     }
     if (isset($p_accountflag))
     {
	  $l_body .= "somme en francs : " . $c_db->result($i,"currentaccount")  ."\n\n";
     }
     if (isset($p_commandflag))
     {
	  $l_body .= "nombre de commandes : " . $c_db->result($i,"currentorder");
     }
     $l_body .= "\n\n\npour modifier votre profile : $g_urlroot$g_clientadminpage";
     print("$l_to<br>$p_subject<br>$l_body<br>$l_header<hr>");
     if ($g_pubflag == 1) $l_body .= $g_pubmsg;
     if ($g_sendflag == 1) mail($l_to, $p_subject, $l_body, $l_header);
}

?>
