<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=97>
<tr><td class=admtablinkstitle>

<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
<td class=showcasetitle width=100% valign=top>
:: <a href="<?php print("$g_urlroot")?>" title="<?php print("showcase du site $g_sitename")?>" class=white>showcase</a> ::
</td>
<?php
$table_showcase = "showcase";
$table_product = "product";
$table_ref = "ref";

$l_sql = "SELECT S.*, R.name as name, R.icon as icon, R.description as description, P.price as price, P.oldprice as oldprice FROM $table_showcase AS S, $table_product AS P, $table_ref AS R WHERE  R.idref = S.idref AND P.idproduct = R.idproduct ORDER BY idshowcase DESC";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
     print("<tr><td class=showcaselight><br>le showcase<br> est vide.<br><br></td></tr></table>");
     return 1;
}
$i = 0;
if ($p_align != "H")
{
     print("</tr>");
}
while ($obj = $c_db->object_result())
{
     
     if (($i++ % 2) == 0): $l_class = "showcasedark"; else : $l_class = "showcaselight"; endif;
     if ($p_align != "H")
     {
	  print("<tr>");
     }
     print("<td class=$l_class align=center valign=top>\n");
     print("<br><a href=\"$g_urldyn?p_idref=$obj->idref\" class=truelink title=$obj->description>$obj->name</a><br><br>\n");
     if ($obj->icon != "")
     {
	  print("<img src=/upload/pictures/$obj->icon border=0>");
     }
     print("<br>");
     
     print("<br>" . to_franc($obj->price) . "<br>");
     if ($obj->oldprice != 0)
     {
	  print("<strike>" . to_franc($obj->oldprice) . " </strike>");
     }
     print("<br>");
     print("</td>\n");
     if ($p_align != "H")
     {
	  print("</tr>\n");
     }
}
if ($p_align != "H")
{
     print("</tr>");
}

?>
<td class=showcasetitle width=100% align=center  valign=top>
- <a href="<?php print("$g_kworoot")?>" class=title title="<?php print("KerniX Software - KWO")?>">&copy; KerniX</a> -
</td>

</table>

</td></tr>
</table>

