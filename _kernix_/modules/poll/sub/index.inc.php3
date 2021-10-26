<?php

$table_poll     = "poll";
$table_pollpost = "pollpost";

$l_msg = "choix enregistré";

if(isset($p_pollinputflag))
{
  $ref->name = "::POLL:: $p_idpoll - $p_option";
  $l_sql = "INSERT INTO  $table_pollpost (idpoll,choice,idvisitor,date) VALUES ('$p_idpoll','$p_option','$g_idvisitor','$l_date')";
  $c_db->query($l_sql);
  $l_nbclicki = "nbclick" . $p_option;
  $l_sql = "UPDATE $table_poll SET $l_nbclicki = $l_nbclicki + 1, nbclick = nbclick + 1  WHERE idpoll = '$p_idpoll'";
  $c_db->query($l_sql);
  print("<center><b>$l_msg</b></center><br><br>");
  return 1;
}

if ($g_idpoll == 0)
{
  $l_sql = "SELECT * FROM $table_poll order by RAND() LIMIT 0,1";
}
else
{
  $l_sql = "SELECT * FROM $table_poll WHERE idpoll = $g_idpoll";
}
$c_db->query($l_sql);
$poll = $c_db->object_result();
$g_idpoll = $poll->idpoll;
?>

<!-- KWO POLL  -->
<table width="90%" align="center" cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="center" class="poll" colspan="2"> 
   <?php print("<b>$poll->label</b>"); ?>
  </td>
 </tr>
 <form action="<?php print($PHP_SELF); ?>" method="POST">
  <input type="hidden" name="p_idref"         value="<?php print($g_idref); ?>" >
  <input type="hidden" name="p_idpoll"        value="<?php print($poll->idpoll); ?>" >
  <input type="hidden" name="p_pollinputflag" value="1">

<?php
for ($i=1; $i<=10; $i++)
{
  $tmp_option = $c_db->result(0,"option$i");
  if ($tmp_option)
  {
    print("<tr><td align=center class=middleleft width=2%>");
    print("<input type=radio name=p_option value=$i class=radio>");
    print("</td><td align=left class=poll>$tmp_option</td></tr>\n");
  }
}
?>

  <tr><td class="poll" colspan="2"></td></tr>

 <tr>
  <td colspan="2" align="center" class="poll"> 
  <center><br><input type="submit" value="valider mon choix" class="button">

<?php 
if ($c_db->result(0,"viewflag") == 1)
{
  print("<br><br>");
  print("[ <a href=$g_urldyn?p_fromref=$p_idref&p_za=poll&p_idpoll=$poll->idpoll>résultats</a> ]");  
}
?>   

  </center>
 </tr>
</table>

</form>
<!-- END KWO POLL  -->
