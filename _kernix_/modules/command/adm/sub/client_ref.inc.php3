<?php

$l_sql = "SELECT C.idclient, C.idcommand, C.date FROM $table_session AS S, $table_command AS C WHERE S.productcode = '$p_idcommand' AND S.status = '20' AND C.numsession = S.numsession";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun client");
  include("sub/home.inc.php3");
  return 0;
}

$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_clients[$i][0] = $obj->idclient;
  $tab_clients[$i][1] = $obj->idcommand;
  $tab_clients[$i][2] = $obj->date;
  $i++;
}


?>

<table align=center width=98%>

 <tr>
  <td class=color2 align=center height=20 align=left>
   id
  </td>
  <td class=color2 align=center align=center>
   &nbsp; client
  </td>
  <td class=color2 align=center width=8%>
   cmd
  </td>
  <td class=color2 align=center width=25%>
   date
  </td>
 </tr>

<?php

$i = 0;
while ($l_idclient = $tab_clients[$i][0])
{
  $l_idcommand = $tab_clients[$i][1];
  $l_cdate = $tab_clients[$i][2];
  if (($i++ % 2) == 0) $l_class = "listdark"; else $l_class = "listlight";
  $l_sql = "SELECT * FROM $table_client WHERE idclient = '$l_idclient'";
  $c_db->query($l_sql);
  $obj = $c_db->object_result();
  print("<tr>");
  print("<td class=$l_class align=center>[<a href=$g_urlroot/$g_modulespath/client/adm/index.php3?p_clientaction=view&p_idclient=$l_idclient>$l_idclient</a>]</td>");
  print("<td class=$l_class align=left> &nbsp; $obj->lastname $obj->firstname</td>");
  print("<td class=$l_class align=center><a href=$g_urlroot/$g_modulespath/command/adm/index.php3?p_commandaction=command_view&p_idcommand=$l_idcommand>$l_idcommand</a></td>");
  print("<td class=$l_class align=center>" . show_datetime($l_cdate) . "</td>");
  print("</tr>\n");
}

?>


</table>

<br>
