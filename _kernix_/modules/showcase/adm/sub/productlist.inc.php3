<?php

$l_sql = "SELECT S.*, R.name FROM $table_sp AS S, $table_ref AS R WHERE S.idshowcase = '$p_idshowcase' AND S.idref = R.idref ORDER BY idsp DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun produit");
  return 0;
}

?>

<table align="center" width="55%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   idref
  </td>
  <td class="color2" align="center">
   name
  </td>
  <td class="color2" align="center" width="20%">
   date
  </td>
  <td class="main" align="center" width="5%"> 
   &nbsp;
  </td>  
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_showcaseaction=view&p_idshowcase=$obj->idshowcase\" class=truelink>$obj->idref</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->name);
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("<td class=main align=center><a href=$PHP_SELF?p_showcaseaction=productsuppress&p_idref=$obj->idref&p_idshowcase=$p_idshowcase class=truelink title=\"suppress\">x</a></td>");
     print("</tr>");
}
?>
</table>

<br>
