<?php

$table_visitor = "visitor";
$table_log = "log";


// nb visit
$l_sql = "SELECT idlog FROM $table_log WHERE newvis = 1 AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisit = $c_db->numrows;


// nb visitor
$l_sql = "SELECT idlog FROM $table_log WHERE newvis = 1 AND date_format(date,'%Y') = '$p_year' GROUP BY idvisitor";
$c_db->query($l_sql);
$l_nbvisitor = $c_db->numrows;


// nb page
$l_sql = "SELECT idvisitor FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year' AND cookie = '0'";
$c_db->query($l_sql);
$l_nbvisitornc = $c_db->numrows;

$l_sql = "SELECT idlog FROM $table_log WHERE date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbpage = $c_db->numrows + $l_nbvisitornc;


// % des visitor venu plus d'une fois
$l_sql = "SELECT idsession FROM $table_log WHERE date_format(date,'%Y') = '$p_year' GROUP BY idsession";
$c_db->query($l_sql);
$i=0;
$tab_oftenrate = array();
while ($obj = $c_db->object_result())
{
  $tab_bysession = explode("-", $obj->idsession);
  array_push($tab_oftenrate, $tab_bysession[0]);
  $i++;
}
$tab_oftenrate2 = array_count_values($tab_oftenrate);
$l_nboften = 0;
foreach ($tab_oftenrate2 as $k => $v)
{
  if ($v > 1) { $l_nboften++; }
}
$l_oftenrate = ($l_nboften / $l_nbvisitor) * 100;
$l_oftenrate = sprintf("%.2f ",$l_oftenrate);


// fréquence des visites
$l_sql = "SELECT idsession, date FROM $table_log WHERE date_format(date,'%Y') = '$p_year' GROUP BY idsession ORDER BY idsession DESC";
$c_db->query($l_sql);
$l_last = 0;
$l_daytot = 0;
$l_visitot = 0;
$tab_freq = array();
while ($obj = $c_db->object_result())
{
  $tab_bysession = explode("-", $obj->idsession);
  if ($tab_bysession[0] == $l_last)
  {
    $l_daytot += jour_diff($l_lastdate, $obj->date);
    $l_visittot++;
  }
  else
  {
    $l_last = $tab_bysession[0];
    $l_lastdate = $obj->date;
  }
}
$l_freq = $l_daytot / $l_visittot;
$l_freq = sprintf("%.1f ",$l_freq);


// % de nouveaux visiteurs venus par un autre site
$l_sql = "SELECT idvisitor FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year' AND cookie = '1' AND remotereferer != ''";
$c_db->query($l_sql);
if ($l_nbvisitor != 0)
{
  $l_refrate = ($c_db->numrows / $l_nbvisitor) * 100;
}
else
{
  $l_refrate = 0;
}


// % de nouveaux visiteurs venus à la suite d'un mailing
$l_sql = "SELECT idvisitor FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year' AND cookie = '1' AND urlfromfirstvis = '::MAIL::'";
$c_db->query($l_sql);
if ($l_nbvisitor != 0)
{
  $l_frommailrate = ($c_db->numrows / $l_nbvisitor) * 100;
}
else
{
  $l_frommailrate = 0;
}


?>

<table width=100%>
<tr>
<td class=main width=75% valign=top>

<table width=98% align=left border=0>
 <tr>
  <td align=left class=color1 colspan=2>
   :: année <?php print("$p_year"); ?>
  </td> 
 </tr>
 <tr>
  <td class=color2 width=85% align=right>nombre de visites
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbvisit); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visiteurs
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbvisitor); ?>
  </td>
 </tr>
  <tr>
  <td class=color2 align=right>nombre de pages vues
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbpage); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visiteurs étant venus plus d une fois
  </td>
  <td class=color3 align=left>&nbsp;<?php print("<a href=$urlroot/_kernix_/modules/visitor/adm/index.php3?p_visitoraction=list&p_minvis=2 class=truelink>$l_oftenrate %</a>"); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>fréquence des venues (jours)
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_freq); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>pourcentage de nouveaux visiteurs venus par un autre site
  </td>
  <td class=color3 align=left>&nbsp;<?php printf("%.2f",$l_refrate);print(" %"); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>pourcentage de nouveaux visiteurs venant d'un mail
  </td>
  <td class=color3 align=left>&nbsp;<?php printf("%.2f",$l_frommailrate);print(" %"); ?>
  </td>
 </tr>
  
