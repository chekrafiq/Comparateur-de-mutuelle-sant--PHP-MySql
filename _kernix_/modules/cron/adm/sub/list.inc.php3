<?php

$l_sql = "SELECT * FROM $table_cron ORDER BY name";
$c_db->query($l_sql);

?>


<table width="90%">
<tr>
 <td class="color2">&nbsp; servive</td>
 <td class="color2" align="center">frequency</td>
 <td class="color2" align="center">option</td>
 <td>&nbsp;</td>
</tr>


<?php
while ($obj = $c_db->object_result()):
if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
?>

<tr>

<form action="<?=$PHP_SELF?>" method="POST"> 
<input type="hidden" name="p_cronaction" value="store">
<input type="hidden" name="p_name" value="<?=$obj->name?>"> 

<?php

print("<td class=$l_class><img src=http://kernix.inerd/pictures/adm/point.gif hspace=4 title=\"$obj->description\">$obj->name</td>\n");
print("<td class=$l_class align=center>" . build_select_csv("HOURLY,DAILY,WEEKLY,MONTHLY,YEARLY,NEVER",$obj->frequency,"p_frequency","") . "</td>\n");
if (!empty($obj->options))
{
  print "<td class=$l_class align=center>" . build_select_csv($obj->options,$obj->opt,"p_option","") . "</td>\n";
}
else
{
  print("<td class=$l_class>&nbsp;</td>\n");
}

?>

<td><input type="submit" value="&#187;" class="button"></td>

</form>

</tr>

<?php
endwhile;
?>

</table>

<br><br>
