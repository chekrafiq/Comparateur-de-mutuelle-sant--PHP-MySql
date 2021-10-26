<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$p_idadm = 1;
$g_idusers = 0;

if (isset($p_usersaction))
{
     include("sub/$p_usersaction.inc.php3");
}
else
{
      include("sub/list.inc.php3");
}

?>
