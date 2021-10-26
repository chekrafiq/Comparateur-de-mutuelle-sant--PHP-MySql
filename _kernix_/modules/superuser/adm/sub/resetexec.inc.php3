<?php

$l_tables = join(", ",$p_tables);
$i = 0;
while ($p_tables[$i])
{
  $l_sql = "DELETE FROM " . $p_tables[$i];
//  print($l_sql);
  $c_db->query($l_sql);
  $i++;
}

show_response("< <i>$l_tables</i> > reseted.");

include("sub/home.inc.php3");

?>



