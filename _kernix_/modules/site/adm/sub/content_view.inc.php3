<?php

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);

$ref = $c_db->object_result();

include("sub/onglet.inc.php3");

if ($p_idref == 1035) $l_richeditflag = 1;

?>

<script language=javascript>

function htmlwindow(str)
{
  w = window.open("","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=540,height=450");
  w.location = str;
}

function PopUp(contenu) 
{
 contents = "<HTML><HEAD><TITLE>Apercu : <?php print("$ref->name [$p_idref]");?></TITLE></HEAD>";
 contents += "<BODY>" + contenu;
 contents += "</BODY></HTML>";
 NewWin = window.open("","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=400");
 NewWin.document.open();
 NewWin.document.write("<html><head><LINK HREF=\"<?=$g_skinpath?>/default/main.css\" REL=\"stylesheet\" TYPE=\"text/css\"></head><body>" + contents + "</body></html>");
 NewWin.document.close();
}

function saveDocument() 
{
 document.mainform.p_content.innerText = document.richedit.docHtml;
 document.mainform.submit();
}

</script>

<form method="post" action="<?=$PHP_SELF?>" name="mainform">
<input type="hidden" name="p_siteadmaction" value="content_update">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">

<table width="100%">

 <tr>
  <td class="color1" align="left" colspan="2" height="20">:: [ <small>page#<?=$p_idref?></small> ] contenu : <small><?=$ref->name?></small></td>
 </tr>

 <tr>
  <td class="color2" align="right">titre  &nbsp;</td>
  <td class="color3"><input class="text" type="text" name="p_title" value="<?=$ref->title?>" size="65"></td>
 </tr>

 <tr>
  <td class="color2" align="right">accroche  &nbsp;</td>
  <td class="color3"><textarea class="text" name="p_accroche" rows="5" cols="65"><?=$ref->accroche?></textarea></td>
 </tr>

<?php if ($l_richeditflag == 1): ?>

<textarea name="p_content" style="display:none" rows="1" cols="20"><?php print(nl2br($ref->content)); ?></textarea>
<input type="hidden" name="p_richeditflag" value="1">
<input type="hidden" name="p_content_typeflag" value="0">

 <tr>
  <td class=color3 valign=top colspan=2>
  <object id="richedit" style="BACKGROUND-COLOR: buttonface" data="/extern/richedit/richedit.html"
        width="100%" height="400" type="text/x-scriptlet" VIEWASTEXT>
  </object>
  </td>
 </tr>

<SCRIPT language="JavaScript" event="onload" for="window">
 document.richedit.options = "history=no;source=yes";
 document.richedit.docHtml = mainform.p_content.value;
</SCRIPT>

<?php else: ?>

 <tr>
  <td class="color2" align="left" valign="top" width="25%"> 
    <p align="right">contenu &nbsp;</p><br><br><br>
    &nbsp; type :<br>
    &nbsp; &nbsp;<input type="radio" value="0" name="p_content_typeflag"<?php if ($ref->content_typeflag != 1) print("CHECKED"); ?>> défaut<br>
    &nbsp; &nbsp;<input type="radio" value="1" name="p_content_typeflag" <?php if ($ref->content_typeflag == 1) print("CHECKED"); ?>> no BR<br>
  </td>
  <td class="color3" valign="top"><textarea name="p_content" cols="65" rows="30"><?=$ref->content?></textarea></td>
 </tr>

<?php endif; ?>

 <tr><td><br></td></tr>

 <tr><td align="left" class="color1" colspan="2" height="20">:: visuel</td></tr>

 <tr>
  <td class="color2" align="right">modèle &nbsp;</td>
  <td align="left" class="color3"><?php echo build_select_csv('aucun,' . $adm->template, $ref->template, 'p_template', ''); ?></td>
 </tr>

 <tr>
  <td class="color2" align="right">icone - image  &nbsp;</td>
  <td class="color3"><input class="text" type="text" name="p_icon" value="<?=$ref->icon?>" size="30"> - <input class="text" type="text" name="p_picture" value="<?=$ref->picture?>" size="30"></td>
 </tr>


 <tr>
  <td colspan="2" align="center">
   <br>

<?php if ($l_richeditflag == 1): ?>
<input type="button" value="exécuter" class="button" onclick="saveDocument()">
<?php else: ?>
<input type="submit" name="submit" value="enregistrer" class="button">
<?php endif; ?>

   <br><br>
  </td>
 </tr>

</table>

</form>

<br>

<a href='javascript:htmlwindow("<?=$PHP_SELF?>?p_siteadmaction=html_doc")' class=link> HTML memo</a>
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="javascript:PopUp(mainform.p_content.value)" class=link>aperçu du contenu</a> 
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="/?p_idref=<?=$p_idref?>" class=link>voir la page</a> 

<br><br><br>
