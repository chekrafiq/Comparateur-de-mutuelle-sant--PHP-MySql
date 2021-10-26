<?php

// nb visit
$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = '1' AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisit = $c_db->result(0,0);

// nb visitor
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisitor = $c_db->result(0,0);

// nb page
$l_sql = "SELECT count(idlog) FROM $table_log WHERE date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbpage = $c_db->result(0,0);

// % des visitor venu plus d'une fois
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE nbrvis > 1 AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nboften = $c_db->result(0,0);

$l_oftenrate = 0;
if ($l_nbvisitor)
{
  $l_oftenrate = ($l_nboften / $l_nbvisitor) * 100;
  $l_oftenrate = sprintf("%.1f ",$l_oftenrate);
}

// fréquence des visites
$l_sql = "SELECT SUM(TO_DAYS(lastvis) - TO_DAYS(prevvis)) FROM $table_visitor WHERE lastvis != prevvis AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
if ($c_db->numrows && $l_nboften) $l_freq = $c_db->result(0,0) / $l_nboften;
else $l_freq = 0;
$l_freq = sprintf("%.1f ",$l_freq);

// % de nouveaux visiteurs venus par un autre site
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE remotereferer != '' AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
if ($l_nbvisitor) $l_refrate = ($c_db->result(0,0) / $l_nbvisitor) * 100;
else $l_refrate = 0;


// % de nouveaux visiteurs venus à la suite d'un mailing
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE (urlfromfirstvis = '::MAIL::' OR urlfromlastvis = '::MAIL::') AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
if ($l_nbvisitor) $l_frommailrate = ($c_db->result(0,0) / $l_nbvisitor) * 100;
else $l_frommailrate = 0;

?>

<table width="100%">
<tr><td class="main" width="75%" valign="top">

<table width="100%" align="left" border="0">
 <tr>
  <td align="left" class="color1" colspan="2">
   :: année <?=$p_year?>
  </td> 
 </tr>
 <tr>
  <td class="color2" width="85%" align="right">nombre de visites</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisit?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisitor?></td>
 </tr>
  <tr>
  <td class="color2" align="right">nombre de pages vues</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbpage?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs étant venus plus d&#39;une fois</td>
  <td class="color3" align="left">&nbsp;<?php print("<a href=$urlroot/_kernix_/modules/visitor/adm/index.php3?p_visitoraction=list&p_minvis=2&p_year=$p_year class=truelink>$l_oftenrate %</a>"); ?>
  </td>
 </tr>
 <tr>
  <td class="color2" align="right">fréquence moyenne des venues (jours) pour les habitués</td>
  <td class="color3" align="left">&nbsp;<?=$l_freq?></td>
 </tr>
 <tr>
  <td class="color2" align="right">pourcentage de nouveaux visiteurs venus par un autre site</td>
  <td class="color3" align="left">&nbsp;<?php printf("%.1f",$l_refrate); ?> %</td>
 </tr>
 <tr>
  <td class="color2" align="right">pourcentage de nouveaux visiteurs venant d&#39;un mail</td>
  <td class="color3" align="left">&nbsp;<?php printf("%.1f",$l_frommailrate); ?> %</td>
 </tr>
  
<?php 

if ($p_year == $l_thisyear): 

// nb visit ce mois
$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = 1 AND date_format(date,'%m') = date_format('$l_date','%m') AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisthismonth = $c_db->result(0,0);

// nb visitor
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE date_format(firstvis,'%m') = date_format('$l_date','%m')  AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisitorthismonth = $c_db->result(0,0);

?>

 <tr>
  <td align="left" colspan="2"><br></td> 
 </tr>
 <tr>
  <td align="left" class="color1" colspan="2">:: ce mois</td> 
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visites</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisthismonth?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisitorthismonth?></td>
 </tr>

<?php endif; ?> 

</table>



</td>


<td class="main" valign="top" align="right">

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="right" width="100%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>
  <td align="center" class="color3">.:: année <?=$p_year?> ::.</td>
 </tr>
 <tr>
  <td class="list" align="center">
  <table width="100%" cellspacing="1" cellpadding="1" align="center" border="0">

<?php

$l_sql = "SELECT DISTINCT date_format(date,'%m') AS nummonth, date_format(date,'%b') AS namemonth FROM $table_log WHERE date_format(date,'%Y') = '$p_year' AND newvis = 1 ORDER by nummonth DESC";
$c_db->query($l_sql);
$n = $c_db->numrows;

for ($i=0;$i<$n;$i++)
{
  $l_namemonth = $c_db->result($i,"namemonth");
  $l_nummonth = $c_db->result($i,"nummonth");   
  print("<tr><td align=center class=list> - <a href=$PHP_SELF?p_trafficaction=viewmonth&p_nummonth=$l_nummonth&p_year=$p_year title=\"$l_namemonth $p_year\" >$l_namemonth $p_year</a> - </td></tr>");
}

