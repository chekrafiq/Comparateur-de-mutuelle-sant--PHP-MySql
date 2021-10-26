<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if ($p_affiliateflag == "adminvalues")
{
  $l_sql = "UPDATE $table_affiliateadm SET affiliatemode = '$p_affiliatemode', affiliatevalue = '$p_affiliatevalue', affiliatemax = '$p_affiliatemax'";
  $c_db->query($l_sql);
}

$l_sql = "SELECT affiliatemode,affiliatemax,affiliatevalue FROM $table_affiliateadm";
$c_db->query($l_sql);
$affiliateadm = $c_db->object_result();


if (isset($p_affiliateaction))
{
     include("sub/$p_affiliateaction.inc.php3");
}
else
{
     include("sub/home.inc.php3");
}

?>


