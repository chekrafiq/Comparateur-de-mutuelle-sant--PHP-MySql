<?php

if (($p_level != 0) && ($p_boardflag == "create"))
{
  $l_sql = "UPDATE $table_post SET lastreplydate = '$l_date', nbreply = nbreply + 1 WHERE idboard = '$p_idboard' AND level = '0' AND idparent = '$p_idparent'";
  $c_db->query($l_sql);
}

if ($p_boardflag == "create")
{
  if ($p_level == 0)
  {
    $l_sql = "UPDATE $table_board SET nbtopic = nbtopic + 1, nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE $table_board SET nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
  $l_sql = "INSERT INTO $table_boardpost (idparent,lastreplydate,date) VALUES ('$p_idparent','$l_date','$l_date')";
  $c_db->query($l_sql);
  $p_idpost = $c_db->get_id();
}

if ($p_level == 0)
{
  $p_idparent = $p_idpost;
}

//$p_title = txt2bdd($p_title);
//$p_content = txt2bdd($p_content);
//$p_abstract = txt2bdd($p_abstract);

$l_sql = "UPDATE $table_boardpost SET title = '$p_title', content = '$p_content', abstract = '$p_abstract', link = '$p_link', idboard = '$p_idboard', level = '$p_level', validflag = '$p_validflag', adminflag = '$p_adminflag', nickname = '$p_nickname', email = '$p_email', url = '$p_url', idparent = '$p_idparent', idtheme = '$p_idtheme' WHERE idpost = '$p_idpost'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/topiclist.inc.php3");

?>


