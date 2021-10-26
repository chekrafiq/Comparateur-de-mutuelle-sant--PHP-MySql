<?php

$l_sql = "SELECT keyword FROM $table_keywords";
$c_db->query($l_sql);
$l_nbtotal = $c_db->numrows;

$l_sql = "SELECT keyword FROM $table_keywords GROUP BY keyword";
$c_db->query($l_sql);
$l_nbdiff = $c_db->numrows;

$l_sql = "SELECT count(*) as n, keyword FROM $table_keywords GROUP BY keyword ORDER BY n DESC";
$c_db->query($l_sql);

?>

<br>
<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" width="95%"><tr><td>

<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>
  <td class="color2" align="center" colspan="6">
   &#187; <b><?=$l_nbtotal?></b> entrées, <b><?=$l_nbdiff?></b> mots clefs différents &#171; 
  </td>
 </tr>

<?php

while ($obj = $c_db->object_result())
{
  $n = $obj->n;
  $str = strtolower($obj->keyword);
  $p_keyword = urlencode($str);
  print("<tr><td class=list align=center>");
  print("<a href=$PHP_SELF?p_seaction=listvis&p_keyword=$p_keyword>$n</a>");
  print("</td><td class=list align=center width=33%>$str</td>");
  $obj = $c_db->object_result();
  $str = strtolower($obj->keyword);
  $p_keyword = urlencode($str);
  $n = $obj->n; 
  print("<td class=list align=center>");
  print("<a href=$PHP_SELF?p_seaction=listvis&p_keyword=$p_keyword>$n</a>");
  print("</td><td class=list align=center width=33%>$str</td>");
   $obj = $c_db->object_result();
  $str = strtolower($obj->keyword);
  $p_keyword = urlencode($str);
  $n = $obj->n; 
  print("<td class=list align=center>");
  print("<a href=$PHP_SELF?p_seaction=listvis&p_keyword=$p_keyword>$n</a>");
  print("</td><td class=list align=center width=33%>$str</td></tr>");
}

?>

</table>
</td></tr></table>

<form method="POST" action="<?=$PHP_SELF?>">

<input type="hidden" name="p_idbasic" value="<?=$p_idbasic?>">

<select name="p_seaction">
 <option value="lastkeywords">-- derniers mots clefs --</option>
 <option value="reset">-- remise à zéro --</option>
</select>&nbsp;

<input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>






