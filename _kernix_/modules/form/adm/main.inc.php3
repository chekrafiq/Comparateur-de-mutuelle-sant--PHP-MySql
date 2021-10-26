<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$table_post = $table_formpost;

if (isset($p_formaction))
{
     include("sub/$p_formaction.inc.php3");
}
else
{
     include("sub/list.inc.php3");
}

?>
