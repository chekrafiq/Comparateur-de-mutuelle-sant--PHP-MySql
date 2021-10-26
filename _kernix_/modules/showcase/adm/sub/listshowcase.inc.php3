<?php

$l_sql = "SELECT S.*, R.name as name, R.idproduct as idproduct FROM $table_showcase AS S, $table_product AS P, $table_ref AS R WHERE  R.idref = S.idref AND P.idproduct = R.idproduct ORDER BY idshowcase DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("le showcase est vide.");
     print("<br>");
     show_hr();
     print("<form action=$PHP_SELF method=post>");
     print("<input type=hidden name=p_showcaseaction value=addtoshowcase>");
     print("<input type=text name=p_idref class=text width=3> &nbsp;");
     print("<input type=submit value='ajouter au showcase' class=button>");
     print("</form>");
     return 1;
}

?>

<table align=center width=75%>
<tr>
<td class=color2 width=5% align=center>
id
</td>
<td class=color2 align=center width=70%>
produit
</td>
<td class=color2 align=center width=15%>
date d'ajout
</td>
<td class=main align=center width=10%>
&nbsp;
</td>
</tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>$obj->idshowcase</td>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$g_urlroot/$g_modulespath/site/adm/index.php3?p_shopadmaction=productform&p_idproduct=$obj->idproduct\" class=truelink>$obj->name</a>");
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("<td class=$l_class align=center width=20%><a href=$PHP_SELF?p_showcaseaction=deletefromshowcase&p_idref=$obj->idref title='suppression'>x</a></td>");
     print("</tr>");
}
?>
</table>

<form action="<?php print("$PHP_SELF"); ?>" method="post">
<input type=hidden name="p_showcaseaction" value="addtoshowcase">
<input type=text name="p_idref" class="text" width=3> &nbsp;
<input type=submit value='ajouter au showcase' class=button>
</form>

<br>

<?php show_back(); ?>

<br>
 votre showcase
<br><br><br>

<table border=0 width=98%>
 <tr>
  <td rowspan=2 class=main valign=top>
   <iframe src="/extern/showcase.php3" title="<?php print("showcase du site $g_sitename");?>" width=110 height=300 marginwidth=0 marginheight=0 align=center>
    <a href=<?php print("$g_urlroot");?>><?php print("$g_sitename");?> </a>
   </iframe>
  </td>

  <td class=main align=center valign=top>
   <iframe src="/extern/showcase.php3?p_align=H" title="<?php print("showcase du site $g_sitename");?>" width=250 height=150 marginwidth=0 marginheight=0 align=center>
    <a href=<?php print("$g_urlroot");?>><?php print("$g_sitename");?> </a>
   </iframe>
  </td>

  <form>
  </tr>

   <td align=center class=main>
    <textarea cols=70 rows=6>
<iframe src="<?php print("$g_urlroot/extern/showcase.php3");?>" title="<?php print("showcase du site $g_sitename");?>" width=110 height=300 marginwidth=0 marginheight=0 align=center>
<a href=<?php print("$g_urlroot");?>><?php print("$g_sitename");?> </a>
</iframe>
    </textarea>
   </td>
  </tr>

</table>

</form>
