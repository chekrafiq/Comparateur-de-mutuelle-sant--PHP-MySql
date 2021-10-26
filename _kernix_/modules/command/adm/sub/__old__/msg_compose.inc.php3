
<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idcommand"         value="<?php print($p_idcommand); ?>">

 <table align="center" width="98%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Msg de confirmation
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">titre &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_title" class="text" value="<?php print($l_title); ?>" size="55">
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2" valign="top">contenu &nbsp;</td> 
   <td class="color3">
    <textarea name="p_content" cols="55" rows="20"><?php print($l_msg); ?></textarea>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">email &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_email" class="text" value="<?php print($l_email); ?>" size="55">
   </td>
  </tr>

 </table> 

<br>

<?php show_hr(); ?>

<br><br>

 <select name="p_commandaction">
  <option value="msg_send">-- envoyer ce message --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_hr(); ?>

<br>
