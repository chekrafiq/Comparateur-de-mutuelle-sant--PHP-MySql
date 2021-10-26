<?php

// Update purchase flag
$l_sql = "UPDATE $table_visitor SET purchase_flag = 1 WHERE idclient = '$command->idclient'";
$c_db->query($l_sql);

// Update nb purchase
$l_sql = "UPDATE $table_client SET nbpurchase = nbpurchase + 1, lastpurchasedate = '$l_date' WHERE idclient = '$command->idclient'";
$c_db->query($l_sql);

?>
