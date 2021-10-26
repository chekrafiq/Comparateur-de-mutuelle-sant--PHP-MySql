<?php

$l_sql = "SELECT idegroup, name FROM $table_egroup";
$c_db->query($l_sql);
$tab_egroup[0] = "AUCUN";
while ($obj = $c_db->object_result())
{
  $tab_egroup[$obj->idegroup] = $obj->name;
}

$l_sql = "SELECT * FROM $table_form WHERE idform = '$p_idform' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();



?>

<table cellspacing=2 cellpadding=2 border=0 width=95% align=center>
<tr>
<td width=65% class=main valign=left>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idform" value="<?php print("$p_idform"); ?>">

 <table align="left" width="100%" valign="top"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Formulaire [ <small><?php print("$p_idform"); ?></small> ]
   </td> 
  </tr>
  <tr>
   <td width=35% align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="35" value="<?php print("$obj->name"); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">sujet &nbsp;</td> 
   <td class="color3">
    <textarea name="p_subject" class="text" rows="6" cols="35"><?php print("$obj->subject"); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">message de &nbsp;<br>confirmation &nbsp;</td> 
   <td class="color3">
    <textarea name="p_msg_valid" class="text" rows="3" cols="35"><?php print("$obj->msg_valid"); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">message &nbsp;<br>d'erreur &nbsp;</td> 
   <td class="color3">
    <textarea name="p_msg_error" class="text" rows="3" cols="35"><?php print("$obj->msg_error"); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">nombre de &nbsp;<br>champs &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_nbfield" class="text" size="35" value="<?php print("$obj->nbfield"); ?>">
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2">présentation &nbsp;</td> 
   <td class="color3">
    <select name="p_display">
<?php

$l_select = ""; if ($obj->display == 0) $l_select = "SELECTED"; print("<option value=0 $l_select>-- FORMAT 1 --</option>");
$l_select = ""; if ($obj->display == 1) $l_select = "SELECTED"; print("<option value=1 $l_select>-- FORMAT 2 --</option>");

?>
    </select>
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2">liste de diffusion &nbsp;<br> associée &nbsp;</td> 
   <td class="color3">
    <select name="p_idegroup">
<?php

foreach($tab_egroup as $key => $value) 
{
  if ($obj->idegroup == $key)
  $l_check = "SELECTED";
  else
  $l_check = "";
  print("<option value=$key $l_check>-- " . strtoupper($value) . " --</option>");
}

?>
    </select>
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2">email associé &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_email" class="text" size="35" value="<?php print("$obj->email"); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" class="main">
    <input type="checkbox" name="p_emailflag" <?php if ($obj->emailflag == "1") print("CHECKED"); ?> value="1">&nbsp;
   </td>
   <td align="left" class="main">
     envoyer le résultat par mail
   </td>
  </tr> 
 </table> 

</td>
<td class=main align=right valign=top>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=95%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center class=color3>
   .:: création ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print(show_datetime($obj->date)); ?>
  </td>
 </tr>
 <tr>
  <td align=center class=color3>
   .:: nombre de réponses ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print($obj->nbpost); ?>
  </td>
 </tr>
 <tr>
  <td align=center class=color3>
   .:: dernière réponse ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print(show_datetime($obj->lastpostdate)); ?>
  </td>
 </tr>
</table>
</td></tr></table>

</td>
</tr>
</table>

<br><br>

<?php show_hr(); ?>

<br>
 <select name="p_formaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="postlist">-- afficher les résultats --</option>
  <option value="fieldview">-- afficher les champs --</option>
  <option value="exportform">-- exporter les données --</option>
  <option value="suppress">-- supprimer ce form --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>

