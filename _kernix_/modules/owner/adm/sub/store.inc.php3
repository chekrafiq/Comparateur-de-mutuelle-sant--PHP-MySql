<?php

$l_login = strtoupper($p_login);

if ($p_ownerflag == "create")
{
     $l_sql = "SELECT * FROM $table_owner WHERE login = '$l_login' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_login > déjà présent.");
	  include("sub/list.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_owner (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idowner = $c_db->get_id();
}

$l_sql = "UPDATE $table_owner SET login = '$l_login', password = '$p_password', idproperty = '$p_idproperty' WHERE idowner = '$p_idowner'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


