<?php

include_once("_kernix_/var.inc.php3");

?>

<HTML>

<HEAD>

<TITLE>PAIEMENT SECURISE KWO - <?php print(strtoupper($g_sitename)); ?></TITLE>

<style type="text/css">
<!--
BODY      {background-color: #CCCCCC;   font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: black;}
TD        {background-color: white;   font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: black;}
INPUT     {background-color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF;}
TEXTAREA  {background-color: #CCCCCC; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #000000;}
A        {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: black;}
-->
</style>

<META name="robots" content="NOINDEX,NOFOLLOW">

</HEAD>

<BODY>

<br>

<center>

<table width=400 bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
<tr><td align=center class=caddiecolor3>
<img src="/pictures/payment/banner_payment.jpg" hspace="0">
<br>
<?php

print("<b>$l_error</b>");

?>

<br><br>
<a href="<?php print("$g_urldyn?p_idref=698") ?>">retour au site</a> 
<br><br>
</td></tr></table>

</center>

</BODY>
</HTML>
