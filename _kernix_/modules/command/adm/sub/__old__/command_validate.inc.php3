<?php
// Get all infos from command
$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);
$l_row = $c_db->object_result();

// Update product table for the stock
if ($l_admshop->stockmodeflag == 1)
{
  include("$g_modulespath/command/adm/sub/command_back_majstock.inc.php3");
}

// Update affiliation
include("$g_modulespath/command/adm/sub/command_back_majaffiliate.inc.php3");

// Update client profile
include("$g_modulespath/command/adm/sub/command_back_majclientprofile.inc.php3");

// Update command status
$l_sql = "UPDATE $table_command SET status = 20 where idcommand = '$p_idcommand'";
$c_db->query($l_sql);

show_response("validation effectuée");

print("<br>");

include("sub/home.inc.php3");

?>
