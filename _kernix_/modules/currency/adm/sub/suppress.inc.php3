<?php

if ($adm->idcurrency == $p_idcurrency)
{
  show_response("cette monnaie ne peut �tre effac�e<br>monnaie de base du site<br>");
}
elseif (($p_idcurrency != 1) && ($p_idcurrency != 2))
{
  $l_sql = "DELETE FROM $table_currency  WHERE idcurrency = '$p_idcurrency'";
  $c_db->query($l_sql);
  show_response("effacement �ffectu�<br>");
}
else
{
  show_response("cette monnaie ne peut �tre effac�e<br>");
}

include("sub/list.inc.php3");

?>
