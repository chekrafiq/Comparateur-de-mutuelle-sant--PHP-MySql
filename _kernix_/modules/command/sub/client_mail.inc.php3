<br>

<?php

$l_sql = "SELECT login, password FROM $table_client WHERE email1 = '$p_email' OR email2 = '$p_email'";
$c_db->query($l_sql);

if (!$c_db->numrows)
{
  $l_back = "history";
  $l_msg = "cet email n'a pas été trouvé dans notre base";
  print($l_msg);
}
else
{
  $l_login    = strtolower($c_db->result(0,"login"));
  $l_password = strtolower($c_db->result(0,"password"));
  $l_body  = "login : $l_login\n";
  $l_body .= "password : $l_password";
  if ($g_pubflag == 1) $l_body .= $g_pubmsg;
  if (($g_sendflag == 1) && $command->idcommand) mail($p_email, "compte client [$g_sitename]", $l_body, "From: $g_sitename <$adm->email>\nErrors-to: $adm->email\n");
  $l_back = "history";
  $l_msg = "un email vient d'être envoyé";
  print($l_msg);
}

?>

<br><br>
<a href="javascript:history.back();" class="caddielink">&#171; <?php print($gl_back); ?></a>
