<?php

$l_sql = "SELECT S.quantity, P.idproduct FROM $table_session AS S, $table_product AS P, $table_ref AS R WHERE S.numsession = $command->numsession AND S.idref = R.idref AND P.idproduct = R.idproduct";
$c_db->query($l_sql);

$i = 0;
while($session = $c_db->object_result())
{
  $tab_session[$i][0] = $session->idproduct;
  $tab_session[$i][1] = $session->quantity;
  $i++;
}
$n = $i;

$i = 0;
for($i=0; $i < $n; $i++)
{     
  $l_sql = "UPDATE $table_product SET stock = stock - " . $tab_session[$i][1] . " WHERE idproduct = " . $tab_session[$i][0];
  $c_db->query($l_sql);
}

?>