<?php 

if ($p_year == $l_thisyear): 

// nb visitor
$l_sql = "SELECT idlog FROM $table_log WHERE newvis = 1 AND date_format(date,'%m') = date_format('$l_date','%m')  AND date_format(date,'%Y') = '$p_year' GROUP BY idvisitor";
$c_db->query($l_sql);
$l_nbvisitorthismonth = $c_db->numrows;


// nb visit ce mois
$l_sql = "SELECT idlog FROM $table_log WHERE newvis = 1 AND date_format(date,'%m') = date_format('$l_date','%m') AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisthismonth = $c_db->numrows;

?>
 <tr>
   <td align=left colspan=2><br>
   </td> 
 </tr>
 <tr>
   <td align=left class=color1 colspan=2> :: ce mois
   </td> 
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visites
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_nbvisthismonth"); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visiteurs
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_nbvisitorthismonth"); ?>
  </td>
 </tr>
<?php endif; ?> 
</table>



</td>


<td class=main valign=top align=right>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=right width=100%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center class=color3><?php print(".:: année $p_year ::."); ?></td>
 </tr>
 <tr>
  <td class=list align=center>
  <table width=100% cellspacing=1 cellpadding=1 align=center border=0>
<?php

$l_sql = "SELECT DISTINCT date_format(date,'%m') AS nummonth, date_format(date,'%b') AS namemonth FROM $table_log WHERE date_format(date,'%Y') = '$p_year' AND newvis = 1 ORDER by nummonth DESC";
//print($l_sql);
$c_db->query($l_sql);
$n = $c_db->numrows;

//print("");
for ($i=0;$i<$n;$i++)
{
  $l_namemonth = $c_db->result($i,"namemonth");
  $l_nummonth = $c_db->result($i,"nummonth");   
//  print("&nbsp;<img src=/pictures/adm/blacksquare.gif>&nbsp;<a href=$PHP_SELF?p_trafficaction=viewmonth&p_nummonth=$l_nummonth&p_year=$p_year title=\"$l_namemonth $p_year\" >$l_namemonth $p_year</a><br>");
  print("<tr><td align=center class=list> - <a href=$PHP_SELF?p_trafficaction=viewmonth&p_nummonth=$l_nummonth&p_year=$p_year title=\"$l_namemonth $p_year\" >$l_namemonth $p_year</a> - </td></tr>");
}

?>
   </table>
  </td>
 </tr>
 <tr><td align=center class=color3>.:: résolutions ::.</td></tr>
 <tr>
 <td class=list align=left>
  <table width=100% cellspacing=1 cellpadding=1>
<?php

$l_sql = "SELECT count(*) as n, screen FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year' AND cookie = '1' AND screen != '' GROUP BY screen ORDER BY n DESC LIMIT 0,5";
$c_db->query($l_sql);
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
  $l_n       = $c_db->result($i,"n");
  $l_percent = ($l_n / $l_nbvisitor) * 100;
  $l_screen  = $c_db->result($i,"screen");
//     if ($l_screen AND ($l_n > 1))
//     print("&nbsp;&nbsp;<img src=/pictures/adm/blacksquare.gif>&nbsp;&nbsp;<small>[$l_n] $l_screen</small><br>");
  print("<tr><td align=right class=list width=48%>$l_screen</td><td class=list> &nbsp;" . sprintf("%.2f ",$l_percent) . "%</td></tr>");
}

?> 
  </table>
 </td>
 </tr>

 <tr><td align=center class=color3>.:: browsers ::.</td></tr>
 
 <tr>
  <td class=list align=left>
<?php

