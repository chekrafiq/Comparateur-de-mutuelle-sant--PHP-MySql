<?php
$table_port = "port";
$table_portzone = "port_zone";
$table_portsupplier = "port_supplier";

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_portaction))
{
     include("sub/$p_portaction.inc.php3");
}
else
{
     include("sub/home.inc.php3");
}

?>
