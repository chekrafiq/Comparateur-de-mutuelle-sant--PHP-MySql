<?php

$l_email = $adm->email;

?>

<br>

<form action="<?=$PHP_SELF?>" method="POST">
<input type="hidden" name="p_mailaction" value="sendmail">
<input type="hidden" name="p_msgno" value="<?=$p_msgno?>">
<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="middle" width="70%"><tr><td>

<table bgcolor="black" border="0" cellspacing="1" cellpadding="2" width="100%">
 <tr>
  <td class="color2" align="center" colspan="2"> &#187; emission &#171; </td>
 </tr>
 <tr>
  <td align="center" class="color3">
  <table border="0" align="center">
   <tr>
    <td align="right" class="color3">de &nbsp;</td>
    <td align="left" class="color3">
     <input name="p_from" type="text" class="text" size="30" value="<?=$l_email?>">
    </td>
   </tr>
   <tr>
    <td align="right" class="color3">à &nbsp;</td>
    <td align="left" class="color3">
     <input name="p_to" type="text" class="text" size="30" value="<?=$p_replyto?>">
    </td>
   </tr>
   <tr>
    <td align="right" class="color3">sujet &nbsp;</td>
    <td align="left" class="color3">
     <input name="p_subject" type="text" class="text" size="50">
    </td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color3">corps &nbsp;</td>
    <td align="left" class="color3">
     <textarea name="p_body" class="text" cols="50" rows="8"></textarea>
    </td>
   </tr>
   <tr>
    <td class="color3">&nbsp;</td>
    <td align="left" class="color3">
     <input type="submit" class="button" value="envoyer mon message"></td>
   </tr>   
  </table>
  </td>
 </tr>
</form>
</table>
</td></tr></table>

<br>






