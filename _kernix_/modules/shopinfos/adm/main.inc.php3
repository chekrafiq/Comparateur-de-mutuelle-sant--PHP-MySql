<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (!isset($p_shiadmaction))
{
  include("sub/view.inc.php3");
}
else
{
  include("sub/$p_shiadmaction.inc.php3");
}

?>
