<?php

$l_sql = "SELECT * FROM $table_client WHERE idclient = '$p_idclient'";
$c_db->query($l_sql);
$client = $c_db->object_result();

$l_countrylist = build_select("port_zone",$client->idportzone,"id_portzone","zone_name","p_idportzone","","","");

?>


<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type=hidden name="p_idclient"       value="<?php print($p_idclient); ?>">

<table align=center width=95%> 
 <tr>
  <td align=left class=color1 colspan=2>:: client n°<?php print($p_idclient); ?></td> 
 </tr>

<? /* ?>
 <tr>
  <td align=right class=color2>login</td> 
  <td class=color3><input type=text name="p_login" class=text value="<?php print($client->login); ?>"></td>
 </tr>
<? */ ?>
 <input type=hidden name="p_login" value="<?=$client->login?>">

 <tr>
  <td align=right class=color2>email&nbsp;</td> 
  <td class=color3><input type=text name="p_email1" class=text value="<?php print($client->email1); ?>"></td>
 </tr>

 <tr>
  <td align=right class=color2>mot de passe&nbsp;</td> 
  <td class=color3><input type=text name="p_password" class=text value="<?php print($client->password); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2 width=30%>titre&nbsp;</td> 
  <td class=color3>
   <select name="p_title" class="text">
    <option value="Mr">-- Mr --</option>
    <option value="Mme" <?php if ($client->title == "Mme") print("SELECTED"); ?>>-- Mme --</option>
    <option value="Mme" <?php if ($client->title == "Mle") print("SELECTED"); ?>>-- Mle --</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>nom&nbsp;</td> 
  <td class=color3><input type=text name="p_lastname" class=text value="<?php print($client->lastname); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>prénom&nbsp;</td> 
  <td class=color3><input type=text name="p_firstname" class=text value="<?php print($client->firstname); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>société&nbsp;</td> 
  <td class=color3><input type=text name="p_company" class=text value="<?php print($client->company); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>téléphone&nbsp;</td> 
  <td class=color3><input type=text name="p_phone" class=text value="<?php print($client->phone); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>téléphone mobile&nbsp;</td> 
  <td class=color3><input type=text name="p_cellphone" class=text value="<?php print($client->cellphone); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>fax&nbsp;</td> 
  <td class=color3><input type=text name="p_fax" class=text value="<?php print($client->fax); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2 valign=top>adresse&nbsp;</td> 
  <td class=color3><textarea name="p_address" cols=30 rows=3 class=text><?php print($client->address); ?></textarea>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>ville&nbsp;</td> 
  <td class=color3><input type=text name="p_town" class=text value="<?php print($client->town); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>code postal&nbsp;</td> 
  <td class=color3><input type=text name="p_zipcode" class=text value="<?php print($client->zipcode); ?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>pays&nbsp;</td> 
  <td class=color3><?php print("$l_countrylist"); ?></td>
 </tr>

</table> 

<br><br>

<?php show_hr(); ?>

<br><br>

 <select name="p_clientaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce profil --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_hr(); ?>

<br>

<table width=95% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
 <tr>
  <td align=center class=color2 class=50%> &#187; visiteurs &#171; </td>
  <td align=center class=color2> &#187; commandes &#171; </td>
 </tr>
 <tr>
  <td align=center class=list class=33% valign=top>
<?php

$l_sql = "SELECT * FROM $table_visitor WHERE idclient = '$p_idclient' ORDER BY idvisitor DESC";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("<a href=\"/$g_modulespath/visitor/adm/?p_visitoraction=view&p_idvisitor=$obj->idvisitor\" title=\"$obj->remotehost\">$obj->idvisitor</a><br>");
}

?>
  </td>
  <td align=center class=list valign=top>
<?php

$l_sql = "SELECT * FROM $table_command WHERE idclient = '$p_idclient' ORDER BY date DESC";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("n° <a href=\"/$g_modulespath/command/adm/?p_commandaction=command_view&p_idcommand=$obj->idcommand\" title=\"<$obj->idcommand> $obj->pricettcport $obj->currency\">" . sprintf("%03d",$obj->idcommand) . "</a> - " . show_date($obj->date) . " [$obj->mode]<br>");
}

?>
  </td>
 </tr>
</table>

<br>

<?php show_back(); ?>
