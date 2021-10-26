
<br><br>

<form action="<?=$PHP_SELF?>" method="POST">
<input type="hidden" name="p_mailaction" value="list">
<input type="hidden" name="p_storecookie" value="poplogin,poppassword">
<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="middle" width="70%"><tr><td>

<table bgcolor="black" border="0" cellspacing="1" cellpadding="2" width="100%">
 <tr>
  <td class="color2" align="center" colspan="2"> &#187; reception &#171; </td>
 </tr>
 <tr>
  <td align="center" class="color3">
  <table border="0" align="center">
   <tr>
    <td align="right" class="color3" width="47%">identifiant &nbsp;</td>
    <td align="left" class="color3">
     <input name="p_poplogin" type="text" class="text" size="16" value="<?=$l_poplogin?>">
    </td>
   </tr>
   <tr>
    <td align="right" class="color3">mot de passe &nbsp;</td>
    <td align="left" class="color3">
     <input name="p_poppassword" type="password" class="text" size="16" value="<?=$l_poppassword?>">
    </td>
   </tr>
   <tr>
    <td align="left" class="color3" colspan="2">
     <input type="submit" class="button" value="recevoir mes messages"></td>
   </tr>   
  </table>
  </td>
 </tr>
</form>
</table>
</td></tr></table>

<br><br><br><br>
