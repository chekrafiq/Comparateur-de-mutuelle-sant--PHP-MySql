<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_postitaction))
{
     include("sub/$p_postitaction.inc.php3");
}
else
{
     include("sub/view.inc.php3");
}

?>
