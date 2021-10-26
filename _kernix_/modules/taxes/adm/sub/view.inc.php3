<?php

$l_sql = "SELECT * FROM $table_taxes WHERE idtaxes = '$p_idtaxes' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_idtaxes" value="<?php print("$p_idtaxes"); ?>">

 <table align=center width=80%>  
   <tr>
    <td align=left class=color1 colspan=2> :: Taxe <?php print("$p_idtaxes"); ?></td> 
   </tr>
   <tr>
    <td align=right class=color2 width=30%>nom &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_name" class=text value="<?php print("$obj->name"); ?>">
    </td>
   </tr>
    <tr>
    <td align=right class=color2>description &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_description" class=text value="<?php print("$obj->description"); ?>" size=50>
    </td>
   </tr> 
   <tr>
    <td align=right class=color2>rate &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_rate" class=text value="<?php print("$obj->rate"); ?>">
    </td>
   </tr>
 </table> 

<br>

 <select name=p_taxesaction>
  <option value=store>-- enregistrer les modifications --</option>
  <option value=suppress>-- supprimer cette monnaie --</option>
 </select>&nbsp;
 <input type=submit value="exécuter" class=button>

<br><br>

</form>

<?php show_back(); ?>

