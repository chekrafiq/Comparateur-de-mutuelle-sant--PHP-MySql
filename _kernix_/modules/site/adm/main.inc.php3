<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if ($home == "OK") $p_idref = $adm->idshop;

if (isset($p_siteadmaction))
{
  include("$g_modulespath/site/adm/sub/$p_siteadmaction.inc.php3");
}
elseif ($p_idref > 0)
{
  include("$g_modulespath/site/adm/sub/ref_view.inc.php3");
}
else
{
  $p_idref = 2;
  include("$g_modulespath/site/adm/sub/ref_view.inc.php3");
}   
?>
