<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="affiliateview">

 <table align=center width=90%> 
   <tr>
    <td align=right class=main width=50%>affiliate login</td> 
    <td class=main width=50%><input type=text name="p_login" class=widget size=10></td>
   </tr> 
   <tr>
    <td align=right class=main width=50%>affiliate password</td> 
    <td class=main width=50%><input type=password name="p_password" class=widget size=10></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><input type=submit value=entrer class=button></td>
   </tr>
 </table> 

</form>

<?php show_white_hr(); ?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="affiliatenew">
<br><input type=submit value="je souhaite devenir affilié à ce site" class=button>
</form>

<?php show_white_hr(); ?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="affiliatesendpassword"> 

 <table align=center width=90%> 
   <tr>
    <td align=right class=main width=50%>affiliate login</td> 
    <td class=main width=50%><input type=text name="p_login" class=widget size=10></td>
   </tr> 
   <tr>
    <td class=main align=center colspan=2><br><input type=submit value="envoyer mon mot de passe par email" class=button></td>
   </tr>
 </table> 
</form>

