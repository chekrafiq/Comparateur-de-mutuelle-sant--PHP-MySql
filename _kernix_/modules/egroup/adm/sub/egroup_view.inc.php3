<?php

$l_sql = "SELECT count(idemail) FROM $table_email WHERE idegroup = '$p_idegroup' AND format = 'HTML' AND status = '2'";
$c_db->query($l_sql);
$l_nbunsub = $c_db->result(0,0);

$l_sql = "SELECT count(idemail) FROM $table_email WHERE idegroup = '$p_idegroup' AND format = 'HTML' AND status = '1'";
$c_db->query($l_sql);
$l_nbemailhtml = $c_db->result(0,0);

$l_sql = "SELECT count(idemail) FROM $table_email WHERE idegroup = '$p_idegroup' AND status = '1'";
$c_db->query($l_sql);
$l_nbemail = $c_db->result(0,0);

if ($l_nbemail > 0)
{
  $l_sql = "SELECT MAX(date) AS date FROM $table_email WHERE idegroup = '$p_idegroup' AND status = '1'";
  $c_db->query($l_sql);
  $l_lastregister = $c_db->result(0,"date");
  $l_htmlpercent = ($l_nbemailhtml / $l_nbemail) * 100;
  $l_htmlpercent = sprintf("%01.2f",$l_htmlpercent) . " %";
}

$l_sql = "SELECT * FROM $table_egroup WHERE idegroup = '$p_idegroup' ";
$c_db->query($l_sql);
$egroup = $c_db->object_result();

?>

<table cellspacing="2" cellpadding="2" border="0" width="98%" align="center">
<tr>
<td width="73%" class="main" valign="left">

<form method="post" action="<?=$PHP_SELF?>" > 
<input type="hidden" name="p_idegroup" value="<?=$p_idegroup?>"> 
<input type="hidden" name="p_nbmsg"    value="<?=$egroup->nbmsg?>">

<table align="center" width="100%"> 
 <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: eGroup  [ <small><?=$p_idegroup?></small> ]
   </td> 
 </tr>
 <tr>
  <td align="right" class="color2" width="25%">nom &nbsp;</td>
  <td class="color3">
    <input type="text" name="p_name" value="<?=$egroup->name?>" class="text">
  </td>
 </tr> 
 <tr>
  <td valign="top" align="right" class="color2">sujet &nbsp;</td>
  <td class="color3">
    <textarea name="p_subject" cols="50" rows="4"><?=$egroup->subject?></textarea>
  </td>
 </tr> 
 <tr>
  <td valign="top" align="right" class="color2">inscription ok &nbsp;</td>
  <td class="color3">
    <textarea name="p_msgok" cols="50" rows="3"><?=$egroup->msgok?></textarea>
  </td>
 </tr>
 <tr>
  <td valign="top" align="right" class="color2">inscription ko &nbsp;</td>
  <td class="color3">
    <textarea name="p_msgbad" cols="50" rows="3"><?=$egroup->msgbad?></textarea>
  </td>
 </tr>
 <tr>
  <td valign="top" align="right" class="color2">msg confirm &nbsp;</td>
  <td class="color3">
    <textarea name="p_msgconfirm" cols="50" rows="3"><?=$egroup->msgconfirm?></textarea>
  </td>
 </tr>
 <tr>
  <td valign="top" align="right" class="main"><input type="checkbox" name="p_notificationflag" value="1" <?php if ($egroup->notificationflag == 1) print("CHECKED"); ?>></td>
  <td class="main">notification admin</td>
 </tr> 
 <tr>
  <td valign="top" align="right" class="main"><input type="checkbox" name="p_confirmflag" value="1" <?php if ($egroup->confirmflag == 1) print("CHECKED"); ?>></td>
  <td class="main">confirmation user</td>
 </tr>
 <tr>
  <td valign="top" align="right" class="main"><input type="checkbox" name="p_formatflag" value="1" <?php if ($egroup->formatflag == 1) print("CHECKED"); ?>></td>
  <td class="main">choix format TXT / HTML</td>
 </tr>
 <tr>
  <td class="main" align="center" colspan="2">
   <br>
   <select name="p_egroupaction">
    <option value="egroup_store" SELECTED>-- enregistrer les modifications --</option>
    <option value="email_list">-- faire la liste des emails --</option>
    <option value="email_add">-- ajouter une liste d&#39;emails --</option>
    <option value="mailing_new">-- envoyer un mailing --</option>
    <option value="mailing_list">-- archive des mailings --</option>
<?php if ($p_idegroup > 4): ?>
    <option value="egroup_suppress">-- supprimer l&#39;egroup --</option>
<?php endif; ?>
   </select>
   <input type="submit" value="exécuter" class="button">
  </td>
 </tr>
</table> 

</td>
<td class="main" align="right" valign="top">

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" width="98%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>
  <td align="center"  class="color3">.:: création ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?php print(show_date($egroup->date)); ?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: nb email ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?=$l_nbemail?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: dernier inscrit ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?php print(show_datetime($l_lastregister)); ?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: nb desabo ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?=$l_nbunsub?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: format HTML ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?=$l_htmlpercent?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: dernier msg ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?php print(show_datetime($egroup->lastmsgdate)); ?></td>
 </tr>
 <tr>
  <td align="center"  class="color3">.:: nb msg ::.</td>
 </tr>
 <tr>
  <td class="list" align="center" height="20"><?=$egroup->nbmailing?></td>
 </tr>
</table>
</td></tr></table>

</form>

<center>
<form method="post" action="<?=$PHP_SELF?>" > 
 <input type="hidden" name="p_egroupaction" value="egroup_view"> 
 <input type="hidden" name="p_idegroup" value="<?=$p_idegroup?>"> 
 <input type="submit" value='&#187; rafraichir &#171;' class="button">
</form>
</center>

</td>
</tr>
</table>

<br><br>




<?php show_hr(); ?>

<form method="post" action="<?=$PHP_SELF?>" > 

 <input type="hidden" name="p_egroupaction" value="email_store"> 
 <input type="hidden" name="p_idegroup" value="<?=$p_idegroup?>"> 
 <input type="text"   name="p_email" class="text" size="30">
 <input type="submit" value='enregistrement express' class="button">

</form> 

<?php show_back(); ?>

