<?php

if (isset($p_supplieraction))
{
  if ($p_supplieraction == "del")
  {
    $l_sql = "SELECT * FROM $table_portsupplier WHERE idport_supplier = $p_idportsupplier";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
    $obj_supplier = $c_db->object_result();
    
    $l_sql = "DELETE FROM $table_portsupplier WHERE idport_supplier = $p_idportsupplier";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);

    $l_sql = "ALTER TABLE $table_portzone DROP COLUMN zoneid_$obj_supplier->name";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);

    show_response("Suppression effectuée");
    include("$g_modulespath/port/adm/sub/home.inc.php3");
    return;
  }
  elseif ($p_supplieraction == "addform")
  {
?>

<form action="<?php print($PHP_SELF); ?>"	method="post">
<input type="hidden" name="p_portaction"	value="supplier">
<input type="hidden" name="p_supplieraction"	value="add">

<table align="center" width="85%">

 <tr>
  <td align="left" class="color1" height="20" colspan="2">
   :: Ajout fournisseur
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   nom &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj_supplier->name); ?>" name="p_name" class="text" size="45">
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   nombre de zone &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj_supplier->nbzone); ?>" name="p_nbzone" class="text" size="4">
  </td>
 </tr>

 <tr>
  <td colspan="2" align="center">
    <input type="submit" name="submit" value="exécuter" class="button">
  </td>
 </tr>

</table>
</form>

<br>

<?php
      
    ext_show_back("p_portaction", "home", "", "");
    return;
  }
  elseif ($p_supplieraction == "add")
    {
      $p_name = ereg_replace(" ", "", $p_name);
      $l_sql = "INSERT INTO $table_portsupplier (name, nbzone, creationdate, updatedate) values ('$p_name', '$p_nbzone', '$l_date', '$l_date')";
//      print("->$l_sql<br>");
      $c_db->query($l_sql); 
      $p_idportsupplier = $c_db->get_id();
      
      $l_sql = "CREATE TABLE IF NOT EXISTS port_wz_$p_name (";
      $l_sql .= "idportwz smallint(5) unsigned NOT NULL auto_increment,";
      $l_sql .= "price float(12,2) unsigned NOT NULL default '0.00',";
      $l_sql .= "price_express float(12,2) unsigned NOT NULL default '0.00',";
      $l_sql .= "zoneid int(11) NOT NULL default '0',";
      $l_sql .= "weight int(11) NOT NULL default '0',";
      $l_sql .= "PRIMARY KEY  (idportwz)";
      $l_sql .= ") TYPE=ISAM PACK_KEYS=1";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      
      $l_sql = "ALTER TABLE $table_portzone ADD COLUMN (zoneid_$p_name tinyint(3) unsigned NOT NULL default '0')";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
    }
  else
  {
    $l_sql = "UPDATE $table_portsupplier SET nbzone = $p_nbzone, notes = '$p_notes' WHERE idport_supplier = $p_idportsupplier";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }  
}

$l_sql = "SELECT * FROM $table_portsupplier WHERE idport_supplier = $p_idportsupplier";
//print("->$l_sql<br>");
$c_db->query($l_sql);
$obj_supplier = $c_db->object_result();

?>

<form action="<?php print($PHP_SELF); ?>" method="post">
<input type="hidden" name="p_portaction" value="supplier">

<table align="center" width="85%">

 <tr>
  <td align="left" class="color1" height="20" colspan="2">
   :: Fournisseur  [<?php print($obj_supplier->idport_supplier); ?>] - Créé le : <?php print(show_date($obj_supplier->creationdate)); ?> - Dernière maj : <?php print(show_date($obj_supplier->updatedate)); ?>
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   nom &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj_supplier->name); ?>" name="p_name" class="text" size="45">
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   nombre de zone &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj_supplier->nbzone); ?>" name="p_nbzone" class="text" size="4">
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   remarques &nbsp;
  </td>
  <td class="color3" align="left">
   <textarea name="p_notes" cols="65" rows="3"><?php print($obj_supplier->notes); ?></textarea>
  </td>
 </tr>

 <tr>
  <td colspan="2" align="center">
   <br>
    <input type="hidden" name="p_idportsupplier" value="<?php print($p_idportsupplier)?>">
    <select name="p_supplieraction" size="1">
     <option value="update" selected> -- enregistrer les modifications -- </option>
     <option value="del">-- supprimer --</option>
    </select>
    <input type="submit" name="submit" value="exécuter" class=button>
  </td>
 </tr>

