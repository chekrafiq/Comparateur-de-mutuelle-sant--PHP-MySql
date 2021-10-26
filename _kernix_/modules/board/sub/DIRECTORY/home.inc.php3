<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'DIRECTORY' ";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_theme[$obj->idtheme] = $obj->picture;
}


$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  print("pas de posts<br>");
  return 0;
}

?>

<table width=100% border=1 align=center>

<?php

$l_nbcol = 3;
$l_width = floor(100/$l_nbcol);
$ok = 1;

while ($ok == 1)
{
  print("<tr>");
  for ($i=1;$i<=$l_nbcol;$i++)
  {
    if ($obj = $c_db->object_result())
    {
      print("<td width=" . $l_width . "% class=main>");
      $l_title = $obj->title;
      print("<img src=/upload/pictures/board/replies_no.gif> <a href=$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_title=" . urlencode($obj->title) . "&p_idref=$p_idref>$l_title</a> /<br>&nbsp;<i>$obj->nbreply entrées</i><br><br>");
      print("</td>");
    }
    else
    {
      print("<td>&nbsp;</td>");
      $ok = 0;
    }
  }
  print("</tr>\n");
}

?>

</table>



