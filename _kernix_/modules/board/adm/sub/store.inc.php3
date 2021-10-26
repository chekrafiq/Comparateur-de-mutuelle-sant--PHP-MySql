<?php

$l_title = strtoupper($p_title);

if ($p_boardflag == "create")
{
  $l_sql = "SELECT * FROM $table_board WHERE title = '$l_title' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_title > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_board (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idboard = $c_db->get_id();
  if ($p_type == "NEWS")
  {
    $p_interactiveflag = 0;
    $p_moderatorflag = 0;
  }
  elseif ($p_type == "FORUM")
    {
      $p_interactiveflag = 1;
      $p_moderatorflag = 0;
    }
  elseif ($p_type == "BOOKMARK")
    {
      $p_openextflag = 1;
    }
  else
  {
    $p_interactiveflag = 0;
    $p_moderatorflag = 0;
  }
  $p_moderatoremail = "contact@$g_domainname";
  $l_sql = "UPDATE $table_board SET title = '$l_title', description = '$p_description', type = '$p_type', interactiveflag = '$p_interactiveflag', moderatoremail = '$p_moderatoremail', moderatorflag = '$p_moderatorflag', openextflag = '$p_openextflag' WHERE idboard = '$p_idboard'";
  $c_db->query($l_sql);
}
else
{
  $l_sql = "UPDATE $table_board SET title = '$l_title', description = '$p_description', type = '$p_type', moderatoremail = '$p_moderatoremail', idegroup = '$p_idegroup' WHERE idboard = '$p_idboard'";
  $c_db->query($l_sql);
}


show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>
