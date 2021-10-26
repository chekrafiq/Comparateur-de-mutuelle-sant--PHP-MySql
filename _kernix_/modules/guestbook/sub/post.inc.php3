
<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_gbaction"  value="store">
 <input type="hidden" name="p_validflag" value="<?php if ($gb->moderatorflag == 0) print("1"); else print("0"); ?>">
 <input type="hidden" name="p_idref"     value="<?php print($p_idref); ?>">

 <table align="center" width="200"> 
  <tr>
   <td width= 30% align="left" class="main">titre &nbsp;</td>
  </tr>
  <tr>
   <td class="main">
    <input type="text" name="p_title" class="text" size="40">
   </td>
  </tr> 
  <tr>
   <td align="left" valign="top" class="main">contenu &nbsp;</td> 
  </tr>
  <tr>
   <td class="main">
    <textarea name="p_content" cols="40" rows="10" class="text"></textarea>
   </td>
  </tr>
  <tr>
   <td class="main"><br></td> 
  </tr>
  <tr>
   <td width= 30% align="left" class="main">pseudonyme &nbsp;</td> 
  </tr>
  <tr>
   <td class="main">
    <input type="text" name="p_nickname" class="text" size="35" value="<?php print($c_cookie->search("nickname")); ?>">
   </td>
  </tr>
  <tr>
   <td width= 30% align="left" class="main">email &nbsp;</td> 
  </tr>
  <tr>
   <td class="main">
    <input type="text" name="p_email" class="text" size="35" value="<?php print($c_cookie->search("email")); ?>">
   </td>
  </tr>
  <tr>
   <td width= 30% align="left" class="main">homepage &nbsp;</td> 
  </tr>
  <tr>
   <td class="main">
    <input type="text" name="p_url" class="text" size="35" value="<?php print($c_cookie->search("url")); ?>">
   </td>
  </tr>
  <tr>
   <td class="main">
    <input type="checkbox" name="p_storecookie" value="email,nickname,url"> 
    stocker mes informations
   </td>
  </tr>  
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer mon avis" class="button">
   </td>
  </tr> 
 </table> 

</form> 

