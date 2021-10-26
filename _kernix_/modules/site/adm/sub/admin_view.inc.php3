<?php
$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
$ref = $c_db->object_result();

$l_products = $ref->crossproducts;
$l_pages    = $ref->crosspages;
$l_access   = $ref->accesslist;

include("sub/onglet.inc.php3");

?>

<form method="POST" action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_oldidproduct"      value="<?=$ref->idproduct?>">
 <input type="hidden" name="p_oldvisibilityflag" value="<?=$ref->visibilityflag?>">

<table width="100%" border="0">
<tr>
 <td align="left" class="color1" colspan="<?php echo ($g_power == 1)?3:2; ?>" height="20">
  :: [ <small>page#<?=$p_idref?></small> ] admin : <small><?=$ref->name?></small>
 </td>
</tr>

<tr>

<td class="main" valign="top" width="<?php echo ($g_power == 1)?33:50; ?>%">

 <table width="99%">
  <tr>
   <td class="main" align="right" width="25%">v1 &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_val1" value="<?=$ref->val1?>" size="10"></td>
  </tr>

  <tr>
   <td class="main" align="right">v2 &nbsp;</td>
   <td class=main><input class="text" type="text" name="p_val2" value="<?=$ref->val2?>" size="10"></td>
  </tr>

  <tr>
   <td class="main" align="right">v3 &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_val3" value="<?=$ref->val3?>" size="10"></td>
  </tr>

  <tr>
   <td class="main" align="right">v4 &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_val4" value="<?=$ref->val4?>" size="10"></td>
  </tr>

  <tr>
   <td class="main" align="right">v5 &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_val5" value="<?=$ref->val5?>" size="10"></td>
  </tr>
 </table>

</td>
<td class="main" valign="top" width="<?php echo ($g_power == 1)?40:50; ?>%">

 <table width="99%" border="0">
  <tr>
   <td class="main" align="right" width="35%">code &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_pagecode" value="<?=$ref->pagecode?>" size="10"></td>
  </tr>
  <tr>
   <td class="main" align="right">owner &nbsp;</td>
   <td class="main">
<?php

$l_sql = "SELECT idowner, login FROM $table_owner";
$c_db->query($l_sql);
print("<select name=p_idowner>");
print("<option value=0>-- default owner --</option>");
$i = 1;
while ($objowner = $c_db->object_result())
{
  $l_selected = "";
  if ($ref->idowner == $objowner->idowner)
    $l_selected = "SELECTED";
  print("<option value=$objowner->idowner $l_selected>-- " . $objowner->login  . " --</option>");
  $i++;
}
print("</select>");

?>    
   </td>
  </tr>
  <tr>
   <td class="main" align="right">produit &nbsp;</td>
   <td class="main">
    <select name="p_idproduct">
     <option value="1" <?php if ($ref->idproduct > 0) print("selected")?>>-- OUI --</option>
     <option value="0" <?php if ($ref->idproduct == 0) print("selected")?>>-- NON --</option>
    </select>
   </td>
  </tr>
 
  <tr>
   <td class="main" align="right">visibility &nbsp;</td>
   <td class="main">
    <select name="p_visibilityflag">
     <option value="1" <?php if ($ref->visibilityflag > 0) print("selected")?>>-- OUI --</option>
     <option value="0" <?php if ($ref->visibilityflag == 0) print("selected")?>>-- NON --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td class="main" align="right">index &nbsp;</td>
   <td class="main">
    <select name="p_indexflag">
     <option value="1" <?php if ($ref->indexflag > 0) print("selected")?>>-- OUI --</option>
     <option value="0" <?php if ($ref->indexflag == 0) print("selected")?>>-- NON --</option>
    </select>
   </td>
  </tr>
 </table>

</td>

<?php if ($g_power == 1) : ?>

<td class="main" valign="top" align="right">

 <table align="right" border="0">
  <tr>
   <td class="main" align="right" width="95%">prev &nbsp;</td>   
   <td class="main"><input class="text" type="text" name="p_prev" value="<?=$ref->prev?>" size="5"></td>
  </tr>
  <tr>
   <td class="main" align="right">up &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_up" value="<?=$ref->up?>" size="5"></td>
  </tr>
  <tr>
   <td class="main" align="right">nodekey &nbsp;</td>
   <td class=main><input class="text" type="text" name="p_nodekey" value="<?=$ref->nodekey?>" size="5"></td>
  </tr>
  <tr>
   <td class="main" align="right">next &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_next" value="<?=$ref->next?>" size="5"></td>
  </tr>
  <tr>
   <td class="main" align="right">idorder &nbsp;</td>
   <td class="main"><input class="text" type="text" name="p_idorder" value="<?=$ref->idorder?>" size="5"></td>
  </tr>
  <tr>
   <td class="main" align="right">nbsubref &nbsp;</td>
   <td class=main><input class="text" type="text" name="p_nbsubref" value="<?=$ref->nbsubref?>" size="5"></td>
  </tr>
 </table>

</td>

<?php endif; ?>

</tr>

 <tr>
  <td colspan="<?php echo ($g_power == 1)?3:2; ?>" align="center">
    <input type="hidden" name="p_idref" value="<?=$p_idref?>">
    <select name="p_siteadmaction" size="1">
     <option value=admin_update selected> -- enregistrer les modifications -- </option>
    </select>
    <input type="submit" name="submit" value="exécuter" class="button">
    <br><br>
  </td>
 </tr>

</table>
</form>

<table width="100%">
 <tr>
  <td align="left" class="color1" colspan="2" height="20">:: tri des sous-pages</td>
 </tr>
 <tr>
  <td class="main" align="right" valign="top" width="65%">par ordre alphabétique croissant (A-Z) :&nbsp;</td>
  <td class="main">
   <a href="<?=$PHP_SELF?>?p_siteadmaction=ref_changeorder&p_move=alphabetic&p_fromref=<?=$p_idref?>&alpha_flag=0" class="truelink">cliquez ici</a>
  </td>
 </tr>
 <tr>
  <td class="main" align="right" valign="top">par ordre alphabétique décroissant (Z-A) :&nbsp;</td>
  <td class="main">
   <a href="<?=$PHP_SELF?>?p_siteadmaction=ref_changeorder&p_move=alphabetic&p_fromref=<?=$p_idref?>&alpha_flag=1" class="truelink">cliquez ici</a>
  </td>
 </tr>
 <tr>
  <td class="main" align="right" valign="top">regénérer par idorder :&nbsp;</td>
  <td class="main">
   <a href="<?=$PHP_SELF?>?p_siteadmaction=ref_changeorder&p_move=order&p_fromref=<?=$p_idref?>" class="truelink">cliquez ici</a>
  </td>
 </tr>
</table>

<br><br>


<table width="100%" border="0">

<form method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idref"         value="<?=$p_idref?>">
<input type="hidden" name="p_nodekey"       value="<?=$ref->nodekey?>">
<input type="hidden" name="p_siteadmaction" value="admin_access_update">

 <tr>
  <td align="left" class="color1" colspan="3" height="20">
   :: restriction d&#39;acces <font style="font-weight: normal">(clicker sur CTRL + click pour multi-selection)</font>
  </td>
 </tr>
 <tr>
  <td class="main" width="40%" align="right">
   <select multiple size="5" name="p_tabaccess[]">

<?php
$l_sql = "SELECT idusers, login FROM $table_users WHERE idusers > 1 ORDER BY lastname";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $l_tabaccess = explode(",",$l_access);
  $l_selected = "";
  if (in_array($obj->idusers,$l_tabaccess)) $l_selected = "selected";
  print("<option value=$obj->idusers $l_selected> [$obj->idusers] " . $obj->login  . " _________________</option>\n");
}
?>
   </select>
  </td>
  <td><img src="/pictures/empty.gif" width="30"></td>
  <td align="left" width="60%" class="main" valign="top">
   <br>
   <input type="checkbox" name="p_accessflag" value="1" CHECKED> restreindre également l&#39;accés aux sous pages<br><br>
   <input type="submit" name="submit" value="enregistrer" class="button">
   <br><br>
  </td>
 </tr>
