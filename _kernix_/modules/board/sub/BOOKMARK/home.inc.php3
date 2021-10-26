<?php

if ($board->openextflag == 1)
{
  $l_target = "target=ext";
}

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND validflag = '1' AND level = '0' ORDER BY date";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  print("pas de posts $p_idboard<br>");
  return 0;
}

print("<a name=top></a><ul>\n");
$i = 1;
while ($obj = $c_db->object_result())
{  
  print("<li>");
  $l_title = $obj->title;
  print("<a href=#PART$i>$l_title</a>");
  print("</li>");
  $i++;
}
print("</ul><br><hr>\n");

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND validflag = '1' ORDER BY idparent, level, date";
$c_db->query($l_sql);

print("<ul>\n");
$i = 0;
while ($obj = $c_db->object_result())
{
  $l_title = $obj->title;
  if ($obj->level == 0) 
  {
    $i++;
    if ($i != 1) print("</ul>");
    print("<br><a name=#PART$i></a><li>$l_title <a href=#TOP>top</a></li><br><br><ul>");
  }
  else
  {
    print("<li><a href=$obj->link title=\"$obj->content\" $l_target>$l_title</a></li>");
  }
}

print("</ul></ul>\n");

?>
