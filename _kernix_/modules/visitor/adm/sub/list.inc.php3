<?php

if ($p_type == "morethantwo")
{
  $p_minvis = 2;
}
if ($p_type == "morethanten")
{
  $p_minvis = 10;
}

if (isset($p_minvis))
{
  $l_tmp = "";
  if (isset($p_year)) $l_tmp = " AND date_format(firstvis,'%Y') = '$p_year' ";
  $l_sql = "SELECT * FROM $table_visitor WHERE nbrvis >= '$p_minvis' $l_tmp ORDER BY idvisitor DESC";
}
elseif ($p_type == 'vis')
{
  $l_sql = "SELECT * FROM $table_visitor WHERE idvisitor > '0' ORDER BY nbrvis DESC LIMIT 0,20";
}
elseif ($p_option == 'whatsnew')
{
  $l_sql = "SELECT * FROM $table_visitor WHERE idvisitor > '0' AND lastvis >= '$l_lastsession' ORDER BY lastvis DESC LIMIT 200";
}
else
{
  $l_sql = "SELECT * FROM $table_visitor ORDER BY lastvis DESC LIMIT 0,$l_max";
}

$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("pas d'entrée"); 
  print("<br>");
  return 0;
}

?>

<table align="center" width="98%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">id</td>
  <td class="color2" align="center">origine</td>
  <td class="color2" align="center" width="25%">dernière visite</td>
  <td class="color2" width="5%" align="center" width="5%">vis</td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  if (($obj->idclient > 0) && ($obj->purchase_flag == 0))
  {
    $l_class = "warning"; $l_client = "oui";
  }
  elseif ($obj->purchase_flag > 0)
     {
       $l_class = "hotwarning"; 
     }
  print("<tr>");
  print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_visitoraction=view&p_idvisitor=$obj->idvisitor&p_idclient=$obj->idclient\" class=truelink>$obj->idvisitor</a></td>");
  if (!empty($obj->remotehost))
    print("<td class=$l_class align=center>$obj->remotehost</td>");
  else
    print("<td class=$l_class align=center>$obj->remoteaddr</td>");
  print("<td class=$l_class align=center>" . show_datetime($obj->lastvis) . "</td>");
  print("<td class=$l_class align=center>$obj->nbrvis</td>");    
  print("</tr>");
}

?>

</table>
<br><br>

<?php show_hr(); ?>

<form action"<?=$PHP_SELF?>" method="post">
<input type="hidden" name="p_visitoraction" value="list">
 <select name=p_type>
  <option value="morethantwo">-- au moins 2 visites --</option>
  <option value="morethanten">-- au moins 10 visites --</option>
  <option value="vis">-- les plus actifs --</option>
 </select>
 &nbsp; <input type="submit" value="exécuter" class="button"><br>
</form>

