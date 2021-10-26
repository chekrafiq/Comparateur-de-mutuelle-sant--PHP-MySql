<?php

if ($p_mailingflag == "cancel")
{
  $l_sql = "UPDATE $table_mailing SET status = '0' WHERE idmailing = '$p_idmailing'";
  $c_db->query($l_sql);
}

$l_sql = "SELECT * FROM $table_mailing WHERE idmailing = '$p_idmailing'";
$c_db->query($l_sql);
$mailing = $c_db->object_result();

?>

<form action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="p_idmailing"    value="<?=$p_idmailing?>"> 
<input type="hidden" name="p_egroupaction" value="<?=mailing_view?>"> 

<table align="center" width="95%"> 
 <tr>
  <td align="left" class="color1" colspan="2" height="20"> 
   :: mailing [ <small><?=$mailing->idmailing?></small> ] <small><?=$mailing->name?></small> 
  </td> 
 </tr>
 <tr>
  <td align="right" class="color2" width="25%">sujet &nbsp;</td>
  <td class="color3"><?=$mailing->subject?> 
  </td>
 </tr>
 <tr>
  <td align="right" class="color2" valign="top">corps &nbsp;</td>
  <td class="color3">
   <textarea class="text" cols="70" rows="30"><?=$mailing->rawbody?></textarea> 
  </td>
 </tr>

<?php if ($mailing->status >= 2): ?>
 <tr>
  <td align="right" class="color2">nombre de mails &nbsp;</td>
  <td class="color3"><?=$mailing->nbtotal?>
  </td>
 </tr> 
 <tr>
  <td align="right" class="color2">nombre de retour &nbsp;</td>
  <td class=color3><?=$mailing->nbvisitor?>
  </td>
 </tr>
<?php endif; ?> 

 <tr>
  <td align="right" class="color2">date &nbsp;</td>
  <td class=color3><?php print(show_datetime($mailing->date)); ?></td>
 </tr>

 <tr>
  <td align="right" class="color2">statut &nbsp;</td>
  <td class=color3>

<?php 

switch ($mailing->status)
{
  case "0":
  print "annulé";
  break;
  case "1":
  print "en préparation";
  break;
  case "2":
  print "en cours : " . $mailing->nbactual;
  break;
  case "3":
  print "terminé";
  break;
}

?>

  </td>

 </tr>

<?php if ($mailing->status >= 2): ?>
 <tr>
  <td align="right" class="color2">date de début &nbsp;</td>
  <td class=color3><?php print(show_datetime($mailing->debdate)); ?></td>
 </tr>
 <tr>
  <td align="right" class="color2">date de fin &nbsp;</td>
  <td class=color3><?php print(show_datetime($mailing->enddate)); ?></td>
 </tr>
<?php endif; ?>

</table>
</form> 
<br> 



<?php if ($mailing->status == 1): ?>

<?php show_hr(); ?>

<br><select name="p_mailingflag">
 <option value="cancel" SELECTED>-- annuler le mailing --</option>
</select>
<input type="submit" value="exécuter" class="button"><br><br>

<?php endif; ?>

<?php

$l_sql = "SELECT COUNT(url) as n, url FROM $table_redirect WHERE idmailing = '1' GROUP BY url";
$c_db->query($l_sql);

if ($c_db->numrows > 1)
{
  print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=92%><tr><td><table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>\n");
  print("<tr><td class=color2 align=center colspan=2> &#187; r e d i r e c t i o n s &#171; </td></tr>\n");
  while ($obj = $c_db->object_result())
  {
    print("<tr><td class=list align=center>$obj->n</td><td class=list> &nbsp; $obj->url</td></tr>\n");
  }
  print("</table></td></tr></table><br><br>\n");
}

?>



<?php show_back(); ?>


