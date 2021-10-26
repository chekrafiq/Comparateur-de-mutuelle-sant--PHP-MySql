<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_currencyaction" value="store">
  <input type=hidden name="p_currencyflag" value="create">
   <tr>
    <td align=left class=color1 width=70% colspan=3>
     :: Nouvelle Monnaie
    </td> 
   </tr>
   <tr>
    <td align=right class=color2>nom &nbsp;</td> 
    <td class=color3 colspan=2>
     <input type=text name="p_name" class=text>
    </td>
   </tr> 
   <tr>
    <td align=right class=color2>1 x = &nbsp;</td> 
    <td class=color3 colspan=2>
     <input type=text name="p_value" class=text> <?php print($g_currencyname); ?>
    </td>
   </tr>
   <tr>
    <td align=right class=color2>acronym TXT &nbsp;</td> 
    <td class=color3 colspan=2>
     <input type=text name="p_acronymtxt" class=text>
    </td>
   </tr>
   <tr>
    <td align=right class=color2>acronym HTML &nbsp;</td> 
    <td class=color3 colspan=2>
     <input type=text name="p_acronymhtml" class=text>
    </td>
   </tr>
   <tr>
    <td align=right class=color2>ISO &nbsp;</td> 
    <td class=color3>
     <input type=text name="p_isocode" class=text>
    </td>
   </tr>
   <tr>
    <td align=center colspan=3>
     <br><input type=submit value='enregistrer' class=button>
    </td>
   </tr> 
 </table> 

</form> 





