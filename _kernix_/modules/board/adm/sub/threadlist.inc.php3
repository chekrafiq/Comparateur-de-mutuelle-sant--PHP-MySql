<?php

$l_sql = "SELECT * FROM $table_post WHERE idparent = '$p_idparent' ORDER BY idpost";
$c_db->query($l_sql);

?>

<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   titre
  </td>
  <td class="color2" align="center">
   nickname
  </td>
  <td class="color2" align="center">
   nbview
  </td>
  <td class="color2" align="center" width="20%">
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  if ($obj->validflag != 1)
  {
    $l_class = "warning";
  }
  print("<tr>");
  print("<td class=$l_class align=center>");
  $l_content = substr($obj->content,0,20);
  print("<a href=\"$PHP_SELF?p_boardaction=topicview&p_idpost=$obj->idpost\" class=truelink title=\"$l_content ...\">$obj->idpost</a>");
  print("</td>");
  print("<td class=$l_class align=center>");
  print($obj->title);
  print("</td>");
  print("<td class=$l_class align=center>");
  print($obj->nickname);
  print("</td>");
   print("<td class=$l_class align=center>");
  print($obj->nbview);
  print("</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>");
}
?>
</table>
<br>
<?php show_back(); ?>






