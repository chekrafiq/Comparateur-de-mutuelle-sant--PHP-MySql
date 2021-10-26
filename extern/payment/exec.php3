<?php

include_once("_kernix_/var.inc.php3");

$table_admshop  = "adm_shop";
$table_currency = "currency";
$table_payment  = "payment";
$table_command  = "command";
$table_session  = "session";
$table_client   = "client";


//--- OUVERTURE D'UNE SESSION
getmysession();

$tab_sous = (isset($MYSESSION["sous"])) ? $MYSESSION["sous"] : array();
$tab_sous2 = (isset($MYSESSION["sous2"])) ? $MYSESSION["sous2"] : array();
$g_numsession = $tab_sous["idsession"];

// SUPPRESS numsession FROM COOKIE + GET NUMSESSION FROM COOKIE
//$p_caddiecookieaction = 'command';
//$p_caddiecookieaction = 'null';
//$return               = include("$g_modulespath/cookie/sub/site.inc.php3");
$p_numsession         = $g_numsession;

if (!$p_numsession)
{
  $l_error = "ERREUR : La session de commande a expiré. session=".$tab_sous["idsession"];
  include("error.inc.php3");
  return 0;
}

$l_sql = "SELECT * FROM $table_command WHERE numsession = '$p_numsession' AND status = '2'";
$c_db->query($l_sql);
//echo "->$l_sql<br>";

if (!($c_db->numrows > 0))
{
  $l_error = "ERREUR : La session de commande a expiré.";
  include("error.inc.php3");
  return 0;
}

$command       = $c_db->object_result();
$command->mode = $p_paymentmode;

$p_idcommand   = $command->idcommand;

if ($p_paymentmode == "CCB")
{
  $l_sql = "SELECT * FROM $table_admshop, $table_payment WHERE $table_payment.idpayment = $table_admshop.idpayment";
}
else
{
  $l_sql = "SELECT * FROM $table_admshop, $table_payment WHERE $table_payment.mode = '$p_paymentmode'";
}
//echo "->$l_sql<br>";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$l_sql = "UPDATE $table_command SET status = '3', mode = '$p_paymentmode' WHERE numsession = '$p_numsession' AND status = '2'";
//echo "->$l_sql<br>";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_session SET status = '3' WHERE numsession = '$p_numsession' AND status = '2'";
//echo "->$l_sql<br>";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_session WHERE numsession = '$command->numsession' AND billdate != '$command->billdate'";
//echo "->$l_sql<br>";
$c_db->query($l_sql);

$l_msg = "texte";

if ($p_paymentmode != "CCB")
{
  include("extern/payment/" . $adm->directory . "/_validate.inc.php3");
  return 1;
}

$l_sql = "SELECT " . $adm->currencydata . " FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
//echo "->$l_sql<br>";
$c_db->query($l_sql);
$l_currency = $c_db->result(0,$adm->currencydata);

?>


<HTML>

<HEAD>

<TITLE>PAIEMENT SECURISE KWO - <?php print(strtoupper($g_sitename)); ?></TITLE>

<style type="text/css">
<!--
BODY      {background-color: #CCCCCC; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #666666;}
TD        {background-color: white;   font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000;}
TD.msg    {background-color: white;   font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: black; letter-spacing: 1px;}
INPUT     {background-color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; letter-spacing: 1px;}
TEXTAREA  {BORDER-RIGHT: white 1px solid; BORDER-TOP: white 1px solid; SCROLLBAR-FACE-COLOR: #CCCCCC; FONT-SIZE: 10px; SCROLLBAR-HIGHLIGHT-COLOR: #CCCCCC; 
           BORDER-LEFT: white 1px solid; SCROLLBAR-SHADOW-COLOR: white; COLOR: #434343; SCROLLBAR-3DLIGHT-COLOR: white; SCROLLBAR-ARROW-COLOR: white; 
           BORDER-BOTTOM: white 1px solid; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; 
           SCROLLBAR-DARKSHADOW-COLOR: #CCCCCC; SCROLLBAR-BASE-COLOR: white; BACKGROUND-COLOR: #CCCCCC; letter-spacing: 1px;}
A         {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #666666;}
-->
</style>

<META name="robots" content="NOINDEX,NOFOLLOW">

</HEAD>

<BODY>

<br>

<center>

<table width="450" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">

 <tr>
  <td align="center" class="caddiecolor3">

<img src="/pictures/payment/banner_payment.jpg" hspace="0">
<br><img src="/pictures/payment/<?=$adm->picture?>">

<br><br>

<table width="400" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td align="center" class="msg">
   <p align="justify">
   <img src="/pictures/command/cadenas.gif" align="absmiddle">
   Vous allez maintenant entrer dans une zone sécurisée
   pour finaliser votre achat / 
   <i>you're going to enter a secure area in order ro finalize your order</i></p>
  </td>
 </tr>
</table> 

<br>

<form name="null">
 <textarea name="textfield" cols="60" rows="6"><?=$adm->paymentdescription?></textarea>
</form> 

<img src="/pictures/payment/line.jpg" vspace="2">

<?php

include("extern/payment/" . $adm->directory . "/_form.inc.php3");

?>

<img src="/pictures/payment/line.jpg" vspace="2">
<br>
<img src="/pictures/payment/logo_kernix.gif" vspace="4">
<br><br>

  </td>
 </tr>
</table>

<br>
site basé sur la solution - <a href="<?=$g_softurl?>" target="_blank">K e r n  i X  &nbsp;  W E B &nbsp; O F F I C E</a>

</center>

</BODY>
</HTML>
