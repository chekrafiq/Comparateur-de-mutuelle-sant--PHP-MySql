
<form action=<?php print("/$g_modulespath/site/adm/index.php3")?>>
<input type=hidden name=p_siteadmaction value=ref_search>

<table align=center> 
 <tr> 
   <tr>
  <td align=center>
   <input type=text size=10 class=text name=p_searchitem>
  </td>
 </tr>
  <td align=left>
   <select name=p_searchmode>
    <option value=byname>-- recherche par nom --</option>
    <option value=bynum>-- recherche par numero de ref --</option>
   </select>
  </td>
 </tr> 
 <tr>
  <td align=center>
   <input type=submit class=button value="exécuter la recherche">
  </td> 
 </tr>
</table>

</form>
