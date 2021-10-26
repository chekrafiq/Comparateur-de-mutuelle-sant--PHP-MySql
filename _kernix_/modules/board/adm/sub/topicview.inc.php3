<?php

$l_sql = "SELECT * FROM $table_post WHERE idpost = '$p_idpost' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_sql = "SELECT type FROM $table_board WHERE idboard = '$obj->idboard'";
$c_db->query($l_sql);
$l_type = $c_db->result(0,"type");

$l_sql = "SELECT * FROM $table_theme WHERE type = '$l_type'";
$c_db->query($l_sql);
$tab_theme[0] = "AUCUN";
while ($objtmp = $c_db->object_result())
{
  $tab_theme[$objtmp->idtheme] = $objtmp->name;
}

?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idboard"     value="<?php print($obj->idboard); ?>">
 <input type="hidden" name="p_idpost"      value="<?php print($p_idpost); ?>">
 <input type="hidden" name="p_idparent"    value="<?php print($obj->idparent); ?>">
 <input type="hidden" name="p_level"       value="<?php print($obj->level); ?>">
 <input type="hidden" name="p_validflag"   value="<?php print($obj->validflag); ?>">
 <input type="hidden" name="p_adminflag"   value="<?php print($obj->adminflag); ?>">

 <table align="center" width="90%">  
  <tr>
   <td align="left" class="<?php if ($obj->validflag == 1) print("color1"); else print("warning"); ?>" height="20" colspan="2">
:: ARTICLES [<small><?php print($obj->idpost); ?></small>] ( <small><?php print(show_datetime($obj->date)); ?>, visiteurs <?php print("<a href=/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idvisitor class=whitelink>$obj->idvisitor</a>"); ?> </small> )
   </td> 
  </tr>
  <tr>
   <td width=25% align="right" class="color2">titre &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_title" class="text" size="50" value="<?php print($obj->title); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" valign="top" class="color2">résumé &nbsp;</td> 
   <td class="color3">
    <textarea name="p_abstract" cols="55" rows="8"><?php print($obj->abstract); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" valign="top" class="color2">contenu &nbsp;</td> 
   <td class="color3">
    <textarea name="p_content" cols="55" rows="20"><?php print($obj->content); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">thème &nbsp;</td> 
   <td class="color3">
    <select name=p_idtheme>
<?php

foreach($tab_theme as $key => $value)
{
  if ($obj->idtheme == $key)
    print("<option value=$key SELECTED>-- $value --</option>\n");
  else
    print("<option value=$key>-- $value --</option>\n");
}

?>
    </selct>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" size=50>lien &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_link" class="text" size="50" value="<?php print($obj->link); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">icone &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_url" class="text" size="50" value="<?php print($obj->url); ?>">
   </td>
  </tr>
 </table> 

<br>

 <select name="p_boardaction">
  <option value="topicstore">-- enregistrer les modifications --</option>
<?php /* if ($obj->level == 0): ?>
  <option value="topicadd">-- poster une reponse --</option>
  <option value="threadlist">-- lister les réponses --</option>
<?php endif; */ ?>
<?php /* if ($obj->validflag != 1): ?>
  <option value="topicvalidate">-- valider cet article --</option>
<?php endif; */ ?>
  <option value="topicsuppress">-- supprimer cet article --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<script language=javascript>

function htmlwindow(str)
{
  w = window.open("","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=540,height=450");
  w.location = str;
}
</script>

<a href='javascript:htmlwindow("/<?=$g_modulespath?>/site/adm/index.php3?p_siteadmaction=html_doc")' class=link> guide HTML</a>

<br><br>

<?php show_back(); ?>
