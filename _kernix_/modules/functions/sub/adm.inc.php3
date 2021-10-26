<?php

function keywords2bdd($str)
{
  $str = veaccents($str);
  $str = ereg_replace(",",", ",$str);
  $str = ereg_replace("[[:space:]]+"," ",$str);
  $str = strtolower(trim($str));
  return $str;
}

function break_page()
{
  print("<p class=break></p>\n");
}

function ext_show_back($n1, $v1, $n2, $v2)
{
  show_hr();
  $l_backlabel = "-=   r e t o u r   =-";
  print("<form action=$PHP_SELF>");
  print("<input type=hidden name=$n1 value=$v1>");
  print("<input type=hidden name=$n2 value=$v2>");
  print("<input type=submit name=retour value=\"$l_backlabel\" class=button></form>");
}

function show_back()
{
  show_hr();
  $l_backlabel = "-  r e t o u r  -";
  print("<form><input type=\"button\" name=\"retour\" Onclick=\"history.back()\" value=\"$l_backlabel\" class=\"button\"></form>");
}

function show_back_url($str)
{
  show_hr();
  $l_backlabel = "&#171;  r e t o u r  &#187;";
  print("\n<form action=$str method=post>");
  print("<input type=submit value=\"$l_backlabel\" class=button>");
  print("</form>\n");
}

function show_hr()
{
  print("<img src=/pictures/adm/blue_line.gif><br>");
}

function show_response($response)
{
  print("<table width=50% border=1>");
  print("<tr><td class=responsegood align=center valign=center height=40>$response</td>");
  print("</table><br>");
  show_hr();
  print("<br>");
  return(1);
}

function show_note($txt)
{
  print("<table border=0 cellspacing=0 cellpadding=6>");
  print("<tr><td class=color3 align=center valign=center height=40>$txt</td>");
  print("</table><br>");
  return(1);
}

function aff_incelllink($l_name, $l_link, $l_value)
{
  global $g_target;
  
  if ($l_value > 0)
  {
//    print("<input type=\"button\" name=boutton value=\"$l_name\" OnClick=\"document.window2.location.href='$l_link';\" class=button $g_target>");
    print("<a href=$l_link $g_kwotarget class=truelink>$l_name</a>");
//    print("<form method=get action=$l_link $g_target>");
//    print("<input type=submit value=\"$l_name\" class=button>");
//    print("</form>");
  }
  else
  {
    print("&nbsp;");
  }
}


function show_header()
{
  print("<br>");
  $headers = getallheaders();
  while (list($header, $value) = each($headers)) 
  {
    echo "$header: $value<br>\n";
  }
}

function get_tabpath_admin($key)
{
  global $c_db, $table_ref, $g_urldyn;
  
  $n = strlen($key) / 2;
  $i = 0;
//  $i = 1;
  while ($i < $n)
  {
    $len = ($i+1) * 2;
    $tab[$i] = "nodekey = '" . substr($key,0,$len)  . "'";
    $i++;
  }
  $l_sql = " " . implode(" OR ",$tab)  . " ";
  $l_sql = "SELECT idref, up, name, description, icon, nbsubref, link FROM $table_ref WHERE " . $l_sql;
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]       = $obj->idref;
    $l_tab[$i]["url"]         = "$g_urldyn?p_idref=" . $obj->idref;
    $l_tab[$i]["name"]        = stripslashes($obj->name);
    $l_tab[$i]["description"] = bdd2html($obj->description);
    $l_tab[$i]["icon"]        = $obj->icon;
    $l_tab[$i]["nbsubref"]    = $obj->nbsubref;
    $i++;
  }
  return $l_tab;
}

?>
