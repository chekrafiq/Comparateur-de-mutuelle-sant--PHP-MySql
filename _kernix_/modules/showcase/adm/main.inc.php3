<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$table_sp       = "showcaseproduct";

if (isset($p_showcaseaction))
{
     include("sub/$p_showcaseaction.inc.php3");
}
else
{
     include("sub/list.inc.php3");
}

?>
