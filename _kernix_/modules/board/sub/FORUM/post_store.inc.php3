<?php

if (($board->identificationlevel >=1) && empty($p_nickname))
{
  print("manque nick");
  return 0;
  if (($board->identificationlevel == 2) && empty($p_email))
  {
    print("manque email");
    return 0;
  }
}

if (empty($p_nickname))
{
  $p_nickname = "anonymous";
}

if (!empty($p_email))
{
  $l_sql = "SELECT email FROM $table_email WHERE idegroup = '$board->idegroup' AND email = '$p_email'";
  $c_db->query($l_sql);
  if (!$c_db->numrows)
  {
    $l_sql = "INSERT INTO $table_email (idegroup,idvisitor,email,creationdate) VALUES ('$board->idegroup','$g_idvisitor','$p_email','$l_date')";
    $c_db->query($l_sql);
    $l_sql = "UPDATE $table_egroup SET nbremail = nbremail + 1 WHERE idegroup = '$board->idegroup'";
    $c_db->query($l_sql);
  }
}

if ($p_level == 1)
{
  if ($p_validflag == 1)
  {
    $l_sql = "UPDATE $table_post SET lastreplydate = '$l_date', nbreply = nbreply + 1 WHERE idboard = '$p_idboard' AND level = '0' AND idparent = '$p_idparent'";
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE $table_post SET lastreplydate = '$l_date' WHERE idboard = '$p_idboard' AND level = '0' AND idparent = '$p_idparent'";
    $c_db->query($l_sql);
  }
  $l_sql = "UPDATE $table_board SET nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idboard = '$p_idboard'";
  $c_db->query($l_sql);
}
else
{
  if ($p_validflag == 1)
  {
    $l_sql = "UPDATE $table_board SET nbtopic = nbtopic + 1, nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE $table_board SET nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
}


//$p_title = txt2bdd($p_title);
//$p_content = txt2bdd($p_content);
//$p_abstract = txt2bdd($p_abstract);

$l_sql = "INSERT INTO $table_post (title,content,idboard,level,validflag,adminflag,nickname,email,url,idparent,idvisitor,idtheme,lastreplydate,date) VALUES ('$p_title','$p_content','$p_idboard','$p_level','$p_validflag','$p_adminflag','$p_nickname','$p_email','$p_url','$p_idparent','$g_idvisitor','$p_idtheme','$l_date','$l_date')";
$c_db->query($l_sql);
$p_idpost = $c_db->get_id();

if ($p_level == 0)
{
  $l_sql = "UPDATE $table_post SET idparent = '$p_idpost' WHERE idpost = '$p_idpost'";
  $c_db->query($l_sql);
  include("$l_incpath/home.inc.php3");
}
else
{
  $p_idpost = $p_idparent;
  include("$l_incpath/topic_view.inc.php3");
}

?>
