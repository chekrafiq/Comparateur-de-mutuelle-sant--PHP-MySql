<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_superuseraction))
{
  include("sub/" . $p_superuseraction . ".inc.php3");
}
else
{
  include("sub/home.inc.php3");
}

?>

