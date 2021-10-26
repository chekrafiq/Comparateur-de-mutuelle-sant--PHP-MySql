<?php

$l_sql = "SELECT * FROM $table_admsite";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_openlist = yesno_list($obj->openflag, "p_openflag");

$l_lnlist = build_select_csv('fr,en,es,jp',$obj->ln,'p_ln','');

?>

<form method="post" action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_siaction"  value="store">

 <table width="90%">

  <tr>
   <td align="left" class="color1" colspan="2" height="20">:: valeurs globales de fonctionnement du site</td> 
  </tr>

  <tr>
   <td align="right" class="color2" width="40%">email &nbsp;</td>
   <td class="color3">
    <input class="text" type="text" name="p_email" value="<?=$obj->email?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">taux de raffraichissement &nbsp;</td>
   <td class="color3">
    <input class="text" type="text" name="p_refreshrate" value="<?=$obj->refreshrate?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">année d&#39;ouverture &nbsp;</td>
   <td class="color3">
    <input class="text" type="text" name="p_startyear" value="<?=$obj->startyear?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">liste de templates &nbsp;</td>
   <td class="color3">
    <input class="text" type="text" name="p_template" value="<?=$obj->template?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2" width="40%">site ouvert &nbsp;</td>
   <td class="color3"><?=$l_openlist?></td>
  </tr>

  <tr>
   <td align="right" class="color2" width="40%">encodage des charactères &nbsp;</td>
   <td class="color3">
    <select name="p_charset">
     <option value="ISO-8859-1">-- Europe --</option>
     <option value="shift_jis" <?php if ($obj->charset == 'shift_jis') echo 'SELECTED'; ?>>-- Asie --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td align="right" class="color2" width="40%">langue de l&#39;admin &nbsp;</td>
   <td class="color3"><?=$l_lnlist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">val1 &nbsp;</td>
   <td class="color3" valign="top">
    <input class="text" type="text" name="p_val1" value="<?=$obj->val1?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">val2 &nbsp;</td>
   <td class="color3" valign="top">
    <input class="text" type="text" name="p_val2" value="<?=$obj->val2?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">val3 &nbsp;</td>
   <td class="color3" valign="top">
    <input class="text" type="text" name="p_val3" value="<?=$obj->val3?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">val4 &nbsp;</td>
   <td class="color3" valign="top">
    <input class="text" type="text" name="p_val4" value="<?=$obj->val4?>" size="40">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">val5 &nbsp;</td>
   <td class="color3" valign="top">
    <input class="text" type="text" name="p_val5" value="<?=$obj->val5?>" size="40">
   </td>
  </tr>

 </table>
 <br><br>

<?php show_hr(); ?>

 <br><br>
 <select name="p_shiadmaction">
  <option value="store" SELECTED>-- enregistrer les modifications --</option>
 </select>
 <input type="submit" name="button" value="enregistrer" class="button">

</form>
