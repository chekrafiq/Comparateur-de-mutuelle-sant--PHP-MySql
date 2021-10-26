<?php

if ($p_storeflag == "yes")
{
  $l_sql = "UPDATE $table_command SET status = '$p_status' WHERE idcommand = '$p_idcommand'";
  $c_db->query($l_sql);
  include("sub/command_view.inc.php3");
  return 1;
}

$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);
$command = $c_db->object_result();

$l_sql = "SELECT * FROM $table_commandstatus WHERE mode = '$command->mode' AND status > 2 ORDER BY status";
$c_db->query($l_sql);
$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_status[$i][0] = $obj->idcommandstatus;
  $tab_status[$i][1] = $obj->name;
  $i++;
}

?>

<br>
<table width=90% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
 <tr>
  <td class=color2 align=center> &#187; forcer un état &#171; </td></tr>
  <tr>
   <td class=list align=center height=20 valign=center>

<br>
<form action"<?php print($PHP_SELF)?>" method="post">
<input type="hidden" name="p_commandaction"  value="command_force_chgstatus">
<input type="hidden" name="p_storeflag"  value="yes">
<input type="hidden" name="p_idcommand"  value="<?php print($p_idcommand)?>">

 <select name="p_status">
<?php

$i = 0;
while ($tab_status[$i])
{
  print("<option value=" . $tab_status[$i][0] . ">-- " . strtoupper($tab_status[$i][1]) . " --</option>\n");
  $i++;
}

?>
  <option value="0">-- ANNULEE --</option>
 </select><br><br>
 <input type=submit value="changer l'état" class=button>
</form>
<br>
 
  </td>
 </tr>
</table>

<br><br>
<?php show_back(); ?>
