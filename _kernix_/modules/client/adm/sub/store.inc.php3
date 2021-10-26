<?php

$l_login   = strtoupper($p_login);
$l_town    = strtoupper($p_town);
$p_address = ereg_replace("\r?\n"," ",$p_address);

$l_country = $p_idportzone;

$l_sql = "UPDATE $table_client SET login = '$l_login',password = '$p_password',title = '$p_title',firstname = '$p_firstname',lastname = '$p_lastname',company = '$p_company',email1 = '$p_email1',phone = '$p_phone',cellphone = '$p_cellphone',fax = '$p_fax',address = '$p_address',zipcode = '$p_zipcode',town = '$l_town',idportzone = '$l_country' WHERE idclient = '$p_idclient'";
$c_db->query($l_sql);

show_response("enregistrement effectué");

include("sub/view.inc.php3");

?>

