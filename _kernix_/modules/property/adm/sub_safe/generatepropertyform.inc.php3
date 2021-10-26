<?php

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_tab = explode("&&",$obj->structure);

?>

<form method=post action="<?php echo "$PHP_SELF"; ?>">
<input type=hidden name=p_propertyaction value=result>
<input type=hidden name=p_siteadmaction value=property_update>
<input type=hidden name=p_idref value="<?php echo "$p_idref"; ?>">
<input type=hidden name=p_idproperty value="<?php echo "$p_idproperty"; ?>">
<table align=center width=100% align=center> 
   <tr>
    <td align=left class=color1 width=90% colspan=2>
      :: les options
    </td> 
   </tr>

<?php

$i = 0;
while($l_tab[$i])
{
$l_prop = explode(";;",$l_tab[$i]);
print("<tr><td align=right class=color2 width=30%  valign=top>" . $l_prop[0]  . "</td>");
print("<td class=color3 align=left>");
if ($l_prop[1] == 0)
 {
      print("<input type=text size=50 class=text name=\"" . $l_prop[0]  ."\" value=\"" . $l_prop[2] . "\">");
 }

if ($l_prop[1] == 2)
 {
      $l_options = explode(",",$l_prop[2]);
      print("<select name=\"" . $l_prop[0]  ."\">");
      $j = 0;
      while ($l_options[$j])
      {
      print("<option value=\"" . $l_options[$j] . "\"> --- " . $l_options[$j]) . " --- </option>";
      $j++;
      }
      print("</select>");
 }
if ($l_prop[1] == 1)
 {
      print("<textarea cols=50 rows=10 name=\"" . $l_prop[0]  ."\">" . $l_prop[2] . "</textarea>");
 }
print("</td></tr>");
$i++;

}
?>

</table>
<br>
<input type=submit class=button value="validez">
</form>

<br>

<?php /*show_back();*/ ?>
