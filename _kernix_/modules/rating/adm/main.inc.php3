<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$table_result = $table_ratingresult;

$l_nboptions = 5;

if (isset($p_ratingaction))
{
     include("sub/$p_ratingaction.inc.php3");
}
else
{
     include("sub/viewrating.inc.php3");
}

?>
