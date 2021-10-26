<?php

if (isset($p_idref)) $l_ref = " AND idref = '$p_idref'";

if (isset($p_validateflag)) $l_validate = " AND validflag = '0'";

$l_sql = "SELECT * FROM $table_gbpost WHERE idpost >= 1 $l_ref $l_validate ORDER BY idpost DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun post");
  show_back();
  return 0;
}

?>

<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_gbaction" value="post_validate">

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if ($obj->validflag == 0) $l_class = warning; else $l_class = "listlight";
  print("<table width=95% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>");
  print("<tr>\n");
  print("<td class=color1 align=left>");
  print(" [$obj->idpost] $obj->title &nbsp; &nbsp; <font style='font-weight: normal'>by ");
  if (!empty($obj->email))
    print("<a href=mailto:$obj->email class=whitelink>$obj->nickname</a>");
  else
    print($obj->nickname);
  if ($obj->idvisitor > 0)
    print("< <a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idvisitor class=whitelink>$obj->idvisitor</a> >");
  if (!empty($obj->url))
    print(" - <a href=$obj->url target=_blank class=whitelink>site</a> ");
  print(" &nbsp; " .  show_datetime($obj->date) . "</font>");
  print("</td>");
  print("</tr>\n<tr>");
  print("<td class=$l_class height=30> $obj->content</td>");
  print("</tr>\n<tr>");
  print("<td class=list align=right>");
//  print("editer");
  print(" - <input type=checkbox name=p_tabdelete[] value=$obj->idpost>supprimer");
  print(" - <input type=checkbox name=p_tabvalidate[] value=$obj->idpost>valider &nbsp;");
  print("</td>");
  print("</tr>\n");
  print("</table><br>\n\n");
}

?>

<br>

<?php show_hr(); ?>

<br>

 <input type="submit" value="enregistrer" class="button">
</form>
