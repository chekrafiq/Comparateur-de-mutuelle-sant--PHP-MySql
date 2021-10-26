<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=85%> 
  <input type=hidden name="p_taxesaction" value="store">
  <input type=hidden name="p_taxesflag" value="create">
   <tr>
    <td align=left class=color1 colspan=2>
     :: Nouvelle Taxe
    </td> 
   </tr>
   <tr>
    <td align=right class=color2 width=30%>nom &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_name" class=text size=35>
    </td>
   </tr> 
   <tr>
    <td align=right class=color2 valign=top>description &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_description" class=text size=50>
    </td>
   </tr>
   <tr>
    <td align=right class=color2>taux image&nbsp;</td> 
    <td class=color3>
     <input type=text name="p_rate" class=text size=35>
    </td>
   </tr>
   <tr>
    <td align=center colspan=2>
     <br><input type=submit value='enregistrer' class=button>
    </td>
   </tr> 
 </table> 

</form> 





