<?php

if (!isset($command->idcommand))
{
  return 0;
}

$l_sql = "UPDATE $table_command SET status = '4' WHERE idcommand = '$command->idcommand' AND status = '3'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$command->numsession' AND status = '3'";
$c_db->query($l_sql);

$l_sql = "SELECT description FROM $table_session  WHERE numsession = '$command->numsession' AND status = '4'";
$c_db->query($l_sql);
$l_obj = $c_db->object_result();

$table_sp_parc		= "sp_parc";
$table_sp_poche		= "sp_poche";
$table_sp_services	= "sp_services";
$table_sp_produits	= "sp_produits";
$table_sp_adresse	= "DTWH_ADRESSE";
$table_sp_servicepoche	= "DTWH_SERVICE_POCHE";
$table_sp_tarifs	= "DTWH_TARIFS";
$table_sp_ce		= "sp_clubexpress";
$table_sp_resa		= "sp_resa";

$l_tabpoche = get_pochebycode(get_codepoche($l_obj->description));
$l_tabentree = explode(" ", trim(get_dateentree($l_obj->description)));
$l_tabentree2 = explode("/", $l_tabentree[0]);
make_resa($l_tabpoche["idpoche"], $l_tabentree2[2]."-".$l_tabentree2[1]."-".$l_tabentree2[0]);

include("$g_modulespath/command/sub/command_mail.inc.php3");

$g_design        = "zero";
$p_za            = "command";
$p_commandaction = "command_back";

$p_transacflag   = "OK";

$g_cookieflag = 0;

include("$g_designpath/index_site.inc.php3");

?>
