<?php

$l_sql = "SELECT idlog FROM $table_log WHERE idpub > 0 AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbview = $c_db->numrows;

$l_sql = "SELECT idpublog FROM $table_publog WHERE date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbclick = $c_db->numrows;

$l_nbclickrate = 0;
if ($l_nbview)
{
  $l_nbclickrate = (100 / $l_nbview) * $l_nbclick;
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
  <td class=color2 align=right>nombre de vue
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbview); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de click
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbclick); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>pourcentage de click
  </td>
  <td class=color3 align=left>&nbsp;<?php printf("%.2f",$l_nbclickrate);print(" %"); ?>
  </td>
 </tr>

<?php 

if ($p_year == $l_thisyear): 

$l_sql = "SELECT idlog FROM $table_log WHERE idpub > 0 AND date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_nbview = $c_db->numrows;

$l_sql = "SELECT idpublog FROM $table_publog WHERE date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_nbclick = $c_db->numrows;

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
  <td class=color2 align=right>nombre de vue
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbview); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de click
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbclick); ?>
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

$l_sql = "SELECT DISTINCT date_format(date,'%m') AS nummonth, date_format(date,'%b') AS namemonth FROM $table_log WHERE date_format(date,'%Y') = '$p_year' AND idpub > 0 ORDER by nummonth DESC";
$c_db->query($l_sql);
$n = $c_db->numrows;

for ($i=0;$i<$n;$i++)
{
  $l_namemonth = $c_db->result($i,"namemonth");
  $l_nummonth = $c_db->result($i,"nummonth");   
  print("<tr><td align=center class=list> - <a href=$PHP_SELF?p_pubaction=viewmonth&p_nummonth=$l_nummonth&p_year=$p_year title=\"$l_namemonth $p_year\" >$l_namemonth $p_year</a> - </td></tr>");
}

?>
   </table>
  </td>
 </tr>
</table>

</td></tr></table>

</td>
</tr>
</table>

<br>
