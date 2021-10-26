<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_pollaction" value="store">
  <input type=hidden name="p_storeflag"  value="create">
   <tr>
    <td align=left class=color1 colspan=2 height=20> :: création d'un nouveau vote</td> 
   </tr>
   <tr>
    <td align=right class=color2>nom du vote &nbsp;</td> 
    <td class=color3><input type=text name="p_name" class=text></td>
   </tr> 
   <tr>
    <td align=right class=color2>label &nbsp;</td> 
    <td class=color3><input type=text name="p_label" size=50 class=text></td>
   </tr> 
   <tr>
    <td align=center colspan=2><br><input type=submit value='enregistrer' class=button>
    </td>
   </tr> 
 </table> 

</form> 





