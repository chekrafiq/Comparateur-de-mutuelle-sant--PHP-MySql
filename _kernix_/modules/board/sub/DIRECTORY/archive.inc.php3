<?php

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC";
$c_db->query($l_sql);

$i = 1;
while ($obj = $c_db->object_result())
{  
  $l_title = $obj->title;
  print("$i <a href=$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_title=" . urlencode($obj->title) . "&p_idref=$p_idref>$l_title</a>");
  print(" <i>par $obj->nickname</i>");
  if ($board->interactiveflag == 1)
    print(", $obj->nbreply réponses");
  print(", " . show_datetime($obj->lastreplydate));
  print("<br>");
  $i++;
}

print("<br><br><a href=$PHP_SELF?p_idref=$p_idref>retour aux news</a>");
?>
