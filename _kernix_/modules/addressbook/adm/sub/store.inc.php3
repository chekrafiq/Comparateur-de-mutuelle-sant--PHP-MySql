<?php

if ($p_addressbookflag == "create")
{
  $l_sql = "INSERT INTO $table_addressbook (firstname, lastname, date) VALUES ('$p_firstname', '$p_lastname', '$l_date')";
  $c_db->query($l_sql);
  $p_idaddressbook = $c_db->get_id();
}

if (is_valid_email($p_email))
{
  $l_sql = "DELETE FROM $table_email WHERE idsource = '$p_idaddressbook' AND idegroup = '2'";
  $c_db->query($l_sql);
  $l_sql = "REPLACE INTO $table_email (idegroup,emailkey,email,opt,source,idsource,date) VALUES ('2','2-$p_email','$p_email','OUT','ADDRESSBOOK','$p_idaddressbook','$l_date')";
  $c_db->query($l_sql);
}

$l_sql = "UPDATE $table_addressbook SET firstname = '$p_firstname', lastname = '$p_lastname',email = '$p_email', address = '$p_address', town = '$p_town', country = '$p_country', zipcode = '$p_zipcode', company = '$p_company', note = '$p_note', url = '$p_url', phone = '$p_phone', cellphone = '$p_cellphone', workphone = '$p_workphone', fax = '$p_fax', date = '$l_date' WHERE idaddressbook = '$p_idaddressbook'";
$c_db->query($l_sql);

show_response("modification éffectuée");
include("sub/view.inc.php3");

?>
