<?php
$l_sql = "SELECT * FROM $table_company";
$c_db->query($l_sql);
$company = $c_db->object_result();
?>

<form method=POST action="<?php print("$PHP_SELF");?>">
 <input type=hidden name="p_siadmaction" value="update">

 <table width=95%>
  <tr>
   <td align=left class=color1 width=70% colspan=2>
    :: informations société 
   </td> 
  </tr>
  <tr>
   <td align=right class=color2 width=25%>
    société &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_companyname value="<?php print($company->companyname); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    forme &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_forme value="<?php print($company->forme); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    capital &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_capital value="<?php print($company->capital); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    siret &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_siret value="<?php print($company->siret); ?>" size=40>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    n° TVA &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_num_tva value="<?php print($company->num_tva); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    code APE &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_ape value="<?php print($company->ape); ?>" size=10>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    adresse &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_address value="<?php print($company->address); ?>" size=50>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    code postal &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_zipcode value="<?php print($company->zipcode); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    ville &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_town value="<?php print($company->town); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    pays &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_country value="<?php print($company->country); ?>" size=30>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    téléphone 1 &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_phone1 value="<?php print($company->phone1); ?>" size=20>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    téléphone 2 &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_phone2 value="<?php print($company->phone2); ?>" size=20>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    fax &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_fax value="<?php print($company->fax); ?>" size=20>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
   email &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_email value="<?php print($company->email); ?>" size=30>
   </td>
  </tr>


  <tr>
   <td align=right class=color2>
    service &nbsp;
   </td>
   <td class=color3>
    <input type=text class=text name=p_service value="<?php print($company->service); ?>" size=30>
   </td>
  </tr>

 </table>
 <br><br>
<?php show_hr(); ?>
 <br>
 <input type=submit name="button" value="enregistrer" class="button">

</form>
