<?php

$l_name = strtoupper($p_name);

if (isset($p_viewflag)) $p_viewflag = 1;

if ($p_storeflag == "create")
{
  $l_sql = "SELECT * FROM $table_poll WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_poll (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idpoll = $c_db->get_id();
}

$l_sql = "UPDATE $table_poll SET name = '$l_name', label = '$p_label', option1 = '$p_option1', option2 = '$p_option2', option3 = '$p_option3', option4 = '$p_option4', option5 = '$p_option5', option6 = '$p_option6', option7 = '$p_option7', option8 = '$p_option8', option9 = '$p_option9', option10 = '$p_option10', viewflag = '$p_viewflag' WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>

