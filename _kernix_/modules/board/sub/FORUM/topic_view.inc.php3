<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'FORUM' ";
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

$l_sql = "SELECT * FROM $table_post WHERE idparent = '$p_idpost' AND validflag = '1' ORDER BY date LIMIT $l_offset, $l_nb";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  print("erreur<br>");
  return 0;
}

?>



<table width="600" align="center" cellspacing="0" cellpadding="1" class="border" border="0">
<tr><td>

<table width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
<td width=30% class=forum4>
auteur
</td>
<td class=forum4>
message
</td>
</tr>

<tr>
<td colspan=2 class=forum3>
 <table border=0 width=100% cellspacing=0 cellpadding=0>
 <tr><td class=forum3> <?php print(" :: <a href=$PHP_SELF?p_za=board&p_idref=$p_idref><b>$board->title</b></a> :: $topic->title<br>"); ?>
     </td>
     <td width=10% align=right class=forum3>
<?php

 if ($board->interactiveflag == 1)
{
  print("<a href=$PHP_SELF?p_za=board&p_boardaction=post_add&p_idref=$p_idref&p_level=1&p_idparent=$p_idpost><img src=/upload/modules/board/reply_post.gif border=0></a>");
}

?>
  </td>
 </tr>
 </table>

</td>
</tr>

<?php
$i = 1 + $p_offset;
while ($obj = $c_db->object_result())
{  
  print("<tr>");
  print("<td class=forum2 rowspan=2 valign=top>");
  print("<b>$obj->nickname</b><br>");
  print("[ <small>post_id $obj->idpost</small> ]<br><br>");
  if (!empty($obj->email))
   print("<a href=mailto:$obj->email><img src=/upload/modules/board/email.gif border=0></a>");
  if (!empty($obj->url))
   print("&nbsp;<a href=$obj->url><img src=/upload/modules/board/homepage.gif border=0></a>");
  print("<br><br>" . show_datetime($obj->date));
  print("</td>");
  print("<td class=forum2 height=20>");
  if ($obj->idtheme)
  {
    print("<img src=/upload/modules/board/" . $tab_theme[$obj->idtheme] . "> &nbsp;");
  }
  print("$i - <b>$obj->title</b></td>");
  print("</tr>");
  print("<tr>");
  print("<td class=forum1 >" . bdd2html($obj->content) . "</td>");
  print("</tr>");
  $i++;
}
$i--;
?>

<tr>
<td colspan=2 class=forum3>
<?php print(" :: <a href=$PHP_SELF?p_za=board&p_idref=$p_idref><b>$board->title</b></a> :: $topic->title<br>"); ?>
</td>
</tr>

<tr>
<td colspan=2 class=forum4 align=right>
<?php

$n = ceil(($topic->nbreply+1)/$board->nbeleminlistreply);

for ($i = 1; $i <= $n; $i++)
{
  $j = $l_nb * ($i-1);
  print("[ <a href=$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idpost=$p_idpost&p_idref=$p_idref&p_offset=$j class=forumlight>$i</a>  ] ");
} 

?>
</td>
</tr>

</table>

</td></tr></table>
