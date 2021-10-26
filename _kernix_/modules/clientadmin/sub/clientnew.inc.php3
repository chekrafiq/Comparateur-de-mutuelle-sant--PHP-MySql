<?php

$l_countrylist = build_select($table_zone,"0","id_portzone","zone_name","p_idportzone","","","");

?>
<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="clientstore"> 
<input type=hidden name="p_clientadminflag" value="create">

 <table align=center width=95%>
   <tr>
    <td align=right class=main>identifiant / <small>login</small></td> 
    <td class=main width=60%%><input type=text name="p_login" class=widget></td>
   </tr>
   <tr>
    <td align=right class=main>mot de passe / <small>password</small></td> 
    <td class=main><input type=password name="p_password" class=widget></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main>titre / <small>title</small></td> 
    <td class=main>
     <select name="p_title" class=caddietext>
      <option value="Mr">-- Mr --</option>
      <option value="Mme">-- Mme --</option>
      <option value="Mle">-- Mle --</option>
     </select>  
    </td>
   </tr>
   <tr>
    <td align=right class=main>prénom / <small>firstname</small></td> 
    <td class=main><input type=text name="p_firstname" class=widget></td>
   </tr>
    <tr>
    <td align=right class=main>nom / <small>lastname</small></td> 
    <td class=main><input type=text name="p_lastname" class=widget></td>
   </tr>
   <tr>
    <td align=right class=main>email 1</td> 
    <td class=main><input type=text name="p_email1" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main>email 2 *</td> 
    <td class=main><input type=text name="p_email2" class=widget size=40></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>téléphone / <small>phone</small></td> 
    <td class=main><input type=text name="p_phone" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>téléphone (job) *</td> 
    <td class=main><input type=text name="p_workphone" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>portable / <small>mobile</small> *</td> 
    <td class=main><input type=text name="p_cellphone" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>fax *</td> 
    <td class=main><input type=text name="p_fax" class=widget size=40></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>adresse</td> 
    <td class=main><textarea name="p_address" cols=40 rows=5 class=widget></textarea>
    </td>
   </tr>
   <tr>
    <td align=right class=main>ville / <small>town</small></td> 
    <td class=main><input type=text name="p_town" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main>codepostal / <small>zipcode</small></td> 
    <td class=main><input type=text name="p_zipcode" class=widget size=40></td>
   </tr>
   <tr>
    <td align=right class=main>pays / <small>country</small></td> 
    <td class=main><?php print("$l_countrylist"); ?></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><input type=submit value="enregistrer" class=button></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br>(*) champs optionnels</td>
   </tr>
 </table> 
</form>






