<?php

$l_sql = "SELECT * FROM $table_board WHERE idboard = '$p_idboard' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idboard" value="<?php print("$p_idboard"); ?>">

 <table align="center" width="80%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Admin Board <?php print("$p_idboard"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nbeleminlisttopic &nbsp;</td> 
   <td class="color3">    
    <input type="text" name="p_nbeleminlisttopic" class="text" value="<?php print("$obj->nbeleminlisttopic"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">nbeleminlistreply &nbsp;</td> 
   <td class="color3">    
    <input type="text" name="p_nbeleminlistreply" class="text" value="<?php print("$obj->nbeleminlistreply"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">nbcarinabstract &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_nbcarinabstract" class="text" value="<?php print("$obj->nbcarinabstract"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">archiveflag &nbsp;</td> 
   <td class="color3">
    <select name="p_archiveflag">
     <option value="1" <?php if ($obj->archiveflag == "1") print("SELECTED"); ?>>-- O U I --</option>
     <option value="0" <?php if ($obj->archiveflag == "0") print("SELECTED"); ?>>-- N O N --</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">openextflag &nbsp;</td> 
   <td class="color3">
    <select name="p_openextflag">
     <option value="1" <?php if ($obj->openextflag == "1") print("SELECTED"); ?>>-- O U I --</option>
     <option value="0" <?php if ($obj->openextflag == "0") print("SELECTED"); ?>>-- N O N --</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">backendflag &nbsp;</td> 
   <td class="color3">
    <select name="p_backendflag">
     <option value="1" <?php if ($obj->backendflag == "1") print("SELECTED"); ?>>-- O U I --</option>
     <option value="0" <?php if ($obj->backendflag == "0") print("SELECTED"); ?>>-- N O N --</option>
    </select>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">interactiveflag &nbsp;</td> 
   <td class="color3">
    <select name="p_interactiveflag">
     <option value="1" <?php if ($obj->interactiveflag == "1") print("SELECTED"); ?>>-- O U I --</option>
     <option value="0" <?php if ($obj->interactiveflag == "0") print("SELECTED"); ?>>-- N O N --</option>
    </select>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">moderatorflag &nbsp;</td> 
   <td class="color3">
    <select name="p_moderatorflag">
     <option value="1" <?php if ($obj->moderatorflag == "1") print("SELECTED"); ?>>-- O U I --</option>
     <option value="0" <?php if ($obj->moderatorflag == "0") print("SELECTED"); ?>>-- N O N --</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">identificationlevel &nbsp;</td> 
   <td class="color3">
    <select name="p_identificationlevel">
     <option value="0" <?php if ($obj->identificationlevel  == "O") print("SELECTED"); ?>>-- R I E N --</option>
     <option value="1" <?php if ($obj->identificationlevel  == "1") print("SELECTED"); ?>>-- N I C K --</option>
     <option value="2" <?php if ($obj->identificationlevel  == "2") print("SELECTED"); ?>>-- N I C K / E M A I L --</option>
    </select>
   </td>
  </tr>
 </table> 

<br>

 <select name="p_boardaction">
  <option value="adminstore">-- enregistrer les modifications --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back_url("$PHP_SELF?p_boardaction=view&p_idboard=$p_idboard"); ?>



