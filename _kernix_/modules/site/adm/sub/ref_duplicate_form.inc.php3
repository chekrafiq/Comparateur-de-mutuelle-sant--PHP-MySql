<?php
$l_sql = "SELECT idref, name, description, nbsubref FROM $table_ref where idref = '$adm->copy_idref'";
$c_db->query($l_sql);
$l_ref = $c_db->object_result();

$l_ssreflist  = yesno_list("0", "p_ssrefflag");
$l_couperlist = yesno_list("0", "p_couperflag");

?>

<form method="post" action="<?php print("$PHP_SELF")?>" name="mainform2">
 <input type="hidden" name="p_siteadmaction" value="ref_duplicate">
 <input type="hidden" name="p_idref" value="<?php print($p_fromref); ?>">
 <input type="hidden" name="p_idref_source" value="<?php print("$l_ref->idref"); ?>">
 <input type="hidden" name="p_design" value="">
 <table width=95%>
 <tr>
  <td class=color1 align=left colspan=2 height=20>
   :: Copier - coller
  </td>
 </tr>

  <tr>
   <td align=right class=color2 width=45%>
    page source &nbsp;
   </td>
   <td class=color3>
    <?php print("$l_ref->name [$l_ref->idref]<br>$l_ref->description<br>$l_ref->nbsubref sous pages"); ?>
   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    copier &nbsp;
   </td>
   <td class=color3>
    <select name="p_ssrefflag">
     <option value="1">uniquement la page source</option>
     <option value="2">uniquement les sous pages de la page source</option>
     <option value="3">la page source et ses sous pages</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    supprimer la (les) page(s) source(s) &nbsp;
   </td>
   <td class=color3>
    <select name="p_couperflag">
     <option value="0">-- NON --</option>
     <option value="1">-- OUI --</option>
    </select>

   </td>
  </tr>

 </table>
 <br>
 <input type="submit" name="submit" value="éxecuter" class=button>
</form>

<?php show_back();?>
