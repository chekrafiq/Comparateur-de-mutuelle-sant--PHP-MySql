<?php

$l_sql = "SELECT * FROM $table_gb";
$c_db->query($l_sql);
$gbadm = $c_db->object_result();

$l_moderatorlist    = yesno_list($gbadm->moderatorflag, "p_moderatorflag");
$l_notificationlist = yesno_list($gbadm->notificationflag, "p_notificationflag");

?>

<table width=98% align=center border=0>
 <tr>
  <td width=70% class=main valign=top align=left>

<form method=post action="<?php print($PHP_SELF);?>" > 
<input type="hidden" name="p_validateflag" value="1">

<table align=center width=100%> 
 <tr>
  <td align=left class=color1 colspan=2 height=20>
   :: admin guestbook 
  </td> 
 </tr>
 <tr>
  <td align=right class=color2 width=25%>moderateur &nbsp;</td>
  <td class=color3>
   <?php print($l_moderatorlist); ?>
  </td>
 </tr> 
 <tr>
  <td align=right class=color2>notification &nbsp;</td>
  <td class=color3>
   <?php print($l_notificationlist);?>
  </td>
 </tr> 
 <tr>
  <td align=right class=color2>email &nbsp;</td>
  <td class=color3>
   <input type=text name=p_email value="<?php print($gbadm->email); ?>" class=text size=35>
  </td>
 </tr>
 <tr>
  <td class=main align=center colspan=2>
   <br>
   <select name=p_gbaction>
    <option value="store" SELECTED>-- enregistrer les modifications --</option>
    <option value="post_list">-- lister les posts à valider --</option>
    <option value="empty">-- supprimer tous les posts --</option>
   </select>
   <input type="submit" value="exécuter" class="button">
  </td>
 </tr>
</table> 

</form>

  </td>
  <td class="main" valign="top" align="right">

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center  class=color3>
   .:: nb posts ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
<?php 
$l_sql = "SELECT idpost FROM $table_gbpost";
$c_db->query($l_sql);
$l_nbpost = $c_db->numrows;
print($c_db->numrows);
?>
  </td>
 </tr>
 <tr>
  <td align=center  class=color3>
   .:: post à valider ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
<?php 
$l_sql = "SELECT idpost FROM $table_gbpost WHERE validflag = '0'";
$c_db->query($l_sql);
print($c_db->numrows);
?>
  </td>
 </tr>
 <tr>
  <td align=center  class=color3>
   .:: dernier msg ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
<?php 
if ($l_nbpost > 0)
{
  $l_sql = "SELECT MAX(date) AS date FROm $table_gbpost";
  $c_db->query($l_sql);
  print(show_datetime($c_db->result(0,"date")));
} 
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

if (!($c_db->numrows > 0))
{
  return 1;
}

show_hr();

?>

<br>
<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   nbmsg
  </td>
  <td class="color2" align="center" width="25%">
   date
  </td>
 </tr>


<?php

$l_sql = "SELECT COUNT(idpost) AS n, MAX(date) AS date, idref FROM $table_gbpost GROUP BY idref";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<tr>");
  print("<td class=$l_class align=center><a href=$PHP_SELF?p_gbaction=post_list&p_idref=$obj->idref class=truelink>$obj->idref</a></td>");
  print("<td class=$l_class align=center>$obj->n</td>");
  print("<td class=$l_class align=center>" . show_datetime($obj->date) . "</td>");
  print("</tr>");
}

?>

</table>
<br>
