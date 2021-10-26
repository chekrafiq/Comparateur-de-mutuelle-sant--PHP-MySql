<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="affiliatestore"> 
<input type=hidden name="p_clientadminflag" value="create"> 

 <table align=center width=90%> 
   <tr>
    <td align=right class=main>login</td> 
    <td class=main width=65%><input type=text name="p_login" class=widget></td>
   </tr>
   <tr>
    <td align=right class=main>password</td> 
    <td class=main><input type=password name="p_password" class=widget></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main>prénom</td> 
    <td class=main><input type=text name="p_firstname" class=widget></td>
   </tr>
    <tr>
    <td align=right class=main>nom</td> 
    <td class=main><input type=text name="p_lastname" class=widget></td>
   </tr>
   <tr>
    <td align=right class=main>email</td> 
    <td class=main><input type=text name="p_email" class=widget></td>
   </tr>
   <tr>
    <td align=right class=main>url ( optionnel )</td> 
    <td class=main><input type=text name="p_url" class=widget size=40></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>ordre ( chèque )</td> 
    <td class=main><input type=text name="p_payableto" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>adresse ( chèque )</td> 
    <td class=main><textarea name="p_address" cols=40 rows=10 class=widget></textarea></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><input type=submit value="enregistrer" class=button></td>
   </tr>
 </table> 
</form>
