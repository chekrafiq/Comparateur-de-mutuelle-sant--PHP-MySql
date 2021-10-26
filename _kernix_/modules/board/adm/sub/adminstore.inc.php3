<?php

$l_sql = "UPDATE $table_board SET nbeleminlisttopic = '$p_nbeleminlisttopic', nbeleminlistreply = '$p_nbeleminlistreply', nbcarinabstract = '$p_nbcarinabstract', identificationlevel = '$p_identificationlevel', archiveflag = '$p_archiveflag', interactiveflag = '$p_interactiveflag', backendflag = '$p_backendflag', moderatorflag = '$p_moderatorflag', openextflag = '$p_openextflag' WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>
