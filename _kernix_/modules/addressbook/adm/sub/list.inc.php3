<?php

$l_sql = "SELECT * FROM $table_addressbook ORDER BY idaddressbook DESC";
$c_db->query($l_sql);

?>

<table align="center" width="95%">
 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center" width="30%">
   nom
  </td>
  <td class="color2" align="center">
   prénom
  </td>
  <td class="color2" align="center">
   société
  </td>
  <td class="color2" align="center" width="20%">
   création
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
  print("<tr>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$PHP_SELF?p_addressbookaction=view&p_idaddressbook=$obj->idaddressbook\" class=truelink>$obj->idaddressbook</a>");
  print("</td>");
  print("<td class=$l_class align=center>$obj->lastname</td>");
  print("<td class=$l_class align=center>$obj->firstname</td>");
  print("<td class=$l_class align=center>$obj->company</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>");
}

?>

</table>

<br><br>

<?php 

show_hr();

?>

<br>

<form action="<?=$PHP_SELF?>" method="POST">
 <select name="p_addressbookaction">
  <option value="add">-- ajouter une entrée --</option>
 </select>&nbsp;
 <input type=submit value="exécuter" class=button>
</form>




