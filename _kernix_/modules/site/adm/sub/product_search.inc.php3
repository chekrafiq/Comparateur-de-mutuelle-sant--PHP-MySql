<?php

if ($p_searchitem == "" || $p_searchitem == "1")
{
     $p_idref = 2;
     include("sub/ref_view.inc.php3");     
}

$l_sql = "SELECT P.idproduct, R.idref, R.name, R.description FROM $table_ref AS R, $table_product AS P WHERE (P.productcode LIKE '%".$p_searchitem."%' OR R.name  LIKE '%".$p_searchitem."%') AND R.idproduct = P.idproduct AND R.idproduct > 0";
$c_db->query($l_sql);
if ($c_db->numrows == 1)
{
  $l_searchref = $c_db->object_result();
  $p_idref = $l_searchref->idref;
  include("sub/ref_view.inc.php3");     
  return 1;
}
elseif ($c_db->numrows < 1)
{
  show_response("pas de référence ayant ce numéro.");
  show_back();
  return 0;
}
?>
<table align=center width=95%>

 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   nom
  </td>
  <td class=color2 align=left width=70%>
   description
  </td>
 </tr>

<?php
while ($l_searchref = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "listdarksmall"; else : $l_class = "listlightsmall"; endif;
  print("<tr>");
  print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_siteadmaction=ref_view&p_idref=$l_searchref->idref\" class=truelink>$l_searchref->idref</a></td>");
  print("<td class=$l_class align=center>$l_searchref->name</td>");
  print("<td class=$l_class align=left width=20%>" . bdd2html($l_searchref->description) . "</td>");
  print("</tr>");
}
?>

</table>
<br><br>

















