<?php

$l_sql = "SELECT * FROM $table_showcase WHERE idref = '$p_idref' ";
$c_db->query($l_sql);

if ($c_db->numrows > 0)
{
     show_response("le produit est déjà dans le showcase.");
     include("sub/listshowcase.inc.php3");
     return 1;
}

$l_sql = "INSERT INTO $table_showcase (idref,date) VALUES ('$p_idref','$l_date')";
$c_db->query($l_sql);
show_response("enregistrement effectué.");
include("sub/listshowcase.inc.php3");
     
?>
