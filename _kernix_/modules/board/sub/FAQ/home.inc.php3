<?php

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  print("pas de posts $p_idboard<br>");
  return 0;
}

$i = 0;
while ($obj = $c_db->object_result())
{  
  print("<table border=1><tr>");
  print("<td class=forum2 width=4% valign=middle>");
  if ($obj->idtheme)
  {
    print("<img src=/upload/pictures/board/" . $tab_theme[$obj->idtheme] . ">");
  }
  else
  {
    print("&nbsp;");
  }
  print("</td>");
  $l_title = $obj->title;
  print("<td class=forum1><a href=$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_title=" . urlencode($obj->title) . "&p_idref=$p_idref>$l_title</a></td>");
  print("<td class=forum2>$obj->nickname</td>");
  print("<td align=center class=forum2>$obj->nbreply</td>");
  print("<td class=forum2 align=right>" . show_datetime($obj->lastreplydate) . " &nbsp;</td>");
  print("</tr></table><br>");
  $i++;
}

?>

<br><br>

<?php

if ($board->archiveflag == 1)
{
  print("<a href=$PHP_SELF?p_za=board&p_boardaction=archive&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost>archive</a> ($board->nbtopic news)<br>");
}

if ($board->backendflag == 1)
{
  print("<a href=/extern/board__rss__$p_idboard.rss>backend FAQ</a>");
}

?>