</form>
</table>

<br>


<table width="100%">
<form method="post" action="<?=$PHP_SELF?>">
<tr>
 <td align="left" class="color1" colspan="2" height="20">
  :: crosslinking <font style="font-weight: normal">(clicker sur CTRL + click pour multi-selection)</font>
 </td>
</tr>
<tr>
<td width="50%" class="main" align="center">
<?php

$l_sql = "SELECT idref, name FROM $table_ref WHERE idproduct > 0 ORDER BY idref";
$c_db->query($l_sql);
if ($c_db->numrows)
{
  print("<select multiple size=15 name=p_tabproducts[]>");
  while ($obj = $c_db->object_result())
  {
    $l_tabproducts = explode(",",$l_products);
    $l_selected = "";
    if (in_array($obj->idref,$l_tabproducts)) $l_selected = "selected";
    print("<option value=$obj->idref  $l_selected> [$obj->idref] " . substr($obj->name,0,20)  . " ... </option>\n");
  }
  print("</select>");
}
else
{
  print("no product");
}
?>

</td>
<td class="main" width="50%" align="center">

<select multiple size="15" name="p_tabpages[]">
<?php
$l_sql = "SELECT idref, name FROM $table_ref WHERE idproduct = '0' AND idref != 1 ORDER BY idref";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $l_tabpages = explode(",",$l_pages);
  $l_selected = "";
  if (in_array($obj->idref,$l_tabpages)) $l_selected = "selected";
  print("<option value=$obj->idref $l_selected> [$obj->idref] " . substr($obj->name,0,20)  . " ... </option>\n");
}
?>
</select>

  </td>
 </tr>
 <tr>
  <td colspan="2" align="center">

   <br>
    <input type="hidden" name="p_idref" value="<?=$p_idref?>">
    <select name="p_siteadmaction" size="1">
     <option value="admin_cross_update" selected> -- enregistrer les modifications -- </option>
    </select>
    <input type="submit" name="submit" value="exécuter" class="button">
    <br><br>
  </td>
 </tr>
</form>
</table>


