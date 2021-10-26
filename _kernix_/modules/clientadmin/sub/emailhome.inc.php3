<?php

$l_action = "emaillist";

if (isset($p_nl))
{
  $p_idegroup = $p_nl;
  $l_action   = "emailsuppress";
}



?>

<br><br>

<form  method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_clientadminaction" value="<?=$l_action?>"> 
<input type="hidden" name="p_tabegroup[]"       value="<?=$p_idegroup?>"> 

 <table align="center" width="90%"> 
   <tr>
    <td align="right" class="main" width="50%">
     supprimer mon email &nbsp;
    </td> 
    <td class="main" width="50%">
     <input type="text" name="p_email" class="widget">
    </td>
   </tr>
   <tr>
    <td class="main" align="center" colspan="2">
     <br><input type="submit" value="supprimer" class="button">
    </td>
   </tr> 
 </table> 

</form>

