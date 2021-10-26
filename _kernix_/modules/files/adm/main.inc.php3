<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$l_base = "/home/web/$g_accountname/www/upload";

if (isset($p_fileaction))
{
     include("sub/$p_fileaction.inc.php3");
}
else
{
     include("sub/select_localfile.inc.php3");
     show_hr();
     include("sub/select_remotedir.inc.php3");
}

?>

