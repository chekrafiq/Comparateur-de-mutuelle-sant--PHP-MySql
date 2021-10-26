<?php

$table_hash     = "hash";
$table_property = "property";
$table_ref      = "ref";

$l_sql = "SELECT * FROM $table_ref WHERE up = '2' AND val1 = '1'";
$c_db->query($l_sql);
$n = $c_db->numrows;
$n = floor(100 / $n);
$fp = fopen ("$g_cachepath/rubriques", "w+",1);
while ($obj = $c_db->object_result())
{
  if (!empty($obj->link))
  fwrite($fp,"<td class=rubrique onmouseover=\"this.style.background='white'\" onmouseout=\"this.style.background='#D6D9DB'\" width=$n% align=center><a href=$obj->link>$obj->name</a></td>\n");
  else
  fwrite($fp,"<td class=rubrique onmouseover=\"this.style.background='white'\" onmouseout=\"this.style.background='#D6D9DB'\" width=$n% align=center><a href=/?p_idref=$obj->idref>$obj->name</a></td>\n");
}
fclose($fp);


show_response("ecriture OK");
include("sub/home.inc.php3");

?>
