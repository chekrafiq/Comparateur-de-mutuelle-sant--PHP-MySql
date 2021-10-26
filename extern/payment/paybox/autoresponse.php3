<?php

include("_kernix_/var.inc.php3");

$table_command = "command";
$table_session = "session";

$g_ipsec       = "195.101.99";

$p_paymentmode = 'CCB';
$g_debugmode   = 1;

list($p_idcommand,$p_numsession) = explode("|",$p_cmd);

if ((strlen($p_autoris) > 1) && (substr($REMOTE_ADDR,0,10) == $g_ipsec))
{
  $l_sql = "UPDATE $table_command SET status = '4', refpayment = '$p_transac - $p_autoris' WHERE idcommand = '$p_idcommand' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$p_numsession' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  include("$g_modulespath/command/sub/command_mail.inc.php3");
  $l_title = "OK";
}
elseif (substr($REMOTE_ADDR,0,10) != $g_ipsec)
{
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERROR : BAD SERVER : $REMOTE_ADDR' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);
  $l_title = "ERROR IP";
  $l_msg   = "ERROR : BAD SERVER : $REMOTE_ADDR";
}
else
{ 
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERROR : CCB' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);
  $l_title = "ERROR";
  $l_msg   = "ERROR : CCB";
}

if ($g_debugmode == 1)
{
  mail($g_kernixemail,"[PAYBOX] " . $l_title . " : commande $p_idcommand : $montant [$g_sitename]",$l_msg,"From: boutique $g_sitename <$g_kernixemail>","-f$g_kernixemail");
}

$c_db->close();

?>
