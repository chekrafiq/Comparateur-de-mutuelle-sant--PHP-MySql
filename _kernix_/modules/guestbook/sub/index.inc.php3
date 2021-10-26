<?php

$table_gb      = "gb";
$table_gbpost  = "gbpost";

if (!isset($p_gbaction))
{
  print("&#187; <a href=$g_urldyn?p_idref=$p_idref&p_gbaction=list>voir les commentaires des internautes</a> &#171;");
  return 1;
}


if ($p_gbaction == "post")
{
  $ref->name = "::GB:: post";
  include("$g_modulespath/guestbook/sub/post.inc.php3");
  return 0;
}

$l_sql = "SELECT * FROM $table_gb";
$c_db->query($l_sql);
$gb = $c_db->object_result();

if ($p_gbaction == "store")
{
  $ref->name = "::GB:: store - $p_title";
  if (empty($p_nickname) || empty($p_title) || empty($p_content))
  {
    print("manque info");
    return 0;
  }
  $p_title = post2bdd($p_title);
  $p_content = post2bdd($p_content);
  $l_mod = ($gb->moderatorflag + 1) % 2;
  $l_sql = "INSERT INTO $table_gbpost (idref,idvisitor,nickname,email,url,title,content,validflag,date) VALUES ('$p_idref','$g_idvisitor','$p_nickname','$p_email','$p_url','$p_title','$p_content','$l_mod','$l_date')";
  $c_db->query($l_sql);
  if (!is_valid_email($p_email))
  {
    if (($gb->notificationflag == 1) && ($g_sendflag == 1))
    {
      mail($gb->email,"$g_sitename - gb", "title:\n$p_title\n\ncontent:\n$p_content", "From: boutique $g_sitename\n Errors-to: $adm->email\n");
    }
    $l_sql = "UPDATE $table_egroup SET lastregisterdate = '$l_date' WHERE idegroup = '$g_idegroup'";
    $c_db->query($l_sql);
    $l_sql = "REPLACE INTO $table_email (idegroup,emailkey,email,idvisitor,date) VALUES ('$g_idegroup','1-$p_email','$p_email','$g_idvisitor','$l_date')";
    $c_db->query($l_sql);
    $l_sql = "UPDATE $table_visitor SET email = '$p_email' WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);
  } 
  $p_gbaction = "list";
}

if ($p_gbaction == "list")
{
  $ref->name = "::GB:: list";
  print("<a href=$g_urldyn?p_idref=$p_idref><b>cacher</b> les avis</a> - ");
  print("<a href=$g_urldyn?p_idref=$p_idref&p_gbaction=post><b>poster</b> mon avis</a><br><br><br>");
  $l_sql = "SELECT * FROM $table_gbpost WHERE idref = $p_idref AND validflag = '1' ORDER BY idpost DESC";
  $c_db->query($l_sql);
  while ($obj = $c_db->object_result())
  {
    print("<table width=400 border=0>");
    print("<tr><td class=main><b>$obj->title</b> &nbsp; &nbsp;" . show_datetime($obj->date) . "</td></tr>");
    print("<tr><td class=main>[$obj->idpost] <font style='color: black;'>by <i>$obj->nickname</i> ");
    if (!empty($obj->email)) print(" - <a href=mailto:$obj->email target=_blank>email</a>");
    if (!empty($obj->url)) print(" - <a href=$obj->url target=_blank>url</a>");
    print("</font></td></tr>");
    print("<tr><td class=main><font style='color: #999999; font-family: arial; font-size: 12px'>$obj->content</td></tr>");
    print("</table><br>\n");
  }
  return 1;
}
?>


