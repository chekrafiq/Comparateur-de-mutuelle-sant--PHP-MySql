<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_formaction" value="storeform">
  <input type=hidden name="p_formflag" value="create">
   <tr>
    <td align=left class=color1 width=70% colspan=3> :: Nouveau formulaire</td> 
   </tr>
   <tr>
    <td align=right class=color2>nom du formulaire</td> 
    <td class=color3 colspan=2><input type=text name="p_name" class=text size=35></td>
   </tr> 
   <tr>
    <td align=right class=color2 valign=top>sujet</td> 
    <td class=color3 colspan=2><textarea name="p_subject" cols=50 rows=5></textarea></td>
   </tr>
<?php
for ($i=1;$i<=$l_nbfields;$i++)
{
     print("<tr><td align=right valign=top class=color2 rowspan=2>color2 $i</td>");
     print("<td class=color3>\n");
     print("<input type=text name=p_name$i size=35 class=text></td>\n");
     print("<td align=center width=30% class=listlight>\n");
     print("<select name=p_type$i>\n");
     print("<option value=0> - texte - </option>\n");
     print("<option value=1> - grand texte - </option>\n");
     print("<option value=2> - liste - </option>\n");
     print("</select></td></tr>\n");
     print("<tr><td class=color3>\n");
     print("<input type=text name=p_value$i size=35 class=text></td>\n");
     print("<td align=center width=30% class=listlight>\n");
     print("<select name=p_required$i>\n");
     print("<option value=1> - oui- </option>\n");
     print("<option value=0 selected> - non - </option>\n");
     print("</select></td></tr>\n");
}
?>

   <tr>
    <td align=right valign=top class=color2>recevoir un email ?</td> 
    <td class=color3 colspan=2 align=left>
    <select name=p_emailflag>
     <option value=1>oui</option>
     <option value=0 SELECTED>non</option>
    </select>
    </td>
   </tr>
   <tr>
    <td align=right valign=top class=color2>email</td> 
    <td class=color3 colspan=2><input type=text name="p_email" size=50 class=text></td>
   </tr>
   <tr>
    <td align=center colspan=3><br><input type=submit value='enregistrer'  class=button>
    </td>
   </tr> 
 </table> 

</form> 





