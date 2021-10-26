<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_egroupaction))
{
     include("sub/$p_egroupaction.inc.php3");
}
else
{
     include("sub/egroup_list.inc.php3");
}

?>




