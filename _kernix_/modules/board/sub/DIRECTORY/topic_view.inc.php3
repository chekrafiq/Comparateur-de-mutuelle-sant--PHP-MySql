<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'DIRECTORY'";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_theme[$obj->idtheme] = $obj->picture;
}

$l_sql = "UPDATE $table_post SET nbview = nbview + 1 WHERE idpost = '$p_idpost'";
$c_db->query($l_sql);

$l_nb = $board->nbeleminlistreply;

if (!isset($p_offset))
{
  $l_offset = 0;
}
else
{
  $l_offset = $p_offset;
}

$l_sql = "SELECT * FROM $table_post WHERE idpost = '$p_idpost'";
$c_db->query($l_sql);
$topic = $c_db->object_result();

print("<a name=top><b>dir : / </b> $topic->title ($topic->nbreply)<br><br>");

print("<a href=$PHP_SELF?p_idref=$p_idref>up</a><br><br>");

$l_sql = "SELECT * FROM $table_post WHERE idparent = '$p_idpost' AND validflag = '1' AND level = '1' ORDER BY date DESC";
$c_db->query($l_sql);

$i = 1 + $p_offset;
while ($obj = $c_db->object_result())
{  
  print("<table width=100% border=1>");
  print("<tr><td class=forum2 valign=top>$i - <b>$obj->title</b></td></tr>");
  if (empty($obj->abstract))
    print("<tr><td class=forum1 height=80>" . bdd2html($obj->content) . "</td></tr>");
  else
  print("<tr><td class=forum1 height=80>" . bdd2html($obj->abstract) . " ... >>view</td></tr>");
  print("<tr><td class=forum2 valign=top>" . show_datetime($obj->date));
  print("[ <small>post_id $obj->idpost</small> ]</td>");
  print("</tr></table><br>");
  $i++;
}
$i--;

print("<a href=#top>au de page</a>");

if ($board->interactiveflag == 1)
{
  print(" | <a href=$PHP_SELF?p_za=board&p_boardaction=post_add&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost>poster un message</a>");
}

?>
