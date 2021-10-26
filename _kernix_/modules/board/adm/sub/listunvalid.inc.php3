<?php

if (isset($p_boardflag))
{
  $l_sql = "SELECT * FROM $table_post WHERE idpost = '$p_idpost'";
  $c_db->query($l_sql);
  $post = $c_db->object_result();
}

if ($p_boardflag == "edit")
{
  include("sub/topicview.inc.php3");
  return 1;
}

if ($p_boardflag == "validate")
{
  $l_sql = "UPDATE $table_post SET validflag = '1' WHERE idpost = '$p_idpost'";
  $c_db->query($l_sql);
  if ($post->level == 1)
  {
    $l_sql = "UPDATE $table_board SET nbtopic = nbtopic + 1 WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
  else
  {
    $l_sql = "UPDATE $table_post SET nbreply = nbreply + 1 WHERE idparent = '$post->idparent' AND level = '0'";
    $c_db->query($l_sql);
  }
}

if ($p_boardflag == "deleteone")
{
  $l_sql = "DELETE FROM $table_post WHERE idpost = '$p_idpost'";
  $c_db->query($l_sql);
}

if ($p_boardflag == "deleteall")
{
  $l_sql = "DELETE FROM $table_post WHERE idparent = '$p_idparent'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_board SET nbtopic = nbtopic - 1 WHERE idboard = '$p_idboard'";
  $c_db->query($l_sql);
}

$l_sql = "SELECT * FROM $table_post WHERE validflag = '0' AND idboard = '$p_idboard'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun post à valider");
  include("sub/view.inc.php3");
  return 0;
}

?>




<?php
$i = 0;
while ($obj = $c_db->object_result())
{
  print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=60% align=center><tr><td>");
  print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
  print("<tr>");
  print("<td class=color3 align=left colspan=3>");
  print(" - <b>$obj->title</b> - <small>" . show_datetime($obj->date) . "</small>");
  print("</td></tr><tr><td class=list align=left colspan=3>");
  print("<br>" . bdd2html($obj->content) . "<br><br>");
  print("</td>");
  print("</tr><tr>");
  print("<td class=list align=center width=33%><a href=$PHP_SELF?p_boardaction=listunvalid&p_idpost=$obj->idpost&p_boardflag=validate&p_idboard=$p_idboard>valider</a></td>");
  if ($obj->level == 1)
  {
    print("<td class=list align=center width=34%><a href=$PHP_SELF?p_boardaction=listunvalid&p_idpost=$obj->idpost&p_boardflag=deleteone&p_idboard=$p_idboard>effacer</a></td>");
  }
  else
  {
    print("<td class=list align=center width=34%><a href=$PHP_SELF?p_boardaction=listunvalid&p_idparent=$obj->idparent&p_boardflag=deleteall&p_idboard=$p_idboard>effacer post + reply</a></td>");
  }
  print("<td class=list align=center width=33%><a href=$PHP_SELF?p_boardaction=listunvalid&p_idpost=$obj->idpost&p_boardflag=edit&p_idboard=$p_idboard>editer</a></td>");
  print("</tr>");
  print("</table>");
  print("</td></tr></table><br>");
}
?>

<br>

<?php show_back_url("$PHP_SELF?p_boardaction=view&p_idboard=$p_idboard"); ?>
