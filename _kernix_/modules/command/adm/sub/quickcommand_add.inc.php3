
<form action="<?=$PHP_SELF?>" method="POST">
<input type="hidden" name="p_commandaction" value="quickcommand_store">
<input type="hidden" name="p_clientflag" value="create">

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>

<tr><td class=color2 align=center> &#187; client &#171; </td></tr>
<tr><td class=list align=center height=20 valign=center>
<br>
<select name="p_idclient">
<option value=0>-- choix du client si existant --</option>
<?php

$l_sql = "SELECT * FROM $table_client ORDER BY lastname";
$c_db->query($l_sql);

if ($c_db->numrows > 0)
{
  while ($obj = $c_db->object_result())
  {
    print("<option value=$obj->idclient>-- $obj->title " . strtoupper($obj->lastname) . " $obj->firstname --</option>\n");
  }
}

?>
</select>
<br><br>

</td></tr>

<tr><td class=list align=center height=20 valign=center>

<table width=98% border=0 align=center cellspacing=3 cellpadding=3>

<tr>
 <td class=main align=right width=15%>titre</td>
 <td class=main>    
  <select name="p_title" class="caddietext">
   <option value="Mr">-- Mr --</option>
   <option value="Mme">-- Mme --</option>
   <option value="Mle">-- Mle --</option>
  </select>
 <td class=main width=15% align=right>login</td><td class=main><input type=text name=p_login class=text></td>
</tr>

<tr>
 <td class=main align=right>nom</td><td class=main><input type=text name=p_lastname class=text></td>
 <td class=main align=right>password</td><td class=main><input type=text name=p_password class=text></td>
</tr>

<tr>
 <td class=main align=right>prénom</td><td class=main><input type=text name=p_firstname class=text></td>
 <td class=main align=right>email</td><td class=main><input type=text name=p_email1 class=text></td>
</tr>

<tr>
 <td class=main align=right>ville</td><td class=main><input type=text name=p_town class=text></td>
 <td class=main align=right>téléphone</td><td class=main><input type=text name=p_phone class=text></td>
</tr>

<tr>
 <td class=main align=right>code postal</td><td class=main><input type=text name=p_zipcode class=text></td>
 <td class=main align=right>société</td><td class=main><input type=text name=p_company class=text></td>
</tr>


<tr>
 <td class=main valign=top align=right>adresse</td>
 <td class=main colspan=3>
  <textarea name=p_address class=text rows=4 cols=65></textarea>
 </td>
</tr>

<tr>
 <td class=main valign=top align=right>pays</td>
 <td class=main colspan=3>
<?php
$l_countrylist = build_select("port_zone","1","id_portzone","zone_name","p_idportzone","","","class=caddietext");
print $l_countrylist;
?>
  <br><br>
 </td>
</tr>

</table>

</td></tr>

<tr><td class=color2 align=center> &#187; descriptif commande &#171; </td></tr>

<tr><td class=list align=center height=20 valign=center>

<table width=81% border=0 align=center cellspacing=3 cellpadding=3>

<tr>
 <td class=main width=15%>titre de la commande</td>
</tr>

<tr>
 <td class=main align=center><input type=text name=p_command class=text size=73></td>
</tr>

<tr>
 <td class=main width=15%>descriptif</td>
</tr>

<tr>
 <td class=main align=center>
  <textarea name=p_description class=text rows=4 cols=73></textarea><br><br>
 </td>
</tr>

</table>

</td></tr>

<tr><td class=color2 align=center> &#187; prix &#171; </td></tr>

<tr><td class=list align=center height=20 valign=center>

<table width=85% border=0 align=center cellspacing=3 cellpadding=3>

<tr>
 <td class=main width=33% align=center>prix HT (<?=$g_currencyhtml?>)</td>
 <td class=main width=33% align=center>prix TTC (<?=$g_currencyhtml?>)</td>
 <td class=main align=center>port (<?=$g_currencyhtml?>)</td>
</tr>

<tr>
 <td class=main align=center><input type=text name=p_priceht class=text size=8></td>
 <td class=main align=center><input type=text name=p_pricettc class=text size=8></td>
 <td class=main align=center><input type=text name=p_port class=text size=8></td>
</tr>

</table>

</td></tr>

</table>
</td></tr></table>

<br><br>

<?php show_hr(); ?>

<br><br>

<input type=submit value="enregistrer la commande" class=button>

</form>

