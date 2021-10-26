<?php

$l_sql = "SELECT * FROM $table_form WHERE idform = '$p_idform' ";
$c_db->query($l_sql);
$form = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_idform" value="<?php print("$p_idform"); ?>">
   <tr>
    <td align=left class=color1 width=70% colspan=3> :: Formulaire <?php print("$p_idform"); ?> &nbsp;&nbsp;&nbsp;&nbsp; [ <?php print("$form->nbresult"); ?> résultats ] </td> 
   </tr>
   <tr>
    <td align=right class=color2>nom du formulaire</td> 
    <td class=color3 colspan=2><input type=text name="p_name" class=text  value="<?php print("$form->name"); ?>"></td>
   </tr>
    <tr>
    <td align=right class=color2 valign=top>sujet</td> 
    <td class=color3 colspan=2>
     <textarea name="p_subject" cols=50 rows=5><?php print("$form->subject"); ?> </textarea>
    </td>
   </tr> 
 
<?php
$l_fields = explode_formfieldstring($form->fieldstring);
for ($i=0;$i<$l_nbfields;$i++)
{
     $j = $i + 1;
     print("<tr><td align=right valign=top class=color2 rowspan=2>color2 $j &nbsp;</td><td class=color3>\n");
     print("<input type=text name=p_name$j size=35 class=text value=\"" . $l_fields[$i][0] . "\">\n");
     print("</td><td align=center class=listlight>\n");
     print("<select name=p_type$j>\n");
     print("<option value=0 ");
     if($l_fields[$i][1] == 0) print("SELECTED");
     print(" > --- petit --- </option>\n");
     print("<option value=1 ");
     if($l_fields[$i][1] == 1) print("SELECTED");
     print(" > -- grand -- </option>\n");
      print("<option value=2 ");
     if($l_fields[$i][1] == 2) print("SELECTED");
     print(" > -- select -- </option>\n");
     print("</select></td></tr>\n");
     print("<tr><td class=color3>\n");
     print("<input type=text name=p_value$j size=35 class=text value=\"" . $l_fields[$i][2] . "\"></td>\n");
     print("<td align=center width=30% class=listlight>\n");
     print("<select name=p_required$j>\n");
     print("<option value=1 ");
     if($l_fields[$i][3] == 1) print("SELECTED");
     print("> - oui- </option>\n");
     print("<option value=0 ");
     if($l_fields[$i][3] == 0) print("SELECTED");
     print("> - non - </option>\n");
     print("</select></td></tr>\n");
}
?>

   
   <tr>
    <td align=right valign=top class=color2>envoyer un email ?</td> 
    <td class=color3 colspan=2>
     <select name="p_emailflag" >
      <option value="1" <?php if($c_db->result(0,"emailflag") == 1) print("SELECTED"); ?> >oui</option>
      <option value="0" <?php if($c_db->result(0,"emailflag") == 0) print("SELECTED"); ?> >non</option>
     </select>    
    </td>
   </tr>
   <tr>
    <td align=right valign=top class=color2>email</td> 
    <td class=color3 colspan=2><input type=text name="p_email" size=50 class=text value="<?php print("$form->email"); ?>"></td>
   </tr>
 </table> 

<br>

 <select name=p_formaction>
  <option value=storeform>enregistrer les modifications</option>
  <option value=listresult>voir les résultats</option>
  <option value=suppressform>supprimer ce formulaire</option>
 </select>&nbsp;
 <input type=submit value="éxecuter" class=button>
</form>

<?php show_back(); ?>
