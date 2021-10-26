<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

$g_popserver = $adm->popserver;
$l_poplogin = $c_adm->search('poplogin');
$l_poppassword = $c_adm->search('poppassword');

if (empty($l_poplogin) && !empty($p_poplogin))
{
  $l_poplogin = $p_poplogin;
  $l_poppassword = $p_poppassword;
}

//echo "-" .  $l_poplogin . "-" .  $l_poppassword . "-<hr>";

if (isset($p_mailaction))
{
     include("sub/" . $p_mailaction . ".inc.php3");
}
else
{
     include("sub/home.inc.php3");
}
?>
