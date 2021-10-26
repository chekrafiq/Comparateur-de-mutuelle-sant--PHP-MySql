<?php
$l_sql = "SELECT * FROM $table_portsupplier ORDER BY name";
$c_db->query($l_sql);
?>

<table align="center" width="80%">
 <tr>
  <td align=left class=color1 colspan=2>
   :: Fournisseurs
  </td> 
 </tr>
 <tr>
  <td class="color2" width="50%" align="center" height="20">
   base
  </td>
  <td class="color2" align="center">
   dernière maj
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<tr>\n<td class=$l_class align=center><a href=\"$PHP_SELF?p_portaction=supplier&p_idportsupplier=$obj->idport_supplier\" class=truelink title=\"Voir ce fournisseur\">$obj->name</a></td>");
  print("<td class=$l_class align=center>".show_date($obj->updatedate)."</td></tr>");
}

?>

</table>

<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_portaction" value="supplier">
 <input type="hidden" name="p_supplieraction" value="addform">
 <input type="submit" value="créer un nouveau fournisseur" class="button">
</form>
