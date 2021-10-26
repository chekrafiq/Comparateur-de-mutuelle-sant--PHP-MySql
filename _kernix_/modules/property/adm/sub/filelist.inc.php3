<?php

$l_sql = "SELECT * FROM $table_ref WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucune page associée");
  include("sub/view.inc.php3");
  return 0;
}

?>

<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="left">
   &nbsp; name
  </td>
  <td class="color2" align="center" width="13%">
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  print("<tr>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$g_urlroot/$g_modulespath/site/adm/?p_idref=$obj->idref\" class=truelink>$obj->idref</a>");
  print("</td>");
  print("<td class=$l_class align=left>");
  print("&nbsp;" . stripslashes($obj->name));
  print("</td>");
  print("<td class=$l_class align=center>" . show_date($obj->creationdate) . "</td>");
  print("</tr>");
}
?>
</table>
<br>

<?php show_back(); ?>
