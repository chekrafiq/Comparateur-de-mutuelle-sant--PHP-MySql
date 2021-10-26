<?php

// nom;;type;;value;;required
// type : (0)txt (1)txtarea (2)select

$l_sql = "SELECT * FROM $table_form WHERE idform = '$p_idform' ";
$c_db->query($l_sql);
$form = $c_db->object_result();

?>

<form action="<?php print($PHP_SELF); ?>" method=post>
<input type=hidden name=p_formaction value=fieldstore>
<input type=hidden name=p_nbfield    value=<?php print($form->nbfield); ?>>
<input type=hidden name=p_idform     value=<?php print($p_idform); ?>>

<?php

$tab_field = explode("&&",$form->fieldstring);

$i = 1;
while ($i <= $form->nbfield)
{
  $l_field = $tab_field[$i - 1];
  $tab_elem = explode(";;",$l_field);
  $l_name = $tab_elem[0];
  $l_type = $tab_elem[1];
  $l_value = $tab_elem[2];
  $l_required = $tab_elem[3];
  print("<table width=75% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center><tr><td>");
  print("<table bgcolor=white border=0 cellspacing=2 cellpadding=2 width=100%>");
  print("<tr><td class=color2 colspan=2>:: champs $i ::</td></tr>");
  print("<tr><td width=25% class=list align=right>nom &nbsp;</td><td class=list> &nbsp; <input type=text name=p_name$i value=\"$l_name\" class=text>");
  if ($l_required == 1) $l_check = "CHECKED"; else $l_check = "";
  print(" <input type=checkbox $l_check name=p_required$i value=1> obligatoire");
  print("</td></tr>");
  print("<tr><td class=list align=right>type &nbsp;</td><td class=list>");
  print(" &nbsp; <select name=p_type$i>");
  $l_select = ""; if ($l_type == 0) $l_select = "SELECTED"; print("<option value=0 $l_select>-- PETIT TEXTE --</option>");
  $l_select = ""; if ($l_type == 1) $l_select = "SELECTED"; print("<option value=1 $l_select>-- GRAND TEXTE --</option>");
  $l_select = ""; if ($l_type == 2) $l_select = "SELECTED"; print("<option value=2 $l_select>-- MENU --</option>");
  $l_select = ""; if ($l_type == 3) $l_select = "SELECTED"; print("<option value=3 $l_select>-- CHOIX --</option>");
  print("</select>");
  print("</td></tr>");
  print("<tr><td class=list align=right>value &nbsp;</td><td class=list> &nbsp; <input type=text name=p_value$i value=\"$l_value\" class=text size=50></td></tr>");
  print("</table></td></tr></table><br><br>");
  $i++;
}

show_hr();

?>

<br>
<input type="submit" value="enregistrer" class="button">

</form>

<?php

show_back_url("$PHP_SELF?p_formaction=view&p_idform=$p_idform");

?>

