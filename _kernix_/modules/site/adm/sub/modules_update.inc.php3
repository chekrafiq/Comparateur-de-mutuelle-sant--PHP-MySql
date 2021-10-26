<?php
if ($p_idpub == "")
{
  $p_idpub = "NULL";
}

if ($p_idpoll == "")
{
  $p_idpoll = "NULL";
}

$l_sql = "UPDATE $table_ref SET logflag = '$p_logflag', refreshflag = '$p_refreshflag',idpoll = $p_idpoll, idegroup = '$p_idegroup', gbflag = '$p_gbflag', idboard = '$p_idboard', idform = '$p_idform', pagenotifierflag = '$p_pagenotifierflag', ratingflag = '$p_ratingflag', idpub = $p_idpub, updatedate = '$l_date'  WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/modules_view.inc.php3");
?>
