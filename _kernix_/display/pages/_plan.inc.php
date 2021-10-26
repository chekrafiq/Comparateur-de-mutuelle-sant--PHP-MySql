<?php
$l_refnotlisted = "";
$l_propertynolisted = "2,4,5";

$l_sql = "SELECT idref, name, title, nodekey, link FROM $table_ref WHERE nodekey >= '0101' AND visibilityflag = 1"; 
$l_sql .= ($l_propertynolisted != "") ? " AND idproperty NOT IN ($l_propertynolisted)" : "" ;
$l_sql .= ($l_refnotlisted != "") ? " AND idref NOT IN ($l_refnotlisted)" : "" ;
$l_sql .= " ORDER BY nodekey";
//echo "->$l_sql<br>";
$c_db->query($l_sql);

$j = 0;
$l_class		= "contenu";
$l_classlink		= "plan";
$l_col2 = 0;

while ($datas = $c_db->object_result())
{
  $l_description	= "";
  $l_description	= ereg_replace("\n"," ",trim($datas->accroche));
  $l_proof		= (strlen($datas->nodekey) / $g_nodekeylen) - 1;
  $l_space		= "";

  for ($i=1;$i<=$l_proof;$i++) { $l_space .= "&nbsp;"; }

  echo "<h$l_proof style='";
  if ($l_proof != 1) { echo "margin:0 0 0 20px;padding:'"; } else { echo "margin:10px 0 5px 10px;padding:0"; };
  echo "'>";
  echo "<a href='";
  if ($datas->link) echo $datas->link;
  else echo get_text_link($datas->name) . "__" . $datas->idref . ".html?p_flag=plan";
  echo "' class='$l_classlink"."$l_proof'>";
  echo $datas->name;
  echo "</a></h$l_proof>\n";
  $l_proof2 = $l_proof;
  $j++;
}
?>