</table>
</form>
<br>
<?php ext_show_back("p_portaction", "home", "", "") ?>


<?php

if (isset($p_wzaction))
{
  if ($p_wzaction == "del")
  {
    $l_sql = "DELETE FROM port_wz_$obj_supplier->name WHERE idportwz = $p_idportwz";
    $c_db->query($l_sql);
  }
  elseif ($p_wzaction == "add")
  {
    $l_sql = "INSERT INTO port_wz_$obj_supplier->name (zoneid) values (0)";
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE port_wz_$obj_supplier->name SET price = $p_price, price_express = $p_priceexpress, zoneid = $p_zoneid, weight = $p_weight WHERE idportwz = $p_idportwz";
    $c_db->query($l_sql);
  }  
  
  $l_sql = "UPDATE $table_portsupplier SET updatedate = '$l_date' WHERE idport_supplier = $p_idportsupplier";
  $c_db->query($l_sql);    
}
?>

<?php

$l_sql = "SELECT * FROM port_wz_$obj_supplier->name ORDER BY zoneid, weight";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucune valeur");
  show_hr();
  print("<form action=$PHP_SELF method=post>\n");
  print("<input type=hidden name=p_portaction		value=supplier>\n");
  print("<input type=hidden name=p_wzaction		value=add>\n");
  print("<input type=hidden name=p_idportsupplier	value=$p_idportsupplier>");
  print("<input type=submit value='Ajoutée une valeur' class=button>\n");
  print("</form>\n");
  return 0;
}

?>


<table align="center" width="85%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   zone
  </td>
  <td class="color2" align="center" width="20%">
   poids
  </td>
  <td class="color2" align="center" width="28%">
   prix économique 
  </td>
  <td class="color2" align="center" width="20%">
   prix express
  </td>
  <td class="color2" align="center" width="12%">
   &nbsp;
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<form action=$PHP_SELF method=post name=form$i>");
  print("<input type=hidden name=p_portaction		value=supplier>");
  print("<input type=hidden name=p_wzaction		value=update>");
  print("<input type=hidden name=p_idportwz		value=$obj->idportwz>");
  print("<input type=hidden name=p_idportsupplier	value=$p_idportsupplier>");
  print("<tr><td class=$l_class align=center>$obj->idportwz</td>");
  print("<td class=$l_class align=center><input type=text value=\"$obj->zoneid\" name=p_zoneid size=1 class=text></td>");
  print("<td class=$l_class align=center><input type=text value=\"$obj->weight\" name=p_weight size=5 class=text></td>");
  print("<td class=$l_class align=center><input type=text value=\"$obj->price\" name=p_price size=6 class=text></td>");
  print("<td class=$l_class align=center><input type=text value=\"$obj->price_express\" name=p_priceexpress size=6 class=text></td>");
  print("<td class=$l_class align=center><a href=\"javascript:document.form$i.submit()\" class=truelink title=\"Enregistrer les modifications de cette ligne\">V</a> - <a href=\"$PHP_SELF?p_portaction=supplier&p_wzaction=del&p_idportwz=$obj->idportwz&p_idportsupplier=$p_idportsupplier\" class=truelink title=\"Supprimer cette ligne\">X</a></td></tr></form>\n");
}

?>

</table>

<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_portaction"	value="supplier">
 <input type="hidden" name="p_wzaction"		value="add">
 <input type="hidden" name="p_idportsupplier"	value="<?php print($p_idportsupplier); ?>">
 <input type="submit" value="Ajouter une valeur" class="button">
</form>
