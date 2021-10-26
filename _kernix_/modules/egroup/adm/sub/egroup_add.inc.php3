
<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name="p_egroupaction" value="egroup_store"> 
<input type=hidden name="p_egroupflag" value="create"> 

 <table align=center width=70%> 
   <tr>
    <td align=left class=color1 colspan=2 height=20> 
     :: Ajout d'un eGroup
    </td>
   </tr>
   <tr>
    <td align=right class=color2 width=30%>nom &nbsp;</td> 
    <td class=color3><input type=text name="p_name" class=text></td>
   </tr> 
   <tr>
    <td align=right valign=top class=color2>sujet &nbsp;</td> 
    <td class=color3><textarea name="p_subject" cols=40 rows=4></textarea>
    </td>
   </tr> 
   <tr>
    <td align=center colspan=2>
     <br><input type=submit value='enregistrer' class=button>
    </td>
   </tr> 
 </table> 

</form> 

