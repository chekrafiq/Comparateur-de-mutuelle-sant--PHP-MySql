<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_msgaction))
{
     include("sub/$p_msgaction.inc.php3");
}
else
{
     include("sub/list.inc.php3");
}

?>
