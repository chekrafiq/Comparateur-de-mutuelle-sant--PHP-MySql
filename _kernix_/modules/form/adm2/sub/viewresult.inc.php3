<table align=center width=90%>

<?php

$l_sql = "SELECT * FROM $table_result WHERE idformresult = '$p_idformresult'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_tabfields = explode("&",$obj->result);
$i = 0;
while ($l_tabfields[$i])
{
     print("<tr>");
     $l_tabnv = explode("=",$l_tabfields[$i]);
     if (!ereg("^p_",$l_tabnv[0]))
     {
	  print("<td align=right valign=top class=color2>" . urldecode($l_tabnv[0]) . " &nbsp;</td>\n");
	  print("<td align=left valign=top class=listlight>&nbsp;" . urldecode($l_tabnv[1]) . " &nbsp;</td>\n");
     }
     $i++;
     print("</tr>");
}


?>

</table>
<br>

<?php show_back(); ?>
