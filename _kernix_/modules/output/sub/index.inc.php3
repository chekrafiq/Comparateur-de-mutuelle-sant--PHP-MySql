<?php

if (in_array($p_format,array("xml","XML")))
{
  $p_format = "XML";
}
elseif (in_array($p_format,array("pdf","PDF")))
{
  $p_format = "PDF";
}
elseif (in_array($p_format,array("wap","WAP","wml","WML")))
{
  $p_format = "WAP";
}
elseif (in_array($p_format,array("txt","TXT","text","TEXT")))
{
  $p_format = "TXT";
}
elseif (in_array($p_format,array("print","PRINT")))
{
  $p_format = "PRINT";
}
elseif (in_array($p_format,array("catalog","catalogue","CATALOG")))
{
  $p_format = "CATALOG";
}
else
{
  $p_format = "XML";
}

if (!isset($p_idref))
{
  $p_idref = 2;
}

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
$ref = $c_db->object_result();

if ($ref->visibilityflag == 0) die("this page can't be ssen");

include("$g_modulespath/output/sub/$p_format.inc.php3");

?>
