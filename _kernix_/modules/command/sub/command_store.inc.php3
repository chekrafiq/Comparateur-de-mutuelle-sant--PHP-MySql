<?php

// operation sur le port, monnaie, idaffiliate

$l_sql = "UPDATE $table_session SET billdate = '$l_date', status = '2' WHERE numsession = '$g_numsession'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_command SET billdate = '$l_date', idclient = '$client->idclient', status = '2', mode = 'NONE', quantity = '$g_quantity', priceht = '$g_priceht', pricettc = '$g_pricettc', pricettcport = '$g_pricettcport', currency = '$g_currencyisocode' WHERE idcommand = '$g_idcommand'";
$c_db->query($l_sql);

?>
