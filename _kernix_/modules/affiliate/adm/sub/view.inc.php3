<?php

$l_sql = "SELECT * FROM $table_affiliate WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("erreur, cet affilié n'existe pas.");
  return 0;
}
$affiliate = $c_db->object_result();

?>

<form action="<?php print($PHP_SELF)?>" >
<input type="hidden" name="p_idaffiliate" value="<?php print($p_idaffiliate)?>">

<table width="90%" align="center">
 <tr>
  <td align=left class=color1 colspan=2>
   :: compte <?php print("$affiliate->payableto");?> &nbsp;&nbsp; 
      <small>( <?php print("$affiliate->nbvisitor");?> visiteurs ) &nbsp;
      depuis le <small><?php print(show_date($affiliate->date));?></small>, 
      visitor <?php if ($affiliate->idvisitor == 0) print("0"); else print("<a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$affiliate->idvisitor class=whitelink>$affiliate->idvisitor</a>"); ?>
  </td> 
 </tr> 
 <tr>
  <td class=color2 align=right width=30%>nom &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_lastname" value="<?php print($affiliate->lastname); ?>" size="20" class="text">
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>prénom &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_firstname" value="<?php print($affiliate->firstname); ?>" size="20" class="text">
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>ordre &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_payableto" value="<?php print($affiliate->payableto); ?>" size=50 class="text">
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>adresse &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_address" value="<?php print(nl2br($affiliate->address));?>" size=50 class="text">
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>email &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_email" value="<?php print($affiliate->email); ?>" size=50 class="text">
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>URL &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_url" value="<?php print($affiliate->url); ?>" size=50 class="text">
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>login &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_login" value="<?php print($affiliate->login); ?>" size=20 class="text">
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>password &nbsp;</td>
  <td class=color3 align=left>
   <input type="text" name="p_password" value="<?php print($affiliate->password);?>" size=20 class="text">
  </td>
 </tr>  
 <tr>
  <td colspan="2" align="center">
   <br>
   <select name="p_affiliateaction">
    <option value="store">-- enregistrer les modifications --</option>
    <option value="commandlist">-- lister les commandes --</option>
    <option value="reset">-- mettre le compteur actuel à zéro --</option>
    <option value="modeview">-- changer le mode de rémunération --</option>
    <option value="suppress">-- supprimer ce compte --</option>
    <option value="listvisitor">-- lister les visiteurs --</option>
   </select>
   &nbsp;&nbsp;
   <input type="submit" value="exécuter" class="button"><br><br>
<?php

  show_hr();

?>
   <br>

   <input type="text" name="p_nothing" value="<?php print("$g_urldyn?p_idaffiliate=$affiliate->idaffiliate"); ?>" class="text" size="80">
   <br><br>
<?php

  show_hr();

?>
  <br>
  </td>
 </tr>
  <tr>
   <td align=left class=color1 colspan=2>
     :: compte actuel &nbsp;&nbsp; <small>(  
<?php

if ($affiliate->affiliatemode == 0)
{
  print(" mode par défaut ");
}
else
{
  if ($affiliate->affiliatemode == 1)
  {
   print(" valeur fixe : $affiliate->affiliatevalue ");    
  }
  else 
  {
       print(" pourcentage : $affiliate->affiliatevalue %");    
  }

}

?>
   )</small>
   </td> 
 </tr>
 <tr>
  <td class=color2 align=right>nb commandes &nbsp;</td>
   <td class=color3 align=center>
    <?php print("$affiliate->currentorder");?>
   </td>
 </tr> 
 <tr>
  <td class=color2 align=right>compte &nbsp;</td>
  <td class=color3 align=center>
   <?php printf("%.2f  $g_currencyname",$affiliate->currentaccount); ?>
  </td>
 </tr> 
 <tr>
  <td colspan=2><br></td>
 </tr>
  <tr>
   <td align=left class=color1 colspan=2>
    :: compte total &nbsp;&nbsp; <small>( <?php print("$affiliate->nbpayment");?> paiement(s) )</small>
   </td> 
 </tr> 
 <tr>
  <td class=color2 align=right>nb commandes &nbsp;</td>
  <td class=color3 align=center>
   <?php print("$affiliate->totalorder");?>
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right>compte &nbsp;</td>
  <td class=color3 align=center>
   <?php printf("%.2f  $g_currencyname",$affiliate->totalaccount);?>
  </td>
 </tr> 
</table> 

</form>

<br>


<?php show_back(); ?>
