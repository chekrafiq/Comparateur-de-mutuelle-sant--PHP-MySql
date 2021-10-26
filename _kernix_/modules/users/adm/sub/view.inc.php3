<?php

if ($p_idusers == 1)
{
     include("sub/list.inc.php3");
     return 0;
}

$l_sql = "SELECT * FROM $table_users where idusers = $p_idusers";
$c_db->query($l_sql);
$l_infos = $c_db->object_result();
?>

<form method=POST action="<?php print("$PHP_SELF");?>">
<input type=hidden name="p_idusers" value="<?php print("$p_idusers");?>">
<input type=hidden name="p_login_old" value="<?php print($l_infos->login);?>">

 <table width=90%>

  <tr>
   <td class=color1 align=left colspan=2 height=20>
    :: <?php print("User [$p_idusers] &nbsp; ( <small>dernière mise à jour le ".show_datetime($l_infos->updatedate)." - créé par $l_infos->creator</small> )"); ?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
   login &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_login value="<?php print($l_infos->login); ?>" size=10>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    password &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_password value="<?php print($l_infos->password); ?>" size=10>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    nom &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_nom value="<?php print($l_infos->lastname); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    prénom &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_prenom value="<?php print($l_infos->firstname); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    email &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_email value="<?php print($l_infos->email); ?>" size=30>
   </td>
  </tr>


  <tr>
   <td align=right class=color2>
    pouvoir &nbsp;
   </td>
   <td class=color3>
    <select name=p_power>
     <option value=0 <?php if ($l_infos->power == 0) print("SELECTED"); ?>>-- user --</option>
     <option value=1 <?php if ($l_infos->power == 1) print("SELECTED"); ?>>-- admin --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">accès au backoffice &nbsp;</td>
   <td class=color3>
    <select name="p_backofficeflag">
     <option value="0" <?php if ($l_infos->backofficeflag == 0) print("SELECTED"); ?>>-- NON --</option>
     <option value="1" <?php if ($l_infos->backofficeflag == 1) print("SELECTED"); ?>>-- OUI --</option>
    </select>
   </td>
  </tr>

 </table>

<br>

<select name="p_usersaction" size="1">
 <option value="store">-- enregistrer les modifications --</option>
 <option value="suppress">-- supprimer --</option>
</select>

  <input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>

