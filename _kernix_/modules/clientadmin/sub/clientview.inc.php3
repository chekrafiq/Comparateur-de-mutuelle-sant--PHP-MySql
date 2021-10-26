<?php
$l_sql = "SELECT * FROM $table_client WHERE login = '$p_login'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_ca_response("les informations fournies ne sont pas correctes");
     show_ca_back();
     return 0;
}

$obj = $c_db->object_result();
if ($p_password != $obj->password)
{
     show_ca_response("les informations fournies ne sont pas correctes");
     show_ca_back();
     return 0;
}


$l_countrylist = build_select($table_zone,$obj->idportzone,"id_portzone","zone_name","p_idportzone","","","");

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name=p_clientadminaction value=clientstore>	
<input type=hidden name=p_idclient value="<?php print("$obj->idclient"); ?>">				     
<input type=hidden name=p_login value="<?php print("$obj->login"); ?>">	
<input type=hidden name=p_password value="<?php print("$obj->password"); ?>">
 <table align=center width=90%> 
   <tr>
    <td align=right class=main>titre</td> 
    <td class=main>
     <select name="p_title">
      <option value="Mr">-- Mr --</option>
      <option value="Mme" <?php if ($obj->title == "Mme") print("SELECTED"); ?>>-- Mme --</option>
      <option value="Mme" <?php if ($obj->title == "Mle") print("SELECTED"); ?>>-- Mle --</option>
     </select>
    </td>
   </tr>
   <tr>
    <td align=right class=main>prénom</td> 
    <td class=main><input type=text name="p_firstname" class=widget value="<?php print("$obj->firstname"); ?>"></td>
   </tr>
    <tr>
    <td align=right class=main>nom</td> 
    <td class=main><input type=text name="p_lastname" class=widget value="<?php print("$obj->lastname"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main>email 1</td> 
    <td class=main><input type=text name="p_email1" class=widget value="<?php print("$obj->email1"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main>email 2 (*)</td> 
    <td class=main><input type=text name="p_email2" class=widget size=40 value="<?php print("$obj->email2"); ?>"></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>téléphone</td> 
    <td class=main><input type=text name="p_phone" class=widget size=40 value="<?php print("$obj->phone"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>téléphone (job) (*)</td> 
    <td class=main><input type=text name="p_workphone" class=widget size=40 value="<?php print("$obj->workphone"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>portable (*)</td> 
    <td class=main><input type=text name="p_cellphone" class=widget size=40 value="<?php print("$obj->cellphone"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>fax (*)</td> 
    <td class=main><input type=text name="p_fax" class=widget size=40 value="<?php print("$obj->fax"); ?>"></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><br></td>
   </tr>
   <tr>
    <td align=right class=main valign=top>adresse</td> 
    <td class=main><textarea name="p_address" cols=40 rows=5 class=widget><?php print("$obj->address"); ?></textarea></td>
   </tr>
   <tr>
    <td align=right class=main>ville</td> 
    <td class=main><input type=text name="p_town" class=widget size=40 value="<?php print("$obj->town"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main>codepostal</td> 
    <td class=main><input type=text name="p_zipcode" class=widget size=40 value="<?php print("$obj->zipcode"); ?>"></td>
   </tr>
   <tr>
    <td align=right class=main>pays</td> 
    <td class=main><?php print("$l_countrylist"); ?></td>
   </tr>
   <tr>
    <td class=main align=center colspan=2><br><input type=submit value="enregistrer" class=button></td>
   </tr>
 </table> 
</form>
