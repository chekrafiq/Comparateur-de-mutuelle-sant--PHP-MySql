<?php

if (isset($p_clientadminaction))
{
  include("$g_modulespath/clientadmin/sub/" . $p_clientadminaction . ".inc.php3");
}
else
{
  include("$g_modulespath/clientadmin/sub/home.inc.php3");
}

?>
