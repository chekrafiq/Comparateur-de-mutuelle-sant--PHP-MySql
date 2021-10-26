<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_commandstatusaction" value="store">
 <input type="hidden" name="p_commandstatusflag" value="create">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau status
   </td> 
  </tr>
  <tr>
   <td width="30%" align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <select name="p_mode">
     <option value="CHQ">-- CHEQUE --</option>
     <option value="CCB">-- CARTE BLEUE --</option>
     <option value="VIR">-- VIREMENT --</option>
     <option value="TEST">-- TEST --</option>
     <option value="NONE">-- NONE --</option>
    </select>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">statut &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_status" class="text" size="5">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">name &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="35" size="40">
   </td>
  </tr>
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 
