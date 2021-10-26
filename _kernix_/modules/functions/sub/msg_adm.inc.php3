<?php

function get_kwomsg($code)
{
  global $c_db, $table_kwomsg;
  
  $l_sql = "SELECT message FROM $table_kwomsg WHERE code = '$code'";
  $c_db->query($l_sql);
  $obj = $c_db->object_result();
  return $obj->message;
}

function show_kwomsg($code, $url)
{
  print("<br>");
  show_hr();
  print("<br>");
  print("<table width=50% border=1>");
  print("<tr><td class=kwomsg align=center valign=center height=40><br>");
  print(get_kwomsg($code));
  if ($url)
  {
    print("<br><br><a href=$url target=_top> >> cliquez ici << </a><br><br>");
  }
  print("</td>");
  print("</table><br>");
  show_hr();
  print("<br>");
  return(1);
}
?>
