<?php

if ($p_flag != "dig") return 0;

include("_kernix_/var.inc.php3");

$table_boardpost = "boardpost";

?>

<html>

<header>

<title> <?php print("$g_sitename : page list"); ?> </title>

<META NAME="keywords"    CONTENT="<?php print("$g_sitename"); ?>">
<META NAME="description" CONTENT="<?php print("$g_sitename ' s page list"); ?>">
<META NAME="publisher"   CONTENT="KWO - http://www.kernix.com/kwo">
<META NAME="generator"   CONTENT="KerniX Web Office - ultimate ecommerce-portal solution - http://www.kernix.com">
<META NAME="robots"      CONTENT="noindex">

<LINK HREF="<?php print($g_skinpath); ?>/default/listpages.css" REL="stylesheet" TYPE="text/css">

</header>

<body>

<?php

//-- STD LIST
$l_sql = "SELECT * FROM $table_ref WHERE nodekey >= '01' AND visibilityflag = 1 AND idproperty <> 2";

$c_db->query($l_sql);
print("[ " . $c_db->numrows . " pages ]<br><br><br><br><br><br>");
while ($datas = $c_db->object_result())
{
$datas->description = ereg_replace("\n"," ",$datas->description);
print("<a href=$g_urldyn?p_idref=$datas->idref title=\"$datas->description\"><b>$datas->title</b></a> : $datas->description <br><br>\n");
}

$l_sql = "SELECT idref, idboard idboard FROM $table_ref WHERE idboard > 0 AND visibilityflag = 1";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $tab_pagenews[$i][0] = $obj->idref; 
    $tab_pagenews[$i][1] = $obj->idboard; 
    $i++;
  }
  $i = 0;
  while ($tab_pagenews[$i])
  {
    $l_idref = $tab_pagenews[$i][0];
    $l_idboard = $tab_pagenews[$i][1];
    $l_sql = "SELECT idpost, title, abstract FROM $table_boardpost WHERE idboard = " . $tab_pagenews[$i][1];
    $c_db->query($l_sql);
    while ($obj = $c_db->object_result())
    {
      print("<a href=$g_urldyn?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_idref=$l_idref title=\"$obj->abstract\"><b>NEWS : $obj->title</b></a> : $obj->abstract <br><br>\n");
    }
    $i++;
  }
}



?>

</body>
</html>
