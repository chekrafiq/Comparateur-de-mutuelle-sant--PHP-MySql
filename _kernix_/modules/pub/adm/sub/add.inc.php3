<form method=post action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_pubaction" value="store">
 <input type="hidden" name="p_pubflag" value="create">

<table align=center width=90%> 
 <tr>
  <td align=left class=color1 colspan=3>
   :: Nouvelle pub
  </td> 
 </tr>

 <tr>
  <td align=right class=color2 width=35%>nom &nbsp;</td>
  <td class=color3>
   <input type=text name=p_name size=20 class=text>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>data &nbsp;</td>
  <td class=color3>
   <input type=text name=p_image size=45 class=text>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>média &nbsp;</td>
  <td class=color3>
   <select name="p_media">
    <option value="PICT" SELECTED>-- image --</option>
    <option value="FLASH">-- animation FLASH --</option>
    <option value="HTML">-- HTML/IFRAME --</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>adresse de destination &nbsp;</td>
  <td class=color3>
   <input type=text name=p_url size=45 class=text>
  </td>
 </tr>
  <tr>
  <td align=right valign=top class=color2>description &nbsp;</td>
  <td class=color3>
   <textarea cols=45 rows=8 class=text name=p_description></textarea>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>type &nbsp;</td>
  <td class=color3>
   <select name="p_type">
    <option value="1">-- nbview --</option>
    <option value="2">-- nbclick --</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>nbmax &nbsp;</td>
  <td class=color3>
   <input type=text name=p_nbmax size=20 class=text>
  </td>
 </tr>
 <tr>
  <td align=right valign=top class=color2>infos &nbsp;</td>
  <td class=color3>
   <textarea cols=45 rows=8 class=text name=p_infos></textarea>
  </td>
 </tr>
</table> 

<br>

 <input type=submit value="enregistrer" class=button>

</form>

<?php show_back(); ?>



