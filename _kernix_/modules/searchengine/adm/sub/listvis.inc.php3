<?php

$p_keywords = strtoupper($p_keywords);

$l_sql = "SELECT * FROM $table_keywords WHERE keyword = '$p_keyword' ORDER BY date DESC";
$c_db->query($l_sql);

?>

<br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=50%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=color2 align=center colspan=2> &#187; visiteurs &#171; </td>
 </tr>
<?php

while ($obj = $c_db->object_result())
{
  $l_idvisitor = $obj->idvisitor;
  $l_date = show_datetime($obj->date);
  if ($l_idvisitor != 0)
     print("<tr><td class=list align=center width=10%><a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$l_idvisitor>$l_idvisitor</a></td>");
  else
    print("<tr><td class=list align=center width=10%>0</td>");
  print("<td class=list align=center>$l_date</td></tr>");
}
?>

</table>
</td></tr></table>

<br><br>

<?php
show_back();
?>
