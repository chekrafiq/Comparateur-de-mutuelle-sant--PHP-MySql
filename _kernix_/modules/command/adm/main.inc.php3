<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (!isset($p_commandaction))
{
  include("$g_modulespath/command/adm/sub/home.inc.php3");
}
else
{
  include("$g_modulespath/command/adm/sub/$p_commandaction.inc.php3");
}

?>
