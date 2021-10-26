<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$table_post      = $table_boardpost;

if (isset($p_boardaction))
{
  include("sub/$p_boardaction.inc.php3");
}
else
{
  include("sub/list.inc.php3");
}

?>
