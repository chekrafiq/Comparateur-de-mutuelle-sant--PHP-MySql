<?php

if ($p_option == 'whatsnew') $l_tmp = " WHERE date >= '$l_lastsession' ORDER BY DATE DESC";
else $l_tmp = 'ORDER BY date DESC LIMIT 0,50';

$l_sql = "SELECT keyword, idvisitor, date FROM $table_keywords $l_tmp";
$c_db->query($l_sql);
$l_nbkeyword = $c_db->numrows;

?>


<br>
<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=80%><tr><td>

<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=color2 align=center colspan=6>
   &#187; <b><?=$l_nbkeyword?></b> derniers mots clefs &#171; 
  </td>
 </tr>

<?php

while ($obj = $c_db->object_result())
{
  print("<tr><td class=list align=center>");
  print("&nbsp; <a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idvisitor width=1%>$obj->idvisitor</a> &nbsp;");
  print("</td>");
  print("<td class=list align=center>$obj->keyword</td>");
  print("<td class=list align=center>" . show_date($obj->date) . "</td>");
  print("</tr>");
}

?>

</table>
</td></tr></table>
<br><br>
<?php show_back(); ?>
