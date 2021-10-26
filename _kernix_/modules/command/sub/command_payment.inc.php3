<?php

$l_sql = "SELECT description FROM $table_msg WHERE code = 'PAYMENT_$l_paymentmode$g_lang'";
$c_db->query($l_sql);
$l_msg = ereg_replace("SOCIETE",$company->companyname,nl2br($c_db->result(0,"description")));

?>

<br><br><br><br>

<table border="0" cellspacing="2" cellpadding="2" width="95%" valign="middle">
 <tr>
  <td class="caddiecolor1" width="40%">
   <img src="/pictures/command/cadenas.gif" align="absmiddle" hspace="2"> <b><?php print("$gl_paymentby $l_title"); ?> :<b>
  </td>

  <form method="POST" action="<?php print($g_urlroot . $g_externpath . "/payment/exec.php3"); ?>">
  <td class="caddiecolor1" align="right">
    <input type=hidden name="p_paymentmode"        value="<?=$l_paymentmode?>">
    <input type=hidden name="p_fromref"            value="<?=$p_fromref?>">
    <input type="submit" name="action" value="<?php print(" $gl_validation [" . strtoupper($l_title) . "]"); ?>" class="caddiebutton">
  </td>
  </form>  
 </tr>

 <tr>
  <td align="left" valign="top" class="caddiecolor1" colspan="2">
<?php print($l_msg); ?>
   </td>
 </tr>
</table> 

