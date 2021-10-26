<?php

if (isset($p_idport))
{
  if ($p_homeaction == "del")
  {
    $l_sql = "DELETE FROM $table_port WHERE idport = $p_idport";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE $table_port SET name = '$p_name', value = $p_value, sessionflag = $p_sessionflag, idport = $p_newidport WHERE idport = $p_idport";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }  
}

if ($p_homeaction == "add")
{
  $l_sql = "INSERT INTO $table_port (name) values ('nouveau')";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}

$l_sql = "SELECT * FROM $table_port ORDER BY idport";
$c_db->query($l_sql);
$j=0;
while ($obj = $c_db->object_result())
{
  $tab_port[$j][0] = $obj->idport;
  $tab_port[$j][1] = $obj->name;
  $tab_port[$j][2] = $obj->value;
  $tab_port[$j][3] = $obj->sessionflag;
  $j++;
}
?>

<table align="center" width="90%">
 <tr>
  <td align=left class=color1 colspan=5>
   :: Types de port
  </td> 
 </tr>
 <tr>
  <td class="color2" width="10%" align="center" height="20">
   idport
  </td>
  <td class="color2" align="center">
   nom
  </td>
  <td class="color2" align="center" width="20%">
   valeur associée
  </td>
  <td class="color2" align="center" width="20%">
   local
  </td>
  <td class="color2" align="center" width="10%">
   &nbsp;
  </td>
 </tr>

<?php

$i = 0;
while ($tab_port[$i])
{
  if (($i % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<form action=$PHP_SELF method=post name=form$i>");
  print("<input type=hidden name=p_portaction value=home>");
  print("<input type=hidden name=p_idport value=".$tab_port[$i][0].">");
  print("<tr>\n<td class=$l_class align=center><input type=text value=\"".$tab_port[$i][0]."\" name=p_newidport size=2 class=text></td>");
  print("<td class=$l_class align=center><input type=text value=\"".$tab_port[$i][1]."\" name=p_name size=30 class=text></td>");
  $l_valuelist = build_select($table_portsupplier, $tab_port[$i][2], "idport_supplier", "name", "p_value", "", "AUCUNE", "");
  print("<td class=$l_class align=center>$l_valuelist</td>");
  $l_globallist = yesno_list($tab_port[$i][3], "p_sessionflag");
  print("<td class=$l_class align=center>$l_globallist</td>");
  print("<td class=$l_class align=center><a href=\"javascript:document.form$i.submit()\" class=truelink title=\"Enregistrer les modifications de cette ligne\">V</a> - <a href=\"$PHP_SELF?p_portaction=home&p_homeaction=del&p_idport=".$tab_port[$i][0]."\" class=truelink title=\"Supprimer cette ligne\">X</a></td>\n</tr></form>\n");
  $i++;
}

?>

</table>

<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_portaction" value="home">
 <input type="hidden" name="p_homeaction" value="add">
 <input type="submit" value="créer un nouveau port" class="button">
</form>
