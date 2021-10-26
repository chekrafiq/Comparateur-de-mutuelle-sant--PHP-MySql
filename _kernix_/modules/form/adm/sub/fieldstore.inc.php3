<?php

$i = 1;
while ($i <= $p_nbfield)
{
  if (!empty(${"p_name$i"}))
  {
    $l_fieldstring .= $l_sepchar;
    $l_name = ereg_replace(" ","_",${"p_name$i"});
    $l_fieldstring .= $l_name . ";;" . ${"p_type$i"} . ";;" . ${"p_value$i"} . ";;" . ${"p_required$i"};
    $l_sepchar = "&&";
  }
  $i++;
}

$l_sql = "UPDATE $table_form SET fieldstring = '$l_fieldstring' WHERE idform = '$p_idform'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>
