<?php

$l_sql = "SELECT * FROM $table_ref where idref = '$p_idref'";
$c_db->query($l_sql);

$ref = $c_db->object_result();

include("sub/onglet.inc.php3");

?>

<form method="post" action="<?php print("$PHP_SELF")?>" name="mainform">
<input type="hidden" name="p_idref" value="<?php print($p_idref)?>">

<table width=95%>
 <tr>
  <td class=color1 align=left colspan=2 height=20>
      :: 
<?php

print("[ <small>page#$p_idref</small> ] contenu : <small>$ref->name</small>");

?>

  </td>
 </tr>

<script language=javascript>

function htmlwindow(str)
{
  w = window.open("","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=540,height=450");
  w.location = str;
}

function PopUp(contenu) {

contents = "<HTML><HEAD><TITLE>Apercu : <?php print("$ref->name [$p_idref]");?></TITLE></HEAD>";
contents += "<BODY>" + contenu;
contents += "</BODY></HTML>";

NewWin = window.open("","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=400");
NewWin.document.open();
NewWin.document.write("<html><head><LINK HREF=\"<?php print($g_skinpath); ?>/default/main.css\" REL=\"stylesheet\" TYPE=\"text/css\"></head><body>" + contents + "</body></html>");
NewWin.document.close();
}

function saveDocument() { // webmaster@7thportal.org
//  if (!isRTextMode()) return;
//  setMode(1); //switch doc to html mode for save
//  this.document.mainform.content.value = toto.mytext.document.body.innerText;
//  setMode(0); //switch doc back to text mode
//  parent.document.FormName.submit(); // submit parent form for save
//  this.document.mainform.content.value  = "toto";

 document.mainform.p_content.innerText = document.richedit.docHtml;
 document.mainform.submit();
}

</script>

<textarea name="p_content" style="display:none" rows="1" cols="20"><?php print(nl2br($ref->content)); ?></textarea>

 <tr>
  <td class=color3 valign=top colspan=2>
  <object id="richedit" style="BACKGROUND-COLOR: buttonface" data="/extern/richedit/richedit.html"
	width="100%" height="400" type="text/x-scriptlet" VIEWASTEXT>
  </object>
  </td>
 </tr>

<SCRIPT language="JavaScript" event="onload" for="window">
 document.richedit.options = "history=no;source=yes";
//		richedit.addField("to", "To", 128, "someone@somewhere.com");
//		richedit.addField("cc", "Cc", 128, "someone@else.com");
//		richedit.addField("subject", "Subject", 128, "Something about Nothing");
// richedit.docHtml = this.document.mainform.pagecontent.value;
// richedit.docHtml = "toto";
 document.richedit.docHtml = mainform.p_content.value;
</SCRIPT>

 <tr>
  <td class=color2 align=right>
   link &nbsp;
  </td>
  <td class=color3>
   <input class="text" type="text" name="p_link" value="<?php print($ref->link); ?>" size=65>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>
   script &nbsp;
  </td>
  <td class=color3>
   <input class="text" type="text" name="p_script" value="<?php print($ref->script); ?>" size=65>
  </td>
 </tr>

</table>

<br>

 <select name=p_siteadmaction>
  <option value=content_update selected> -- enregistrer les modifications -- </option>
 </select>
 <input type="button" value="exécuter" class="button" onclick="saveDocument()">
</form>

<br>

<a href='javascript:htmlwindow("<?php print($PHP_SELF); ?>?p_siteadmaction=html_doc")' class=link> HTML memo</a>
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="javascript:PopUp(mainform.p_content.value)" class=link>aperçu du contenu</a> 
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="/?p_idref=<?php print($p_idref); ?>" class=link>voir la page</a> 

<br><br><br>
