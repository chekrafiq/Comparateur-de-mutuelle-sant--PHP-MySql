<?php

$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = '1'";
$c_db->query($l_sql);
$l_nbvisit = $c_db->result(0,0);

if ($l_nbvisit == 0)
{
  show_response("aucune visite.");
  return 0;
}

$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = '1' AND date_format(date,'%d') = '$l_day' AND date_format(date,'%m') = '$l_month' AND date_format(date,'%Y') = '$l_year'";
$c_db->query($l_sql);
$l_nbvisthisday = $c_db->result(0,0);

$l_sql = "SELECT max(idvisitor) FROM $table_visitor";
$c_db->query($l_sql);
$l_nbvisitor = $c_db->result(0,0);

$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE flash = '1'";
$c_db->query($l_sql);
$l_nbflash = $c_db->result(0,0);

$l_flashrate = 0;
if ($l_nbvisitor)
{
  $l_flashrate = ($l_nbflash / $l_nbvisitor) * 100;
}



$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE nbrvis > 5";
$c_db->query($l_sql);
$l_nboften = $c_db->result(0,0);

$l_sql = "SELECT max(idlog) FROM $table_log";
$c_db->query($l_sql);
$l_nbpage = $c_db->result(0,0);

?>

<table width="80%" align="center" border="0">
 <tr>
  <td align="left" class="color1" colspan="2">
   :: depuis la cr?ation du site
  </td> 
 </tr>
 <tr>
  <td class="color2" width="70%" align="right">nombre de visites</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisit?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisitor?> <a href="<?php print("/$g_modulespath/visitor/adm");?>" title="lister les visiteurs">&#187;</a></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de pages vues</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbpage?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs ?tant venus plus de 5 fois
  </td>
  <td class="color3" align="left">&nbsp;<a href="<?=$urlroot?>/_kernix_/modules/visitor/adm/index.php3?p_visitoraction=list&p_minvis=5 class=truelink"><?=$l_nboften?></a></td>
 </tr>
 <tr>
  <td class="color2" align="right">pourcentage de visiteurs supportant FLASH
  </td>
  <td class="color3" align="left">&nbsp;<?php printf("%.2f",$l_flashrate); ?> %</td>
 </tr>
 <tr>
  <td class="color2" width="70%" align="right">nombre de visites ce jour</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisthisday?></td>
 </tr>
</table>

<br><br>

<?php show_hr() ?>

<br><br>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" width="60%">
<tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="color2" align="center"> &#187; ann?es &#171; </td></tr>

<?php

if ($l_nbvisit != 0)
{
  $l_sql = "SELECT date_format(firstvis,'%Y') FROM $table_visitor  WHERE idvisitor = '1'";
  $c_db->query($l_sql);

  if ($c_db->numrows) 
  { 
    $l_firstyear = $c_db->result(0,0);

    if ($l_firstyear) 
    {
      $i = $l_year;
      
      while ($i >= $l_firstyear)
      {
	print("<tr><td class=list align=center height=20 valign=center>");
	print("<a href=$PHP_SELF?p_trafficaction=viewyear&p_year=$i>$i</a>");
	print("</td></tr>");
	$i--;
      }
    }
  }
}

?>

</table>
</td></tr></table>

<br><br>
