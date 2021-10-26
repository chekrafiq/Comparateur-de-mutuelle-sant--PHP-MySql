<?php

$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);
if (!($c_db->numrows > 0))
{
  show_response("Erreur : la commande < $p_idcommand  > n'existe pas.");
  include("sub/home.inc.php3");
  return 0;
}
$command = $c_db->object_result();

if (($command->idclient == 0) && ($p_status != 0))
{
  show_response("Erreur : le client n'existe pas.");
  include("sub/home.inc.php3");
  return 0;
}
else
{
  $l_sql = "SELECT C.*, Z.zone_name FROM $table_client AS C, $table_zone AS Z WHERE C.idclient = '$command->idclient' AND C.idportzone = Z.id_portzone";
  $c_db->query($l_sql);
  $client = $c_db->object_result();
  $l_email = $client->email1;
}

if ($p_status == 0)
{
  $l_sql = "UPDATE $table_command SET status = '0' WHERE idcommand = '$p_idcommand'";
  $c_db->query($l_sql);

  $l_sql = "UPDATE $table_session SET status = '0' WHERE numsession = '$command->numsession'";
  $c_db->query($l_sql);

  $l_sql = "SELECT description FROM $table_session WHERE numsession = '$command->numsession'";
  $c_db->query($l_sql);
  $commanddetail = $c_db->object_result();  

  show_response("commande annulée");
  include("sub/home.inc.php3");
  return 0;
}



$l_sql = "SELECT * FROM $table_company";
$c_db->query($l_sql);
$company = $c_db->object_result();

if (($p_oldstatus == 4) && ($p_status > 4))
{
  if ($adm->stockmodeflag == 1)
  {
//    print("+stock<br>");
    include("$g_modulespath/command/adm/sub/maj_stock.inc.php3");
  }
  if ($command->idaffiliate)
  {
//   print("+affiliate<br>");
    include("$g_modulespath/command/adm/sub/maj_affiliate.inc.php3");
  }
//  print("+client<br>");
  include("sub/maj_client.inc.php3");
//  print("+supplier<br>");
  include("sub/maj_supplier.inc.php3");
  $l_sql = "SELECT * FROM $table_msg WHERE code = 'MAIL_CMD_CONFIRM'";
  $c_db->query($l_sql);
  $l_title = "confirmation commande < BTQ-" . sprintf("%05d",$command->idcommand) . " >";
  $l_content = bdd2txt($c_db->result(0,"description"));
  //include("sub/msg_send.inc.php3");  
}

if ($p_status == 20) $l_validate = ", validatedate = '$l_date'";

$l_sql = "UPDATE $table_command SET status = '$p_status' $l_validate WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);
$l_sql = "UPDATE $table_session SET status = '$p_status' $l_validate WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);
show_response("status modifié");

if ($p_status == 20)
{
  include("sub/home.inc.php3");
}
else
{
  include("sub/command_view.inc.php3");
}

?>
