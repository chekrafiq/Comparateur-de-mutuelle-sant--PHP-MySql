<?php

include ("_kernix_/var.inc.php3");

setcookie("KERNIX" . $g_version,'',time()-3600,'/');
setcookie("KERNIXSEED",'',time()-3600);

echo "- KERNIX RESET<br>";
echo "- [ " . $HTTP_COOKIE_VARS["KERNIX" . $g_version] . " ]<br>";
echo "- [ " . $HTTP_COOKIE_VARS["KERNIXSEED"] . " ]<br>";

if (isset($HTTP_COOKIE_VARS["KERNIX" . $g_version])) echo "- ATTENTION : cookie KERNIX$g_version est pr�sent!<br>";
if (isset($HTTP_COOKIE_VARS["KERNIXSEED"])) echo "- ATTENTION : cookie KERNIXSEED est pr�sent!<br>";

?>


<br><br>- END [<?=time()?>]