if ($l_nbvisitor)
{

$l_sql = "SELECT count(*) as n  FROM $table_visitor WHERE INSTR(system,'MSIE 6')  AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
$c_db->query($l_sql);
if ($c_db->numrows != 0)
$l_MSIE6 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
else
$l_MSIE6 = 0;

$l_sql = "SELECT count(*) as n  FROM $table_visitor WHERE INSTR(system,'MSIE 5')  AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
$c_db->query($l_sql);
if ($c_db->numrows != 0)
$l_MSIE5 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
else
$l_MSIE5 = 0;


$l_sql = "SELECT count(*) as n  FROM $table_visitor WHERE INSTR(system,'MSIE 4') AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
$c_db->query($l_sql);
if ($c_db->numrows != 0)
$l_MSIE4 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
else
$l_MSIE4 = 0;


$l_sql = "SELECT count(*) as n  FROM $table_visitor WHERE INSTR(system,'Mozilla/4') AND !INSTR(system,'MSIE') AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
$c_db->query($l_sql);
if ($c_db->numrows != 0)
$l_Moz4 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
else
$l_Moz4 = 0;

$l_sql = "SELECT count(*) as n  FROM $table_visitor WHERE (INSTR(system,'Netscape6') OR INSTR(system,'Gecko')) AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
if ($c_db->numrows != 0)
$l_Nets6 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
else
$l_Nets6 = 0;

$l_other = 100 - $l_MSIE6 - $l_MSIE5 - $l_MSIE4 - $l_Moz4 - $l_Nets6;
}
?> 

   <table width=100% cellspacing=2 cellpadding=0>
    <tr><td align=right class=list width=48%>IE6</td><td class=list> &nbsp;<?php printf("%.2f ",$l_MSIE6);print("%"); ?></td></tr>
    <tr><td align=right class=list width=48%>IE5</td><td class=list> &nbsp;<?php printf("%.2f ",$l_MSIE5);print("%"); ?></td></tr>
    <tr><td align=right class=list>IE4</td><td class=list> &nbsp;<?php printf("%.2f ",$l_MSIE4);print("%"); ?></td></tr>
    <tr><td align=right class=list>Nets4</td><td class=list> &nbsp;<?php printf("%.2f ",$l_Moz4);print("%"); ?></td></tr>
    <tr><td align=right class=list>Nets6</td><td class=list> &nbsp;<?php printf("%.2f ",$l_Nets6);print("%"); ?></td></tr>
    <tr><td align=right class=list>Autres</td><td class=list> &nbsp;<?php printf("%.2f ",$l_other);print("%"); ?></td></tr>
   </table>
   
  </td>
 </tr>
 <tr><td align=center class=color3>.:: OS ::.</td></tr>
 
 <tr>
  <td class=list align=left>
<?php

if ($l_nbvisitor)
{
  $l_sql = "SELECT count(idvisitor) as n  FROM $table_visitor WHERE os = 'MAC' AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0)
  $l_MAC = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else
  $l_MAC = 0;
  
  
  $l_sql = "SELECT count(idvisitor) as n  FROM $table_visitor WHERE os = 'UNIX' AND date_format(firstvis,'%Y') = '$p_year' AND cookie = '1'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0)
  $l_UNIX = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else
  $l_UNIX = 0;
  
  $l_WIN = 100 - $l_MAC - $l_UNIX;

}
?> 

   <table width=100% cellspacing=1 cellpadding=1 align=center border=0>
    <tr><td align=right class=list width=48%>WIN</td><td class=list> &nbsp;<?php printf("%.2f ",$l_WIN);print("%<br>"); ?></td></tr>
    <tr><td align=right class=list>MAC</td><td class=list> &nbsp;<?php printf("%.2f ",$l_MAC);print("%<br>"); ?></td></tr>
    <tr><td align=right class=list>UNIX</td><td class=list> &nbsp;<?php printf("%.2f ",$l_UNIX);print("%"); ?></td></tr>
   </table>
   
  </td>
 </tr>
 <tr>
  <td align=center class=list>
<?php 
print("- <a href=$PHP_SELF?p_trafficaction=listcountry&p_year=$p_year>origine</a> -<br>"); 
print("- <a href=$PHP_SELF?p_trafficaction=listtopreferer&p_year=$p_year>top referer</a> -"); 
?>
  </td>
 </tr>

</table>

</td></tr></table>

</td>
</tr>
</table>

<br>

<?php 
include("$g_modulespath/traffic/adm/sub/graph.inc.php3"); 
?>

<br>
