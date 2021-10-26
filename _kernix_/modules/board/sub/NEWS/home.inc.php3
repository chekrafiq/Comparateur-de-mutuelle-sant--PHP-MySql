<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'NEWS' ";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_theme[$obj->idtheme][0] = $obj->picture;
  $tab_theme[$obj->idtheme][1] = $obj->name;
}


$l_nb = $board->nbeleminlisttopic;

$l_offset = 0;

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC LIMIT $l_offset, $l_nb";
$c_db->query($l_sql);
//echo $l_sql;

if ($c_db->numrows == 0)
{
  print("pas d'articles<br>");
  return 0;
}

$i = 0;
echo "<table width='80%' border='0' cellpadding='0' cellspacing='5' class='contenu'>";
while ($obj = $c_db->object_result())
{  
  $l_title = $obj->title;
  $l_abstract = bdd2html($obj->abstract);
  $l_link = $obj->link;
  if (!$l_link) $l_link = "$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idref=$p_idref&p_level=1&p_idpost=$obj->idpost&p_idtheme=$obj->idtheme";

  echo "<tr>";
  echo "<td colspan='2' valign='top'><span class='chapeau'>$l_title</span>";
  echo "<br /><br />".$l_abstract."<br />";
  if ($obj->content || $obj->link) echo "<a href='".$l_link."' title=\"Actualité : " . $l_title. "\" class='contenu'><b>&#187; Lire la suite</b></a>";
  echo "<br /><br /></td></tr>";
  $i++;
}
echo "</table>";
?>

<br>

<?php

if ($board->archiveflag == 1)
{
  print("<span class=txt_n_arial_w_b>&nbsp; <a href=$PHP_SELF?p_za=board&p_boardaction=archive&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost class=txt_n_arial_w_b_rored_a>&#187; Voir les archives</a> &nbsp;&nbsp; < $board->nbtopic actualités ></span><br>");
}

if ($board->backendflag == 1)
{
  print("<font class=newshighlight>&#187;</font> <a href=/extern/board__rss__$p_idboard.rss class=news>backend news</a>");
}

?>

<br><br>
