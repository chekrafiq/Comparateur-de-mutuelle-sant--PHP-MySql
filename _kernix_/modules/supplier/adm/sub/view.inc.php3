<?php

$l_sql = "SELECT * FROM $table_supplier WHERE idsupplier = '$p_idsupplier' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_sql = "SELECT R.*, P.price, P.productcode FROM $table_ref AS R, $table_product AS P WHERE P.idsupplier = '$p_idsupplier' AND R.idproduct = P.idproduct";
$c_db->query($l_sql);
$l_nbproducts = $c_db->numrows;

?>

<table cellspacing=2 cellpadding=2 border=0 width=99% align=center>
<tr>
<td width=70% class=main valign=left>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idsupplier" value="<?php print("$p_idsupplier"); ?>">

 <table align="left" width="98%" valign="top"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Fournisseur [ <small><?php print("$p_idsupplier"); ?></small> ]
   </td> 
  </tr>
  <tr>
   <td width=30% align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="40" value="<?php print("$obj->name"); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">sujet &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" class="text" rows="6" cols="40"><?php print("$obj->description"); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">code compta &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_code" class="text" size="20" value="<?php print("$obj->code"); ?>">
   </td>
  </tr>   
  <tr>
   <td align="right" class="color2">mode &nbsp;</td> 
   <td class="color3">
    <select name="p_mode">
<?php

$l_select = ""; if ($obj->mode == "NONE") $l_select = "SELECTED"; print("<option value=NONE $l_select>-- AUCUN --</option>");
$l_select = ""; if ($obj->mode == "EMAIL") $l_select = "SELECTED"; print("<option value=EMAIL $l_select>-- EMAIL --</option>");
$l_select = ""; if ($obj->mode == "EURODISPATCH") $l_select = "SELECTED"; print("<option value=EURODISPATCH $l_select>-- EURODISPATCH --</option>");

?>
    </select>
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2">email &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_email" class="text" size="40" value="<?php print("$obj->email"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="main">
    <input type=checkbox name=p_clientprofilflag value=1 <?php if ($obj->clientprofilflag == 1) print("CHECKED"); ?>>
   </td> 
   <td class="main">
    envoyer le profil client
   </td>
  </tr> 
 </table> 

</td>
<td class=main align=right valign=top>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=100%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center  class=color3>
   .:: creation ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print(show_datetime($obj->date)); ?>
  </td>
 </tr>
 <tr>
  <td align=center  class=color3>
   .:: nb produits ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print($l_nbproducts); ?>
  </td>
 </tr>
</table>
</td></tr></table>

</td>
</tr>
</table>

<br><br>

<?php show_hr(); ?>

<br><br>
 <select name="p_supplieraction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="productlist">-- voir les produits --</option>
  <option value="suppress">-- supprimer ce supplier --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>

