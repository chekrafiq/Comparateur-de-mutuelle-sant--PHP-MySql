<?php
if ($g_headerflag == 1)
{
//  header ("Last-Modified: " . date("r", time()-60)); 
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
  header ("Cache-Control:  max-age=3600, must-revalidate");  
}

if ($g_cookieflag == 1)
{
  include("$g_modulespath/cookie/sub/site.inc.php3");
}

include("$g_incpath/lang/site" . $g_lang . ".inc.php3");

include("$g_modulespath/header/sub/index.inc.php3");
?>

<body>

<a name=TOP></a>

<?php include("$g_designpath/$g_design/main.inc.php3");  ?>

<?php include("$g_designpath/common/endpage.inc.php3"); ?>

 </body>
</html>