?>
   </table>
  </td>
 </tr>
 <tr><td align="center" class="color3">.:: résolutions ::.</td></tr>
 <tr>
 <td class="list" align="left">
  <table width="100%" cellspacing="1" cellpadding="1">
<?php

$l_sql = "SELECT count(*) as n, screen FROM $table_visitor WHERE date_format(firstvis,'%Y') = '$p_year' AND screen != '' GROUP BY screen ORDER BY n DESC LIMIT 0,5";
$c_db->query($l_sql);
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
  $l_n       = $c_db->result($i,"n");
  $l_percent = 0;
  if ($l_nbvisitor)
  {
    $l_percent = ($l_n / $l_nbvisitor) * 100;
  }
  $l_screen  = $c_db->result($i,"screen");
  print("<tr><td align=right class=list width=48%>$l_screen</td><td class=list> &nbsp;" . sprintf("%.2f ",$l_percent) . "%</td></tr>");
}

?> 
  </table>
 </td>
 </tr>

 <tr><td align="center" class="color3">.:: navigateurs ::.</td></tr>
 
 <tr>
  <td class="list" align="left">
<?php

if ($l_nbvisitor)
{
  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'IE60' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_IE60 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_IE60 = 0;
  
  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'IE55' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_IE55 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_IE55 = 0;

  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'IE50' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_IE50 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_IE50 = 0;

  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'IE40' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_IE40 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_IE40 = 0;
  
  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'NS60' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_NS60 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_Moz4 = 0;
  
  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'NS4+' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_NS4p = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_NS4p = 0;

  $l_sql = "SELECT count(idvisitor) as n FROM $table_visitor WHERE browser = 'NS40' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_NS40 = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_NS40 = 0;
 
  $l_other = 100 - $l_IE60 - $l_IE55 - $l_IE50 - $l_IE40 - $l_NS60 - $l_NS4p - $l_NS40;
}
?> 

   <table width="100%" cellspacing="2" cellpadding="0">
    <tr><td align="right" class="list" width="48%">IE6</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_IE60); ?> %</td></tr>
    <tr><td align="right" class="list">IE5.5</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_IE55); ?> %</td></tr>
    <tr><td align="right" class="list">IE5</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_IE50); ?> %</td></tr>
    <tr><td align="right" class="list">IE4</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_MSIE40); ?> %</td></tr>
    <tr><td align="right" class="list">Nets6</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_NS60); ?> %</td></tr>
    <tr><td align="right" class="list">Nets4+</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_NS4p); ?> %</td></tr>
    <tr><td align="right" class="list">Nets4</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_NS40); ?> %</td></tr>
    <tr><td align="right" class="list">Autres</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_other); ?> %</td></tr>
   </table>
   
  </td>
 </tr>
 <tr><td align="center" class="color3">.:: OS ::.</td></tr>
 
 <tr>
  <td class="list" align="left">
<?php

if ($l_nbvisitor)
{
  $l_sql = "SELECT count(idvisitor) as n  FROM $table_visitor WHERE os = 'MAC' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_MAC = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_MAC = 0;
  
  $l_sql = "SELECT count(idvisitor) as n  FROM $table_visitor WHERE os = 'UNX' AND date_format(firstvis,'%Y') = '$p_year'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 0) $l_UNIX = ($c_db->result(0,"n") / $l_nbvisitor) * 100;
  else $l_UNIX = 0;
  
  $l_WIN = 100 - $l_MAC - $l_UNIX;
}

?> 

   <table width="100%" cellspacing="1" cellpadding="1" align="center" border="0">
    <tr><td align="right" class="list" width="48%">WIN</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_WIN); ?> %<br></td></tr>
    <tr><td align="right" class="list">MAC</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_MAC); ?> %<br></td></tr>
    <tr><td align="right" class="list">UNIX</td><td class="list"> &nbsp;<?php printf("%.2f ",$l_UNIX);?> %</td></tr>
   </table>
   
  </td>
 </tr>
 <tr>
  <td align="center" class="list">
<?php 
print("- <a href=$PHP_SELF?p_trafficaction=listcountry&p_year=$p_year>pays</a> -<br>"); 
print("- <a href=$PHP_SELF?p_trafficaction=listtopreferer&p_year=$p_year>origine</a> -"); 
?>
  </td>
 </tr>

</table>

</td></tr></table>

</td></tr></table>

<br>

<?php 
include("$g_modulespath/traffic/adm/sub/graph.inc.php3"); 
?>

<br>
