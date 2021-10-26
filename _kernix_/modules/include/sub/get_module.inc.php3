<?php

$table_module = "module";

$l_str = getcwd();
$tab_cwd = explode("/",$l_str);

$g_modulepath = $tab_cwd[sizeof($tab_cwd) - 2];

$l_sql = "SELECT * FROM $table_module WHERE path = '$g_modulepath' ";
$c_db->query($l_sql);
$module = $c_db->object_result();

if (isset($g_titlemodule))
{
  $g_title = $g_titlemodule;
}
else
{
  $g_title = "Admin " . ucwords(strtolower($module->name));
}



include("$g_designpath/index_adm.inc.php3");

?>
