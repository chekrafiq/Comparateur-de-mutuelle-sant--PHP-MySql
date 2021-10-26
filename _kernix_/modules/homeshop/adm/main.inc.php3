<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (!isset($p_shopaction))
{
  include("$g_modulespath/homeshop/adm/sub/home.inc.php3");
}
else
{
  include("$g_modulespath/homeshop/adm/sub/$p_shopaction.inc.php3");
}


?>

