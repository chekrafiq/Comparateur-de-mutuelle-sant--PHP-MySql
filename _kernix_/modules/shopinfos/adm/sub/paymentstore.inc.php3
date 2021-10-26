<?php

$l_sql = "UPDATE $table_payment SET poption = '$p_poption', merchantname = '$p_merchantname', merchantnum = '$p_merchantnum', merchantrank = '$p_merchantrank', language = '$p_language', bankurl = '$p_bankurl', testflag = '$p_testflag', homepage = '$p_homepage' WHERE idpayment = '$p_idpayment'";
$c_db->query($l_sql);

show_response("modification effectuée");

include("sub/paymentview.inc.php3");

?>
