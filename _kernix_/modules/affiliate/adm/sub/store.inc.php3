<?php

if ($p_affiliateflag == "create")
{
     $l_sql = "SELECT * FROM $table_affiliate WHERE login = '$affiliate->login' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $affiliate->login > déjà présent.");
	  include("sub/home.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_affiliate (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idaffiliate = $c_db->get_id();
}

$l_sql = "UPDATE $table_affiliate SET lastname = '$p_lastname', firstname = '$p_firstname', login = '$p_login', password = '$p_password', address = '$p_address', email = '$p_email', url = '$p_url', payableto = '$p_payableto', date = '$l_date' WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>


