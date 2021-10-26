<?php

if (isset($p_wfrom))
{
  if (!isset($p_tabcol)) return show_response("au moins, une colonne doit être selectionnée.");
  if (!empty($p_clause) && !eregi("and",$p_clause)) return show_response("n'oubliez pas le AND dans la clause");
  $l_tmp = '';
  $l_sep = '';
  foreach ($p_tabcol as $l_col)
    {
      $l_tmp .= " $l_sep $l_col = replace($l_col,'$p_wfrom','$p_wto')";
      $l_sep = ',';
    }
  $l_sql = "UPDATE ref SET $l_tmp WHERE 1 $p_clause";
  if ($p_debugflag == 1) return print($l_sql . "<br><br>");
  $c_db->query($l_sql);
  return  show_response("texte modifié dans < $c_db->affectrows > pages");
}

?>

<form action="<?=$PHP_SELF?>">
<input type="hidden" name="p_superuseraction" value="replace">
<table width="90%">
 <tr><td class="main" align="right" width="30%">text à remplacer &nbsp; </td><td><input type="text" name="p_wfrom" class="text" size="50"></td></tr>
 <tr><td class="main" align="right">text de remplacement &nbsp; </td><td><input type="text" name="p_wto" class="text" size="50"></td></tr>
 <tr>
  <td class="main" align="right" valign="top">colonnes à traiter &nbsp; </td>
  <td class="main">
   <input type="checkbox" name="p_tabcol[]" value="content" CHECKED> content<br>
   <input type="checkbox" name="p_tabcol[]" value="description" CHECKED> description<br>
   <input type="checkbox" name="p_tabcol[]" value="title"> title<br>
   <input type="checkbox" name="p_tabcol[]" value="keywords"> keywords
  </td>
 </tr>
 <tr><td class="main" align="right">clause suppl (opt) &nbsp; </td><td><input type="text" name="p_clause" class="text" size="50"></td></tr>
 <tr><td class="main" align="right">&nbsp;</td><td class="main"><input type="checkbox" name="p_debugflag" value="1"> debug</td></tr>
 <tr><td class="main" align="right">&nbsp;</td><td><input type="submit" value="exécuter" class="button"></td></tr>
</table>
</form>

