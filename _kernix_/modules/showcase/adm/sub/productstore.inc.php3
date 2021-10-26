<?php

$l_sql = "SELECT * FROM $table_sp WHERE idref = '$p_idref' AND idshowcase = '$p_idshowcase'";
$c_db->query($l_sql);

if ($c_db->numrows > 0)
{
  show_response("ref déjà présente.");
  include("sub/view.inc.php3");
  return 0;
}

$l_sql = "INSERT INTO $table_sp (idref,idshowcase,date) VALUES ('$p_idref','$p_idshowcase','$l_date')";
$c_db->query($l_sql);

include("sub/view.inc.php3");

?>


