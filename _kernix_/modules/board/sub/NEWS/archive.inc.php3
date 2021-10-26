<?php

if (!isset($p_idtheme))
{
  $l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC";
}
else
{
  $l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' AND idtheme = '$p_idtheme' ORDER BY date DESC";
}
$c_db->query($l_sql);

$i = 1;
while ($obj = $c_db->object_result())
{
?>

<table width="95%" border="0" cellpadding="1" cellspacing="0" class="bkg_white"><tr><td><table width="100%" border="0" cellpadding="1" cellspacing="0">

<?php
  $l_title = $obj->title;
  print("<tr>");
  print("<td class=bkg_grisclair valign=top><a href=$PHP_SELF?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_title=" . urlencode($obj->title) . "&p_idref=$p_idref class=txt_n_arial_red_b_11>$l_title</a></td>");
  if ($board->interactiveflag == 1)
    print(", $obj->nbreply réponses");
  print("</td><td class=bkg_grisclair valign=top align=right><span class=txt_n_arial_grisfonce>" . show_date($obj->lastreplydate) . "&nbsp;</span></td>");
  print("</tr>\n");
  $i++;
?>

</table></td></tr></table><br>

<?php
}
?>

<?php
print("<br>&nbsp; <a href=$PHP_SELF?p_idref=$p_idref class=txt_n_arial_w_b_rored_a>&#187; Retour aux actualités</a>");
?>
