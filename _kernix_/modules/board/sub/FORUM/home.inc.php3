<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'FORUM'";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_theme[$obj->idtheme] = $obj->picture;
}


$l_nb = $board->nbeleminlisttopic;

$l_offset = 0 + $p_offset;

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC LIMIT $l_offset, $l_nb";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
//  print("pas de posts $p_idboard<br>");
//  return 0;
}

?>

<table width="600" align="center" cellspacing="0" cellpadding="1" class="border" border="0">
<tr><td>

<table width="100%" cellspacing="1" cellpadding="4" border="0">
 <tr>
  <td colspan=4 align=center class=forum4>
   sujet
  </td>
  <td class=forum4>
   nickname
  </td>
  <td align=center class=forum4>
   reponses
  </td>
  <td class=forum4 align=right>
   dernier post &nbsp;
  </td>
 </tr>

<tr>
<td colspan=7 class=forum3>
 <table border=0 width=100% cellspacing=0 cellpadding=0>
 <tr><td class=forum3><?php print("<b>BOARD : $board->title</b> - $board->description (<b>$board->nbpost</b> posts) "); ?></td>
     <td width=10% align=right class=forum3>
<?php

if ($board->interactiveflag == 1)
{
  print("<a href=$PHP_SELF?p_za=board&p_boardaction=post_add&p_idref=$p_idref&p_level=0><img src=/upload/modules/board/topic_post.gif border=0></a>");
}

?>
  </td>
 </tr>
 </table>
</td>
</tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{  
  print("<tr>");
  print("<td class=forum2>&nbsp;</td>");
  print("<td class=forum2 width=4% align=center>");
  if ($obj->nbreply == 0)
    print("<img src=/upload/modules/board/replies_no.gif>");
  else
    print("<img src=/upload/modules/board/replies_yes.gif>");
  print("</td>");
  print("<td class=forum2 width=4% valign=middle>");
  if ($obj->idtheme)
  {
    print("<img src=/upload/modules/board/" . $tab_theme[$obj->idtheme] . ">");
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
  print("</tr>");
  $i++;
}

$p_offset += $i;

?>

<tr>
<td colspan=7 class=forum3>
<?php print("<b>BOARD : $board->title</b>"); ?>
</td>
</tr>

<tr>
<td colspan=7 class=forum4 align=right>
<?php

if ($l_offset == 0)
{
    print("< prev");
}
else
{
  print("<a href='javascript:history.back()' class=whitelink>< prev</a>");
}  
$l_nbpages = ceil($board->nbtopic / $l_nb);
print(" [ $l_nbpages ] "); 
if ($p_offset >= $board->nbtopic)
{
  print("next >");
}
else
{
  print("<a href=$PHP_SELF?p_za=board&p_idref=$p_idref&p_offset=$p_offset class=whitelink>next ></a>");
}
?>

</td>
</tr>

</table>

</td></tr></table>
