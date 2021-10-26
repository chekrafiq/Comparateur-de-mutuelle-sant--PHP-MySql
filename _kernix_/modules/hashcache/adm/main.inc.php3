<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

function str2u($str)
{
     $out = get_text_link($str);
     $out = strtoupper($out);
     return $out;
}

if (isset($p_hcaction))
{
     include("sub/$p_hcaction.inc.php3");
}
else
{
     include("sub/home.inc.php3");
}

?>
