<?php


$l_tabegroup = join(",",$p_tabegroup);

$l_tabegroup = "AND idegroup IN ($l_tabegroup)";

$l_sql = "UPDATE $table_email SET status = '2', unsubdate = '$l_date' WHERE email = '$p_email' $l_tabegroup";                 
$c_db->query($l_sql);

//print($l_sql);return 0;

show_ca_response("suppression(s) effectuée(s)");
include("$g_modulespath/clientadmin/sub/emailhome.inc.php3");

?>

