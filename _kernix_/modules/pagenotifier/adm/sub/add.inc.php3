<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_propertyaction" value="store">
   <tr>
    <td align=right class=color2>nom</td> 
    <td class=color3><input type=text name="p_name" class=text></td>
   </tr> 
   <tr>
    <td align=right class=color2 valign=top>datas</td> 
    <td class=color3><textarea name="p_datas" cols=50 rows=10></textarea></td>
   </tr> 
   <tr>
    <td align=right valign=top class=color2>propertyflag</td> 
    <td class=color3>
     <select name="p_propertyflag">
      <option value="category">category</option>
      <option value="ref">ref</option>
     </select>
    </td>
   </tr>
   <tr>
    <td align=right valign=top class=color2>idowner</td> 
    <td class=color3><input type=text name="p_idowner" size=50 class=text></td>
   </tr>
   <tr>
    <td align=center colspan=2><br><input type=submit value='enregistrer' class=button>
    </td>
   </tr> 
 </table> 

</form> 





