<?php
$l_sql = "UPDATE $table_company SET companyname = '$p_companyname', forme = '$p_forme', capital = '$p_capital', siret = '$p_siret', num_tva = '$p_num_tva', ape = '$p_ape', address = '$p_address', zipcode = '$p_zipcode', country = '$p_country', town = '$p_town', phone1 = '$p_phone1', phone2 = '$p_phone2', fax = '$p_fax', email = '$p_email', service = '$p_service' where idcompany='1'";
$c_db->query($l_sql);

show_response("modification effectuée");

include("sub/view.inc.php3");
?>
