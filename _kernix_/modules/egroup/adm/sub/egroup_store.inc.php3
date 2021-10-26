<?php

$l_name = strtoupper($p_name);

if ($p_egroupflag == "create")
{
  $l_sql = "SELECT * FROM $table_egroup WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("egroup < <i>$p_name</i> > déjà présent.");
    include("sub/egroup_list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_egroup (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idegroup = $c_db->get_id();
}

if (!isset($p_notificationflag)) $p_notificationflag = 0;
if (!isset($p_confirmflag)) $p_confirmflag = 0;
if (!isset($p_formatflag)) $p_formatflag = 0;

$l_sql = "UPDATE $table_egroup SET name = '$l_name', subject = '$p_subject', msgok = '$p_msgok', msgbad = '$p_msgbad', msgconfirm = '$p_msgconfirm', confirmflag = '$p_confirmflag', formatflag = '$p_formatflag', notificationflag = '$p_notificationflag' WHERE idegroup = '$p_idegroup'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/egroup_view.inc.php3");

?>
