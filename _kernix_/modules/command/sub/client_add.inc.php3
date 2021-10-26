<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

<form method="POST" action="<?=$g_urldyn?>" name="oubli" id="oubli">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="client_forgetpass">
 <input type="hidden" name="p_idnumsession"  value="<?=$g_numsession?>">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
 <input type="hidden" name="p_parc"	     value="<?=$p_parc?>">
 <input type="hidden" name="p_poche"	     value="<?=$p_poche?>">
</form>

<form method="POST" action="<?=$g_urldyn?>" name="client" id="client">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="command_view">
 <input type="hidden" name="p_idnumsession"  value="<?=$g_numsession?>">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
 <input type="hidden" name="p_parc"	     value="<?=$p_parc?>">
 <input type="hidden" name="p_poche"	     value="<?=$p_poche?>">

 <tr>
  <td class="caddiecolor3" align="left" valign="center">:: Option 1 : <?=$gl_option2?></td>
 </tr>
 <tr>
  <td class="caddiecolor2" align="center">

    <table align="center" cellspacing="2" cellpadding="2" width="95%"> 
      <tr>
       <td align="right" class="caddiecolor2" width="30%">email</td> 
       <td class="caddiecolor2"><input type="text" name="p_email1" class="caddietext" size="20"></td>
      </tr>
      <tr>
       <td align="right" class="caddiecolor2"><?=$gl_password?></td> 
       <td class="caddiecolor2"><input type="password" name="p_password" class="caddietext" size="20" autocomplete="off"></td>
      </tr>
      <tr>
       <td class="caddiecolor2">&nbsp;</td>
       <td class="caddiecolor2" align="left">
        <input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;<input type="submit" value="<?=$gl_nextstep?>" class="caddiebutton">
       </td>
      </tr>
    </table> 
   <br>&#187; Vous avez oublié votre mot de passe ? <a href="javascript:document.oubli.submit()" class="caddielink">Cliquez ici</a>.
  </td>
 </tr>
</form>

</table>

<br><br>

<?php

$l_countrylist = build_select("port_zone","1","id_portzone","zone_name","p_idportzone","","","class=caddietext");

?>

<br>

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

<form method="POST" action="<?=$PHP_SELF?>" name="new" id="new">
<input type="hidden" name="p_za"             value="command"> 
<input type="hidden" name="p_clientflag"     value="create"> 
<input type="hidden" name="p_commandaction"  value="client_store">
<input type="hidden" name="p_fromref"        value="<?=$p_fromref?>">
<input type="hidden" name="p_parc"	     value="<?=$p_parc?>">
<input type="hidden" name="p_poche"	     value="<?=$p_poche?>">

 <tr>
  <td class="caddiecolor3" align="left">:: Option 2 : <?=$gl_option1?></td>
 </tr>
 <tr>
  <td class="caddiecolor2" align="center" valign="center">

 <table align="center" width="95%"> 
  <tr>
   <td align="right" class="caddiecolor2" width="30%">&nbsp;</td> 
   <td class="caddiecolor2">
    <select name="p_title" class="caddietext">
     <option value="Mr">Mr.</option>
     <option value="Mme">Mme.</option>
     <option value="Mle">Mle.</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_lastname?></b></td> 
   <td class="caddiecolor2"><input type="text" name="p_lastname" class="caddietext" size="40"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_firstname?></b></td> 
   <td class="caddiecolor2"><input type="text" name="p_firstname" class="caddietext" size="40"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><?=$gl_company?></td> 
   <td class="caddiecolor2"><input type="text" name="p_company" class="caddietext"> <i><?=$gl_optional?></i></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b>email</b></td> 
   <td class="caddiecolor2"><input type="text" name="p_email1" class="caddietext" size="40"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_phone?></b></td> 
   <td class="caddiecolor2"><input type="text" name="p_phone" class="caddietext"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><?=$gl_cellphone?></td> 
   <td class="caddiecolor2"><input type="text" name="p_cellphone" class="caddietext"> <i><?=$gl_optional?></i></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2" valign="top"><b><?=$gl_address?></b></td> 
   <td class="caddiecolor2"><textarea name="p_address" cols="39" rows="2" class="caddietext"></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_town?></b></td>
   <td class="caddiecolor2"><input type="text" name="p_town" class="caddietext" size="40"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_zipcode?></b></td> 
   <td class="caddiecolor2"><input type="text" name="p_zipcode" class="caddietext"></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2"><b><?=$gl_country?></b></td> 
   <td class="caddiecolor2"><?=$l_countrylist?></td>
  </tr>
  <tr>
   <td align="right" class="caddiecolor2">&nbsp;</td> 
   <td class="caddiecolor2" align="left" height="30"><input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;<input type="submit" value="<?=$gl_nextstep?>" class="caddiebutton"></td>
  </tr>

 </form>

 </table> 
Ces informations vous permettront de devenir client. Un E-mail d'inscription vous sera rapidement adressé avec vos codes d'accès.


</td></tr>
</table>

<br>
