<?php

$l_sql = "SELECT * FROM $table_affiliate WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
     show_response("erreur, cet affilié n'existe pas.");
     show_back();
     return 0;
}
$affiliate = $c_db->object_result();

?>

<form action="<?php print($PHP_SELF)?>" >
<input type="hidden" name="p_idaffiliate" value="<?php print($p_idaffiliate)?>">

<table width="90%" align="center">
 <tr>
  <td align=left class=color1 colspan=2>
   :: compte <?php print("$affiliate->payableto");?>
  </td> 
 </tr> 
 <tr>
  <td class=color2 align=right width=30%>affiliatemode &nbsp;</td>
  <td class=color3 align=left>
   <select name=p_affiliatemode>
    <option value=0 <?php if ($affiliate->affiliatemode == 0) print("SELECTED"); ?> > -- mode par défaut -- </option>
    <option value=2 <?php if ($affiliate->affiliatemode == 2) print("SELECTED"); ?> > -- pourcentage -- </option>
    <option value=1 <?php if ($affiliate->affiliatemode == 1) print("SELECTED"); ?> > -- valeur fixe -- </option>
   </select>
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>affiliatevalue &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_affiliatevalue" value="<?php print("$affiliate->affiliatevalue"); ?>" size="20" class="text">
  </td>
 </tr> 
 <tr>
  <td colspan="2" align="center">
   <br>
   <select name="p_affiliateaction">
    <option value="modestore">-- enregistrer les modifications --</option>
   </select>
   &nbsp;&nbsp;
   <input type="submit" value="exécuter" class="button"><br><br>
  </td>
 </tr>
</table>
</form>
<br><br>

<?php

   show_back();

?>

