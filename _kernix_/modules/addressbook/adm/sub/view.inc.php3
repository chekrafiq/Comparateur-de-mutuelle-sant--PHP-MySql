<?php

$l_sql = "SELECT * FROM $table_addressbook WHERE idaddressbook = '$p_idaddressbook' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_addressbookaction" value="update"> 
<input type="hidden" name="p_idaddressbook" value="<?=$obj->idaddressbook?>">

<table align="center" width="90%"> 
 <tr>
  <td align="left" class="color1" colspan="2" height="20">
   :: contact <?=$p_idaddressbook?>
  </td> 
 </tr>
 <tr>
  <td align="right" class="color2">prénom &nbsp;</td> 
  <td class="color3" align="left"><input type="text" name="p_firstname" class="text" value="<?=$obj->firstname?>" size="40"></td>
 </tr>
 <tr>
  <td align=right class=color2>nom &nbsp;</td> 
  <td class=color3><input type=text name="p_lastname" class=text value="<?=$obj->lastname?>" size=40></td>
 </tr>
 <tr>
  <td align=right class=color2>société &nbsp;</td> 
  <td class=color3 align=left><input type=text name="p_company" class=text value="<?=$obj->company?>" size=40></td>
 </tr>
 <tr>
  <td align=right class=color2>url &nbsp;</td> 
  <td class=color3><input type=text name="p_url" class=text value="<?=$obj->url?>" size=60></td>
 </tr>
 <tr>
  <td align=right class=color2>email &nbsp;</td> 
  <td class=color3><input type=text name="p_email" class=text value="<?=$obj->email?>" size=40></td>
 </tr>
 <tr>
  <td align=right class=color2>téléphone &nbsp;</td> 
  <td class=color3><input type=text name="p_phone" class=text value="<?=$obj->phone?>" size=14></td>
 </tr>
 <tr>
  <td align=right class=color2>téléphone (job) &nbsp;</td> 
  <td class=color3><input type=text name="p_workphone" class=text value="<?=$obj->workphone?>" size=14></td>
 </tr>
 <tr>
  <td align=right class=color2>téléphone (mobile) &nbsp;</td> 
  <td class=color3><input type=text name="p_cellphone"  class=text value="<?=$obj->cellphone?>"  size=14></td>
 </tr>
 <tr>
  <td align=right class=color2>fax &nbsp;</td> 
  <td class=color3><input type=text name="p_fax"  class=text value="<?=$obj->fax?>"  size=14></td>
 </tr>
 <tr>
  <td align=right class=color2>adresse &nbsp;</td> 
  <td class=color3><input type=text name="p_address" size=40 class=text value="<?=$obj->address?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>ville &nbsp;</td> 
  <td class=color3><input type=text name="p_town" size=40 class=text value="<?=$obj->town?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>code postal &nbsp;</td> 
  <td class=color3><input type=text name="p_zipcode" size=40 class=text value="<?=$obj->zipcode?>"></td>
 </tr>
 <tr>
  <td align=right class=color2>pays &nbsp;</td> 
  <td class=color3><input type=text name="p_country" size=40 class=text value="<?=$obj->country?>"></td>
 </tr>
 <tr>
  <td align=right valign=top class=color2>remarques &nbsp;</td> 
  <td class=color3><textarea name=p_note rows=6 cols=60><?=$obj->note?></textarea></td>
 </tr>   
</table> 

<br>

<?php show_hr() ?>

<br>

<select name=p_addressbookaction>
 <option value="store">-- enregistrer les modifications --</option>
 <option value="suppress">-- supprimer ce contact --</option>
</select>

&nbsp;

<input type=submit value=valider class=button>

<br><br>
