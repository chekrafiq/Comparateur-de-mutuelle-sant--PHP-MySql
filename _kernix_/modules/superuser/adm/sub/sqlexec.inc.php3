<?php

show_response("$p_sql<br>");

mysql_connect ($g_server, $g_login, $g_password) or die("[ <b>" . mysql_errno() ." </b>] <i>" . mysql_error() . "</i>");
$result = mysql_db_query ($g_db, $p_sql) or $l_error = "[ <b>" . mysql_errno() ." </b>] <i>" . mysql_error() . "</i>";

if (!empty($l_error))
{
  show_response($l_error);
  show_back();
  return 0;
}

$i = 0;
while ($i < mysql_num_fields ($result)) 
{
  $meta = mysql_fetch_field ($result);
  $tab_columns[$i] = $meta->name;
  $i++;
}

$n = $i;

?>

<table align="center" width="80%">

 <tr>

<?php

$i = 0;
while ($tab_columns[$i])
{
  print("<td class=color2 align=center height=20>" . $tab_columns[$i] . "</td>");
  $i++;
}

?>

 </tr>

<?php

$j = 0;
while ($row = mysql_fetch_array ($result)) 
{
  print("<tr>");
  if (($j++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  $i = 0;
  while ($i < $n)
  {
    print("<td class=$l_class align=center>" . $row[$i]  . "</td>");
    $i++;
  }
  print("</tr>");
}

?>

</table>

<br><br>

<?php

mysql_free_result ($result);

show_back();

?>
