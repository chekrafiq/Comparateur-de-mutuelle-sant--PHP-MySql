<?php

$l_propertylist  = build_select($table_property,"","idproperty","propertyname","p_idproperty","","","");

?>

<form method="post" action="<?php print("$PHP_SELF")?>" name="mainform">
 <input type="hidden" name="p_siteadmaction" value="ref_add">
 <input type="hidden" name="p_idref" value="<?php print("$p_idref"); ?>">
 <input type="hidden" name="p_design" value="">
 <table width=95%>
 <tr>
  <td class=color1 align=left colspan=2 height=20>
   :: Ajout d'une page
  </td>
 </tr>

  <tr>
   <td align=right class=color2 width=25%>
    propriété &nbsp;
   </td>
   <td class=color3>
    <?php print($l_propertylist);?>

<script language="JavaScript">
<!--
document.mainform.p_idproperty.focus();
// -->
</script>

   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    type &nbsp;
   </td>
   <td class=color3>
    <select name=p_type>
     <option value=1 selected>-- PAGE WEB --</option>
     <option value=2>-- REFERENCE PRODUIT --</option>
    </select
   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    nom &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_name" size="50">
   </td>
  </tr>
 </table>
 <br>
 <input type="submit" name="submit" value="Ajouter" class=button>
</form>

<!---
<br><br>

<?php

$l_reflist    = build_select($table_ref,"","idref","name","p_idref_source","","","");
$l_ssreflist  = yesno_list("0", "p_ssrefflag");
$l_couperlist = yesno_list("0", "p_couperflag");

?>

<form method="post" action="<?php print("$PHP_SELF")?>" name="mainform2">
 <input type="hidden" name="p_siteadmaction" value="ref_duplicate">
 <input type="hidden" name="p_idref" value="<?php print("$p_idref"); ?>">
 <input type="hidden" name="p_design" value="">
 <table width=95%>
 <tr>
  <td class=color1 align=left colspan=2 height=20>
   :: Duplication d'une page existante
  </td>
 </tr>

  <tr>
   <td align=right class=color2 width=35%>
    page source &nbsp;
   </td>
   <td class=color3>
    <?php print($l_reflist);?>
   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    copier les sous références &nbsp;
   </td>
   <td class=color3>

    <?php print($l_ssreflist);?>
   </td>
  </tr>
  <tr>
   <td align=right class=color2>
    supprimer la page source &nbsp;<br> (et ses sous-pages !!) &nbsp;
   </td>
   <td class=color3>
    <?php print($l_couperlist);?>
   </td>
  </tr>

 </table>
 <br>
 <input type="submit" name="submit" value="Dupliquer" class=button>
</form>

// --->

<?php show_back();?>
