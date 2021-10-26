<?php

if (($p_affiliatemode != 0) && ($p_affiliatevalue == 0))
{
  show_response("ERROR : une valeur doit être précisée.");
  print("<br>");
  show_back();
  return 0;
}

if ($p_affiliatemode == 0)
{
  $p_affiliatevalue = 0;
}

$l_sql = "UPDATE $table_affiliate SET affiliatemode = '$p_affiliatemode', affiliatevalue = '$p_affiliatevalue' WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>


