<?php

$l_sql = "SELECT * FROM $table_ref where idref = '$p_idref'";
$c_db->query($l_sql);

$ref = $c_db->object_result();

include("sub/onglet.inc.php3");

?>

<form method="post" action="<?php print("$PHP_SELF")?>" name="mainform">
<input type="hidden" name="p_idref" value="<?php print($p_idref)?>">

<table width=100%>
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

</script>

 <tr>
  <td class=color2 align=right valign=top> 
   contenu &nbsp;
  </td>
  <td class=color3 valign=top>
   <textarea name="p_content" cols="65" rows="30"><?php print($ref->content); ?></textarea>
  </td>
 </tr>

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
 <input type="submit" name="submit" value="exécuter" class=button>
</form>

<br>

<a href='javascript:htmlwindow("<?php print($PHP_SELF); ?>?p_siteadmaction=html_doc")' class=link> HTML memo</a>
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="javascript:PopUp(mainform.p_content.value)" class=link>aperçu du contenu</a> 
&nbsp;<img src="/pictures/adm/square.gif" align="absbottom">  
&nbsp;<a href="/?p_idref=<?php print($p_idref); ?>" class=link>voir la page</a> 

<br><br><br>
