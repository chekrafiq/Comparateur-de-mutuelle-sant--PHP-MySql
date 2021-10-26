<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$l_sql = "SELECT * FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
$c_db->query($l_sql);

if (isset($p_currencyaction))
{
     include("sub/$p_currencyaction.inc.php3");
}
else
{
     include("sub/list.inc.php3");
}

?>
