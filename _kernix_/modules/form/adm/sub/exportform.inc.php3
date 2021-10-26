<?php

$l_sql = "SELECT * FROM $table_post";
$c_db->query($l_sql);

echo "<table width=100%>";

while ($obj = $c_db->object_result())
{
  $l_tabfields = explode("&&",$obj->post);
  $i = 0;
  $sep = "";
  echo "<tr><td class=main>";
  while ($l_tabfields[$i])
  {
    $l_tabnv = explode("==",$l_tabfields[$i]);
    print($sep.$l_tabnv[1]);
    $i++;
    $sep = ";;";
  }
  echo "</td></tr>";
}
echo "</table><br>";

?>
