<?php

$l_sql = "SELECT * FROM $table_post WHERE idformpost = '$p_idformpost'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<table align=center width=70%>
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
:: post [ <small><?php print($p_idformpost); ?></small> ] <small><?php print(show_datetime($obj->date)); ?></small>,
   user <?php print("<a href=\"$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idvisitor\" class=whitelink>$obj->idvisitor</a>"); ?>
   </td> 
  </tr>

<?php

$l_tabfields = explode("&&",$obj->post);
$i = 0;
while ($l_tabfields[$i])
{
  $l_tabnv = explode("==",$l_tabfields[$i]);
  print("<tr>");  
  print("<td align=right valign=top class=color2>" . $l_tabnv[0] . " &nbsp;</td>\n");
  print("<td align=left valign=top class=listlight>&nbsp;" . nl2br($l_tabnv[1]) . " &nbsp;</td>\n");
  print("</tr>");
  $i++;
}

?>

</table>

<br>

<?php show_hr(); ?>

<form method="post" action="<?php print($PHP_SELF); ?>" method=post>
 <input type="hidden" name="p_idform"     value="<?php print("$p_idform"); ?>">
 <input type="hidden" name="p_idformpost" value="<?php print("$p_idformpost"); ?>">
 <select name="p_formaction">
  <option value="postsuppress">-- suppimer ce post --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">
</form>

<?php show_back(); ?>
