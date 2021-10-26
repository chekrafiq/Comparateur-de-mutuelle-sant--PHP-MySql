<table width="75%" border="0" cellpadding="0" cellspacing="0" class="contenu"><tr>
<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'NEWS'";
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

// pr les stats
$ref->name = "NEWS :: " . $topic->title;

$l_title   = $topic->title;
$l_content = bdd2html($topic->content);
echo "<td class='contenu' height='40'>&nbsp;<span class='chapeau'>$l_title</span></td>";
echo "<td class='contenu' align=right>&nbsp;</td>";
echo "</tr>";
echo "<tr><td colspan=2 class='contenu' valign='top'>";
if ($topic->url)
{
  echo "<img src='/upload/pictures/" . $topic->url . "' align='left' hspace='10' vspace='2'>";
}
echo $l_content;
echo "</td></tr>";
echo "<tr>";
echo "<td class='contenu' align='right' colspan='2'><br/><a href='$PHP_SELF?p_idref=$p_idref' class='contenu'>&#187; retour aux actualités</a></td></tr>";
echo "</table><br />";


if (($board->interactiveflag == 1) && ($topic->nbreply != 0))
{
  print("<a href=$PHP_SELF?p_idref=$p_idref>retour aux news</a>");
  print(" | <a href=$PHP_SELF?p_za=board&p_boardaction=post_add&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost>poster une réponse</a><br><br>");
}


$l_sql = "SELECT * FROM $table_post WHERE idparent = '$p_idpost' AND validflag = '1' AND level = '1' ORDER BY date";
$c_db->query($l_sql);

$i = 1 + $p_offset;
while ($obj = $c_db->object_result())
{  
  print("<table><tr>");
  print("<td class=forum2 rowspan=2 valign=top>");
  print("<b>$obj->nickname</b><br>");
  print("[ <small>post_id $obj->idpost</small> ]<br><br>");
  if (!empty($obj->email))
   print("<a href=mailto:$obj->email><img src=/pictures/board/email.gif border=0></a>");
  if (!empty($obj->url))
   print("&nbsp;<a href=$obj->url><img src=/pictures/board/homepage.gif border=0></a>");
  print("<br><br>" . show_datetime($obj->date));
  print("</td>");
  print("<td class=forum2 height=20>");
  if ($obj->idtheme)
  {
    print("<img src=/upload/pictures/board/" . $tab_theme[$obj->idtheme] . "> &nbsp;");
  }
  print("$i - <b>$obj->title</b></td>");
  print("</tr>");
  print("<tr>");
  print("<td class=forum1 >" . bdd2html($obj->content) . "</td>");
  print("</tr></table><br>");
  $i++;
}
$i--;

if ($board->interactiveflag == 1)
{
  print(" | <a href=$PHP_SELF?p_za=board&p_boardaction=post_add&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost>poster une réponse</a>");
}

?>
