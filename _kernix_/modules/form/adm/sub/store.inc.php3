<?php

$l_name = strtoupper($p_name);

if ($p_formflag == "create")
{
  $l_sql = "SELECT * FROM $table_form WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_form (name,subject,nbfield,date) VALUES ('$l_name','$p_subject','$p_nbfield','$l_date')";
  $c_db->query($l_sql);
  $p_idform = $c_db->get_id();
  include("sub/fieldview.inc.php3");
  return 1;
}

$l_sql = "UPDATE $table_form SET name = '$l_name', subject = '$p_subject', msg_valid = '$p_msg_valid', msg_error = '$p_msg_error', nbfield = '$p_nbfield', display = '$p_display', idegroup = '$p_idegroup', email = '$p_email', emailflag = '$p_emailflag' WHERE idform = '$p_idform'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


