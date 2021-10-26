<?php

include("_kernix_/var.inc.php3");

$table_msg = "msg";

$l_sql = "SELECT description FROM $table_msg WHERE code = 'TXT_CYBERMUT'";
$c_db->query($l_sql);

if ($type == "CM")
{
  $l_serversec = "https://www.creditmutuel.fr/telepaiement/paiement.cgi";
}
else
{
  $l_serversec = "https://ssl.paiement.cic-banques.fr/paiement.cgi";
}

?>

<html>
<head>
<title>Paiement Sécurisé KWO</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
INPUT {background-color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pts; font-weight: bold; color: #FFFFFF}
TEXTAREA  {background-color: #CCCCCC; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pts; color: #000000}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td align="center" valign="middle"> 
      <table width="400" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle" bordercolor="#333333">
            <table width="400" border="0" cellspacing="1" cellpadding="1">
              <tr> 
                <td align="center"><img src="/pictures/payment/cybermut/bandeau_haut.gif" width="393" height="73"></td>
              </tr>
              <tr> 
                <td align="center">
<table width="90%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center">
<br> 
<font face="Verdana, Arial, Helvetica, sans-serif" color="#666666" size="2"><b>
Vous allez entrer dans une zone de paiement s&eacute;curis&eacute; 
sur les serveurs bancaires du Cr&eacute;dit Mutuel et du CIC.</b></font><br>
<br>
<br>
</td></tr></table>
                </td>
              </tr>
              <tr> 
                <td align="center"> 
                  <form name="form1" method="post" action="">
                    <textarea name="textfield" cols="40" rows="7"><?php print($l_msg); ?></textarea>
                  </form>
                </td>
              </tr>
              <tr>
                <td align="center">

<?php

//string cybermut_creerformulairecm(string url_CM, string version, string TPE, string montant, string ref_commande, string texte_libre, string url_retour, string url_retour_ok, string url_retour_err, string langue, string code_societe, string texte_bouton)

$out =  creditmut_creerformulairecm($l_serversec,"1.2",$p_merchantnum,$p_amount,$p_idcommand,$p_numsession,$p_urlsite,$p_urlok,$p_urlerr,$p_language,$p_merchantname,"paiement par carte bancaire" );

echo $out;

?>
                </td>
              </tr>
              <tr> 
                <td align="center"><img src="/pictures/payment/cybermut/bandeau_kwo.gif" width="393" height="58"></td>
              </tr>
              <tr> 
                <td><img src="/pictures/payment/cybermut/logo_cic.gif" width="212" height="81" align="left"><img src="/pictures/payment/cybermut/logo_creditmutuel.gif" width="186" height="74"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
</body>
</html>

