<?php

$table_poll     = 'poll';
$table_pollpost = 'pollpost';

$l_nboptions = 10;

$l_sql = "SELECT * FROM $table_poll WHERE idpoll = '$p_idpoll' ";
$c_db->query($l_sql);
$poll = $c_db->object_result();

?>

<br>
<table bgcolor="#444F5F" border="0" cellspacing="0" cellpadding="0" align="center" width="95%">
<tr><td>

<table bgcolor="#444F5F" border="0" cellspacing="1" cellpadding="1" width="100%">

 <tr>
  <td class="main" align="left">
   &nbsp; <?=$poll->label?>
  </td>
 </tr>
 <tr>
  <td class="main" align="right">
  <?=$poll->nbclick?> nbclick(s) depuis le <?=show_date($poll->date)?>&nbsp;
  </td>
 </tr>
 <tr>
  <td class="main" align="center">
   <br>

<table align=center>
<?php

for ($i=1;$i<=$l_nboptions;$i++)
{
  if ($poll->nbclick==0) $l_nbc=1; else $l_nbc=$poll->nbclick; 
  print("<tr><td align=right valign=top class=main width=40%><b>" . $c_db->result(0,"option$i")  . "</b></td>\n");
  print("<td align=center class=main>\n");
  if ($c_db->result(0,"option$i"))
  {
    $l_n = $c_db->result(0,"nbclick$i") / $l_nbc * 100;
    printf("%.2f %%",$l_n);
  }
  print("</td></tr>\n");
}

?>
</table>

</td>
</tr>
</table>
</td></tr></table>
