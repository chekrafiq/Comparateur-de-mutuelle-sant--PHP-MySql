<?php

$l_sql = "SELECT * FROM $table_currency WHERE idcurrency = '$p_idcurrency' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_idcurrency" value="<?php print("$p_idcurrency"); ?>">

 <table align=center width=80%>  
   <tr>
    <td align=left class=color1 colspan=2> :: Monnaie <?php print("$p_idcurrency"); ?></td> 
   </tr>
   <tr>
    <td align=right class=color2>nom &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_name" class=text value="<?php print("$obj->name"); ?>">
    </td>
   </tr>
    <tr>
    <td align=right class=color2> 1 x = &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_value" class=text value="<?php print("$obj->value"); ?>">  <?php print($g_currencyname); ?>
    </td>
   </tr> 
   <tr>
    <td align=right class=color2>acronym TXT &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_acronymtxt" class=text value="<?php print("$obj->acronymtxt"); ?>">
    </td>
   </tr>
   <tr>
    <td align=right class=color2>acronym HTML &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_acronymhtml" class=text value="<?php print("$obj->acronymhtml"); ?>">
    </td>
   </tr>
   <tr>
    <td align=right class=color2>ISO &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_isocode" class=text value="<?php print("$obj->isocode"); ?>">
    </td>
   </tr>
 </table> 

<br>

 <select name=p_currencyaction>
  <option value=store>-- enregistrer les modifications --</option>
  <option value=suppress>-- supprimer cette monnaie --</option>
 </select>&nbsp;
 <input type=submit value="exécuter" class=button>

<br><br>

</form>

<?php show_back(); ?>

