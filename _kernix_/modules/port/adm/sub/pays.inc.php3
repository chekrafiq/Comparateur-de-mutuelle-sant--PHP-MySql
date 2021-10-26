<?php

if (isset($p_paysaction))
{
  if ($p_paysaction == "del")
  {
    $l_sql = "DELETE FROM $table_portzone WHERE id_portzone = $p_idportzone";
    $c_db->query($l_sql);
  }
  elseif ($p_paysaction == "add")
    {
      $l_sql = "INSERT INTO $table_portzone (zone_name) values ('NOUVEAU')";
      $c_db->query($l_sql);
    }
  else
  {
    $l_sql = "SELECT * FROM $table_portsupplier ORDER BY name";
    $c_db->query($l_sql);
    $l_toupdate = "";
    while ($supplier = $c_db->object_result())
    {
      $l_toupdate .= ", zoneid_$supplier->name = ".${"p_zoneid_$supplier->name"}." ";
    }
    
    $l_sql = "UPDATE $table_portzone SET zone_name = '$p_zonename', zone_code = '$p_zonecode' $l_toupdate WHERE id_portzone = $p_idportzone";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
}

$l_sql = "SELECT * FROM $table_portzone WHERE id_portzone = $p_idportzone";
$c_db->query($l_sql);
$obj = $c_db->object_result();
?>

<form action="<?php print($PHP_SELF); ?>" method="post">
<input type="hidden" name="p_portaction" value="pays">

<table align="center" width="85%">

 <tr>
  <td align="left" class="color1" height="20" colspan="2">
   :: Pays [<?php print($obj->id_portzone); ?>]
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   nom &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj->zone_name); ?>" name="p_zonename" class="text" size="45">
  </td>
 </tr>

 <tr>
  <td class="color2" width="30%" align="right">
   code &nbsp;
  </td>
  <td class="color3" align="left">
   <input type="text" value="<?php print($obj->zone_code); ?>" name="p_zonecode" class="text" size="4">
  </td>
 </tr>

<?php
$l_sql = "SELECT * FROM $table_portsupplier ORDER BY name";
$c_db->query($l_sql);
$i = 0;
while ($supplier = $c_db->object_result())
{
  $l_listinzonesupplier = "<select name=\"p_zoneid_$supplier->name\">";
  for ($k=1;$k<=$supplier->nbzone;$k++) { if ($k == $obj->{"zoneid_$supplier->name"}) { $l_selected = " SELECTED"; } else { $l_selected = ""; } $l_listinzonesupplier .= "<option value=\"$k\"$l_selected>$k</option>"; }
  $l_listinzonesupplier .= "</select>";
?>

 <tr>
  <td class="color2" width="30%" align="right">
   zone <?php print($supplier->name); ?> &nbsp;
  </td>
  <td class="color3" align="left">
   <?php print($l_listinzonesupplier); ?>
  </td>
 </tr>

<?php } ?>

 <tr>
  <td colspan="2" align="center">
   <br>
    <input type="hidden" name="p_idportzone" value="<?php print($p_idportzone)?>">
    <select name="p_paysaction" size="1">
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
