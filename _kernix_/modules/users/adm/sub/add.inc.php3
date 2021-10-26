<form method=POST action="<?php print("$PHP_SELF");?>">
<input type=hidden name="p_usersaction" value="store">
<input type=hidden name="p_usersflag" value="create">

 <table width=90%>
  <tr>
    <td align=left class=color1 width=70% colspan=2> 
     :: Ajout d'un utilisateur
  </tr>

  <tr>
   <td align=right class=color2>
    login &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_login size=10>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    password &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_password size=10>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    nom &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_nom size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    prénom &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_prenom size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    email &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_email size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    pouvoir &nbsp;
   </td>
   <td class=color3>
    <select name=p_power>
     <option value="0">-- user --</option>
     <option value="1">-- admin --</option>
    </select>
   </td>
  </tr>

 </table>

<br>
 
<input type="submit" value="enregistrer" class="button">

</form>
