<?php

if ($g_caddie_error > 1)
{
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

include("$g_modulespath/command/sub/$p_commandaction.inc.php3");

?>
