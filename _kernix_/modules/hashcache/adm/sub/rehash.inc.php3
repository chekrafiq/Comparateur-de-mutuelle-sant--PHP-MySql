<?php

$g_rehashflag = 1;

$l_sql = "DELETE FROM $table_hash";
$c_db->query($l_sql);

$l_sql = "SELECT * FROM $table_ref";
$c_db->query($l_sql);

$j = 0;
while ($l_ref = $c_db->object_result())
{
     $j++;
     $p_idref = $l_ref->idref;
     include("$g_modulespath/hash/adm/sub/insertref.inc.php3");
}

show_response("rehash done<br> [ $j  ] pgaes processed");
include("sub/home.inc.php3");

?>
