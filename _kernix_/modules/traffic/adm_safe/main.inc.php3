<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$l_thisyear = date("Y");

if (isset($p_trafficaction))
{
     include("sub/$p_trafficaction.inc.php3");
}
else
{
     include("sub/home.inc.php3");
}

?>
