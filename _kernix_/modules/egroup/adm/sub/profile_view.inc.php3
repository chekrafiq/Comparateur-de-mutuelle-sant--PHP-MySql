<?php

$l_sql = "SELECT * FROM $table_profile WHERE idprofile = '1'";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
     $egroup = $c_db->object_result();
     $p_indic = "update";
}

?>

<form method=post action=<?php print("$PHP_SELF");?> > 
<input type=hidden name=p_egroupaction value="profile_store"> 
<input type=hidden name=p_indic value=<?php print("$p_indic");?>>

 <table align=center width=90%> 
  <tr>
    <td align=left class=color1 colspan=2> :: gestion du profil</td> 
   </tr> 
  <tr>
   <td align=right class=color2>nom</td>
   <td class=color3><input type=text name=p_name value="<?php print("$egroup->name");?>" class=text></td>
  </tr> 
  <tr>
   <td align=right class=color2>email from</td>
   <td class=color3><input type=text name=p_emailfrom size=50 value="<?php print("$egroup->emailfrom");?>" class=text></td>
  </tr> 
  <tr>
   <td align=right class=color2>email reply</td>
   <td class=color3><input type=text name=p_emailreply size=50 value="<?php print("$egroup->emailreply");?>" class=text></td>
  </tr>
  <tr>
   <td align=right class=color2>email request</td>
   <td class=color3><input type=text name=p_emailrequest size=50 value="<?php print("$egroup->emailrequest");?>" class=text></td>
  </tr>
  <tr>
   <td valign=top  align=right class=color2>signature</td>
   <td class=color3><textarea name=p_signature cols=50 rows=8><?php print("$egroup->signature");?></textarea></td>
  </tr> 
  <tr>
   <td align=center colspan=2><br><input type=submit value='enregistrer votre profil' class=button></td>
  </tr> 
 </table> 

</form> 

<?php show_back(); ?>
