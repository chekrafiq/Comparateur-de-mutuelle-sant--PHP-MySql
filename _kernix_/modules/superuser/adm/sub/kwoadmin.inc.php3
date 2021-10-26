<?php

if ($p_storeflag == "yes")
{
  $l_sql = "UPDATE $table_admadm set eurodispatchflag = '$p_eurodispatchflag', headerheight = '$p_headerheight', crondailyflag = '$p_crondailyflag',  ecommerceflag = '$p_ecommerceflag', doubleframeflag = '$p_doubleframeflag', richeditflag = '$p_richeditflag', popserver = '$p_popserver' WHERE idadmadm = '1'";
  $c_db->query($l_sql);
  show_response("modification effectuée");
}

$l_sql = "SELECT * FROM $table_admadm";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_eurolist        = yesno_list($obj->eurodispatchflag, "p_eurodispatchflag");
$l_crondailylist   = yesno_list($obj->crondailyflag, "p_crondailyflag");
$l_ecommercelist   = yesno_list($obj->ecommerceflag, "p_ecommerceflag");
$l_doubleframelist = yesno_list($obj->doubleframeflag, "p_doubleframeflag");
$l_richeditlist    = yesno_list($obj->richeditflag, "p_richeditflag");


?>

<form method="POST" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_superuseraction"  value="kwoadmin">
<input type="hidden" name="p_storeflag"        value="yes">

 <table width="98%">

  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: valeurs globales de fonctionnement de KWO
   </td> 
  </tr>

  <tr>
   <td align="right" class="color2" width="40%">eurodispatch &nbsp;</td>
   <td class="color3"><?=$l_eurolist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">headerheight &nbsp;</td>
   <td class="color3"><input class="text" type="text" name="p_headerheight" value="<?=$obj->headerheight?>" size="10"></td>
  </tr>

  <tr>
   <td align="right" class="color2">crondaily &nbsp;</td>
   <td class="color3"><?=$l_crondailylist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">ecommerce &nbsp;</td>
   <td class=color3><?=$l_ecommercelist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">double frame &nbsp;</td>
   <td class=color3><?=$l_doubleframelist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">rich edit &nbsp;</td>
   <td class=color3><?=$l_richeditlist?></td>
  </tr>

  <tr>
   <td align="right" class="color2">popserver &nbsp;</td>
   <td class="color3"><input class="text" type="text" name="p_popserver" value="<?=$obj->popserver?>" size="40"></td>
  </tr>

 </table>
 <br><br>

<?php show_hr(); ?>

 <br><br>
 <select name="p_shiadmaction">
  <option value="store" SELECTED>-- enregistrer les modifications --</option>
 </select>
 <input type=submit name="button" value="enregistrer" class="button">


</form>
