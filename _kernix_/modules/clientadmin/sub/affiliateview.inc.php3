<?php
$validator = new Validator();
$l_sql = "SELECT * FROM $table_affiliate WHERE login = '$p_login'";
$c_db->query($l_sql);


if ($c_db->numrows == 0)
{
  show_ca_response("les informations fournies ne sont pas correctes");
  show_ca_back();
  return 0;     
}

$affiliate = $c_db->object_result();
if ($p_password != $affiliate->password)
{
  show_ca_response("les informations fournies ne sont pas correctes");
  show_ca_back();
  return 0;     
}

include("$g_modulespath/clientadmin/sub/affiliatesummary.inc.php3");

?>


<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_clientadminaction" value="affiliatestore"> 
<input type=hidden name="p_idaffiliate" value="<?php print("$affiliate->idaffiliate"); ?>"> 
<input type=hidden name="p_login" value="<?php print("$affiliate->login"); ?>"> 
<input type=hidden name="p_password" value="<?php print("$affiliate->password"); ?>"> 

 <table align=center width=90%>  
   <tr>
    <td align=right class=main>prénom</td> 
    <td class=main width=70%>
     <input type=text name="p_firstname" class=widget value="<?php print("$affiliate->firstname"); ?>" size=30>
    </td>
   </tr>
   <tr>
    <td align=right class=main>nom</td> 
    <td class=main width=70%>
     <input type=text name="p_lastname" class=widget value="<?php print("$affiliate->lastname"); ?>" size=30>
    </td>
   </tr>
   <tr>
    <td align=right class=main width=30%>email</td> 
    <td class=main width=70%>
     <input type=text name="p_email" class=widget value="<?php print("$affiliate->email"); ?>" size=30>
    </td>
   </tr>
   <tr>
    <td align=right class=main>url</td> 
    <td class=main width=70%>
     <input type=text name="p_url" class=widget value="<?php print("$affiliate->url"); ?>" size=40>
    </td>
   </tr>
   <tr><td colspan=2 class=main><br><br></td></tr>
   <tr>
    <td align=right class=main valign=top>ordre<br> (pour le chèque)</td> 
    <td class=main valign=top>
     <input type=text name="p_payableto" class=widget value="<?php print("$affiliate->payableto"); ?>" size=40>
    </td>
   </tr>
   <tr>
    <td align=right class=main valign=top>adresse</td> 
    <td class=main>
     <textarea name="p_address" cols=40 rows=5 class=widget><?php print("$affiliate->address"); ?></textarea>
    </td>
   </tr>
   <tr>
    <td class=main align=center colspan=2>
     <br><input type=submit value="enregistrer" class=button>
    </td>
   </tr>
 </table> 

</form>

