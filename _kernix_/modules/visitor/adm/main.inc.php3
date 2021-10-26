<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$l_max         = "50";

if (isset($p_visitoraction))
{
     include("sub/" . $p_visitoraction . ".inc.php3");
}
else
{
     include("sub/list.inc.php3");
     print("<br>");
     show_hr();
     include("sub/specifyone.inc.php3");
}

?>
