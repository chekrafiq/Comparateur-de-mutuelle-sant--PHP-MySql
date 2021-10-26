<?php

if (!isset($g_numsession))
{
  $l_caddie_error_msg = $gl_error_empty;
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession' AND (status = '0' OR status = '2')";
$c_db->query($l_sql);

if (!($c_db->numrows > 0))
{
  $l_caddie_error_msg = $gl_error_empty;
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$l_sql = "SELECT C.*, Z.* FROM $table_client AS C, $table_zone AS Z WHERE C.email1 = '" . $_POST['p_email1'] . "' AND C.password = '$p_password' AND C.idportzone = Z.id_portzone";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  $l_back = "history";
  $l_caddie_error_msg = $gl_error_identification;
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$client = $c_db->object_result();

if (empty($client->lastname) || empty($client->firstname) || empty($client->address) || empty($client->zipcode) || empty($client->town) || empty($client->idportzone) || empty($client->phone))
{
  $l_caddie_error_msg = $gl_error_missinginfo;
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$l_sql = "UPDATE $table_visitor SET idclient = '$client->idclient' WHERE idvisitor = '$g_idvisitor'";
$c_db->query($l_sql);


//----- idcommand
$l_sql = "SELECT idcommand, status FROM $table_command WHERE numsession = '$g_numsession'";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $g_idcommand = $c_db->result(0,"idcommand");
  if (($c_db->result(0,"status") >= 3) || ($c_db->result(0,"status") == 1))
  {
    $l_caddie_error_msg = $gl_error_outdated;
    include("$g_modulespath/command/sub/_error.inc.php3");
    return 0;
  }
}
else
{
  $l_sql = "INSERT INTO $table_command (numsession, status, date) values ('$g_numsession', '2', '$l_date')";
  $c_db->query($l_sql);
  $g_idcommand = $c_db->get_id();
}
//----- / idcommand


include("$g_modulespath/command/sub/command_bill.inc.php3");

include("$g_modulespath/command/sub/command_store.inc.php3");
?>
<br><input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">
<?php
if (ereg("TEST",$adm->paymentmode))
{
  $l_paymentmode    = "TEST";
  $l_title          = "TEST"; 
  include("$g_modulespath/command/sub/command_payment.inc.php3");
}

if (ereg("CHQ",$adm->paymentmode))
{
  $l_paymentmode    = "CHQ";
  $l_title          = "cheque"; 
  include("$g_modulespath/command/sub/command_payment.inc.php3");
}

if (ereg("CCB",$adm->paymentmode))
{
  $l_paymentmode    = "CCB";
  $l_title          = "CB"; 
  include("$g_modulespath/command/sub/command_payment.inc.php3");
}

?>
<br>
