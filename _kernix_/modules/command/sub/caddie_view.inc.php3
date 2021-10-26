<?php 

if (!($p_fromref > 0)) $p_fromref = $adm->idshop;

$l_sql = "SELECT description FROM $table_msg WHERE code = 'NEW_CLIENT$g_lang'";
$c_db->query($l_sql);
$l_msgnewclient = $c_db->result(0,"description");

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession' AND status = '2'";
$c_db->query($l_sql);

if (($c_db->numrows == 0) || !($g_numsession >= 1))
{
  $l_caddie_error_msg  = $gl_error_empty;
  $l_caddie_error_msg .= "<br><br><form action=$PHP_SELF method=post>\n";
  $l_caddie_error_msg .= "<input type=hidden name=p_caddiecookieaction value=command>\n";
  $l_caddie_error_msg .= "<input type=hidden name=p_idref value=$p_fromref>\n";
  $l_caddie_error_msg .= "<input type=submit value='vider le caddie' class=caddiebutton>\n";
  $l_caddie_error_msg .= "</form>\n";
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
} 

$l_sql = "SELECT status FROM $table_command WHERE numsession = '$g_numsession'";
$c_db->query($l_sql);
if ($c_db->numrows >= 1)
{
  if (($c_db->result(0,"status") >= 3) || ($c_db->result(0,"status") == 1))
  {
    $l_caddie_error_msg = "cette commande n'est plus valide";
    include("$g_modulespath/command/sub/_error.inc.php3");
    return 0; 
  }
}

$i = 0;
while ($session = $c_db->object_result())
{
  $tab_session[$i][0] = $session->idproduct;
  $tab_session[$i][1] = $session->productcode;
  $tab_session[$i][2] = $session->idsession;
  $i++;
}

$i = 0;
while ($tab_session[$i])
{
  $l_sql = "SELECT idproduct FROM $table_product AS P, $table_ref AS R WHERE P.idproduct = '" . $tab_session[$i][0] . "' AND P.productcode = '" . $tab_session[$i][1] . "' AND P.caddieflag = '1' AND P.idproduct = R.idproduct AND R.visibilityflag = '1'";
  $c_db->query($l_sql);
  if ($c_db->numrows != 1)
  {
    $l_sql = "DELETE FROM $table_session WHERE idsession = '" . $tab_session[$i][2] . "'";
    $c_db->query($l_sql);
  }
  $i++;
}

$g_quantity     = 0;
$g_price        = 0;

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession'";
$c_db->query($l_sql);

while ($session = $c_db->object_result())
{
  $l_price = $session->pricettc;
  $l_tot   = $session->quantity * $l_price;
  include("$g_modulespath/command/sub/caddie_view_elem.inc.php3");
  print("<br>");
  $l_totsum += $l_tot;
  $l_totquantity += $session->quantity;
}

?>

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">
 <tr>
  <td class="caddiecolor3" align="left" valign="center" colspan="2">:: <?=$gl_cartsummary?></td>
 </tr>

 <tr>
  <td class="caddiecolor2">
   <?=$gl_totalnumber?>
  </td>
  <td class="caddiecolor1">
   &nbsp;<?=$g_quantity?>
  </td>

<form method="POST" action="<?="$g_urldyn"?>">
 <input type="hidden" name="p_idref"               value="<?=$p_fromref?>">
 <input type="hidden" name="p_caddiecookieaction"  value="empty">
 <input type="hidden" name="p_fromref"             value="<?=$p_fromref?>">

  <td class="caddiedelete" rowspan="2" align="center">
   <input type="submit" value="<?=$gl_emptycart?>" class="caddiebutton">
  </td>

</form>

 </tr>

 <tr>
  <td class="caddiecolor2">
   <?=$gl_totalsum?>
  </td>
  <td  class="caddiecolor1">
   &nbsp;<?="$g_price $g_currencyhtml"?>
  </td>
 </tr>
</table>
   
<br><br>

<table width="95%%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="caddiecolor1" align="middle">

<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="client_add">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
 <input type="submit" value="&raquo; <?=$gl_nextstep?>" class="caddiebutton">
</form>

</td></tr>
</table>

<br><br>

<table width="95%%" border="0" cellspacing="0" cellpadding="0">
<form method="POST" action="<?=$g_urldyn?>">
<input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
<input type="hidden" name="p_commandaction" value="caddie_view">
<input type="hidden" name="p_za"            value="command">
<tr><td class="caddiecolor1" align="right">
<select name="p_lang"  onchange="javascript:this.form.submit()">
<option value="<?=$g_lang?>"><?=$gl_ln_choose?> ...</option>
<option value="_fr"> - <?=$gl_ln_french?></option>
<option value="_en"> - <?=$gl_ln_english?></option>
</select>
</td></tr>
</form>
</table>

<!--

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">
<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="client_add">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
 <input type="hidden" name="p_clientflag"    value="create">

 <tr>
  <td class="caddiecolor3" align="left">
  :: <?=$gl_clientno?>
  </td>
 </tr>
 <tr>
  <td class="caddiecolor2" align="center" valign="center">
   <br><?=$l_msgnewclient?><br><br><br>
   <input type="submit" value="<?=$gl_newcustomer?>" class="caddiebutton"> 
   <br><br><br>
  </td>
 </tr>

</form>
</table>


<br>

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="command_view">
 <input type="hidden" name="p_idnumsession"  value="<?=$g_numsession?>">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">

 <tr>
  <td class="caddiecolor3" align="left" valign="center">
  :: <?=$gl_clientyes?>
  </td>
 </tr>
 <tr>
  <td class="caddiecolor2">

    <table align="center" cellspacing="2" cellpadding="2"> 
      <tr>
       <td align="right" class="caddiecolor2" width="45%"><?=$gl_login?></td> 
       <td class="caddiecolor2"><input type="text" name="p_login" class="caddietext" size="15"></td>
      </tr> 
      <tr>
       <td align="right" class="caddiecolor2"><?=$gl_password?></td> 
       <td class="caddiecolor2"><input type="password" name="p_password" class="caddietext" size="15" autocomplete="off"></td>
      </tr>
      <tr>
       <td class="color2" align="center" colspan="2">
        <input type="submit" value="<?=$gl_confirmcommand?>" class=caddiebutton>
       </td>
      </tr>
    </table> 

  </td>
 </tr>

</form>

</table>

<br>

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_za"            value="command">
 <input type="hidden" name="p_commandaction" value="client_mail">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">

 <tr>
  <td class="caddiecolor3" align="left" valign="center">
  :: <?=$gl_forgottenids?>
  </td>
 </tr>
 <tr>
  <td class="caddiecolor2">

    <table align="center" cellspacing="2" cellpadding="2"> 
      <tr>
       <td align="right" class="caddiecolor2" width="45%">
        email
       </td> 
       <td class="caddiecolor2">
        <input type="text" name="p_email" class="caddietext" size="24">
       </td>
      </tr> 
      <tr>
       <td class="color2" align="center" colspan="2">
        <input type="submit" value="<?=$gl_sendids?>" class=caddiebutton>
       </td>
      </tr>
    </table> 

  </td>
 </tr>

</form>

</table>

-->
