<?php 

$l_sql = "SELECT * FROM $table_payment WHERE idpayment = '$adm->idpayment'";
$c_db->query($l_sql);
$payment = $c_db->object_result();

?>

<form method=POST action="<?php print("$PHP_SELF");?>">
 <input type=hidden name="p_shiadmaction"  value="paymentstore">
 <input type=hidden name="p_idpayment"     value="<?php print($payment->idpayment);?>">

 <table width=98%>
  <tr>
   <td align=left class=color1 colspan=2>
    :: paramètres bancaires [<small><?php print($payment->name);?></small>]
   </td> 
  </tr>

  <tr>
   <td class=color2 align=right>
    merchantname &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_merchantname" value="<?php print($payment->merchantname);?>">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    merchantnum &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_merchantnum" value="<?php print($payment->merchantnum);?>">
   </td>
  </tr>

<?php

if ($adm->idpayment == 3): //--------- CYBERMUT

?>

  <tr>
   <td class=color2 align=right width=40%>
    option &nbsp;
   </td>
   <td class=color3>
    <select name="p_poption">
     <option value="CM"  <?php if ($payment->poption == "CM")  {print("selected"); } ?>>-- CREDIT MUTUEL --</option>
     <option value="CIC" <?php if ($payment->poption == "CIC") {print("selected"); } ?>>-- CIC --</option>
    <select>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    language &nbsp;
   </td>
   <td class=color3>
    <select name="p_language">
     <option value="francais" <?php if ($payment->language == "francais") {print("selected"); } ?>>-- FRANCAIS --</option>
     <option value="anglais"  <?php if ($payment->language == "anglais")  {print("selected"); } ?>>-- ANGLAIS --</option>
     <option value="francais" <?php if ($payment->language == "allemand") {print("selected"); } ?>>-- ALLEMAND --</option>
    <select>
   </td>
  </tr>

<?php 

//--------- SOGENACTIF 
elseif($adm->idpayment == 4): 

?>

  <tr>
   <td class=color2 align=right>
    language &nbsp;
   </td>
   <td class=color3>
    <select name="p_language">
     <option value="fr" <?php if ($payment->language == "fr") {print("selected"); } ?>>-- FRANCAIS --</option>
     <option value="en" <?php if ($payment->language == "en") {print("selected"); } ?>>-- ANGLAIS --</option>
     <option value="ge" <?php if ($payment->language == "ge") {print("selected"); } ?>>-- ALLEMAND --</option>
     <option value="it" <?php if ($payment->language == "it") {print("selected"); } ?>>-- ITALIEN --</option>
     <option value="sp" <?php if ($payment->language == "sp") {print("selected"); } ?>>-- ESPAGNOL --</option>
    <select>
   </td>
  </tr>

<?php 

//--------- PAYBOX 
elseif($adm->idpayment == 5): 

?>

  <tr>
   <td class=color2 align=right>
    merchantrank &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_merchantrank" value="<?php print($payment->merchantrank);?>" size=3>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    language &nbsp;
   </td>
   <td class=color3>
    <select name="p_language">
     <option value="FRA" <?php if ($payment->language == "FRA") {print("selected"); } ?>>-- FRANCAIS --</option>
     <option value="GBR" <?php if ($payment->language == "GBR") {print("selected"); } ?>>-- ANGLAIS --</option>
     <option value="DEU" <?php if ($payment->language == "DEU") {print("selected"); } ?>>-- ALLEMAND --</option>
    <select>
   </td>
  </tr>

<?php endif; ?>

  <tr>
   <td class=color2 align=right>
    bank url &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_bankurl" value="<?php print($payment->bankurl);?>" size="40">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    mode &nbsp;
   </td>
   <td class=color3>
    <select class="text" name="p_testflag">
     <option value="1" <?php if ($payment->testflag == 1) {print("selected"); } ?>>-- TEST --</option>
     <option value="0" <?php if ($payment->testflag == 0) {print("selected"); } ?>>-- PRODUCTION --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    homepage &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_homepage" value="<?php print($payment->homepage);?>" size="40">
   </td>
  </tr>

 </table>

 <br>

<?php show_hr(); ?>

 <br>

 <input type=submit name="button" value="enregistrer" class="button">

</form>
