<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$l_nboptions = 10;

if (isset($p_pollaction))
{
     include("$g_modulespath/poll/adm/sub/$p_pollaction.inc.php3");
}
else
{
     include("sub/list.inc.php3");
}

?>
