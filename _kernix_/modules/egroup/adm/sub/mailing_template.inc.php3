<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Newsletter AssurSanté</title>
<link href="http://www.assursante.fr/upload/css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
 <tr>
  <td height="80" valign="bottom"><a href="http://www.assursante.fr" target="_blank"><img src="http://www.assursante.fr/upload/pictures/logo.gif" width="127" height="74" border="0"></a></td>
 </tr>
 <tr>
  <td height="40" bgcolor="#000000"><table width="100%" cellspacing="0" cellpadding="0">
   <tr>
    <td align="center" bgcolor="#FF0000" class="accroche" style="color:#FFFFFF; font-size:20px"><?=$p_subject?></td>
    <td align="right"><a href="http://www.assursante.fr/?p_idref=12" target="_blank"><img src="http://www.assursante.fr/upload/pictures/infos.gif" width="271" height="40" border="0"></a></td>
   </tr>
  </table>
  </td>
 </tr>
 <tr>
  <td valign="top"><table width="100%" cellspacing="0" cellpadding="18">
   <tr>
    <td valign="top" class="contenu">
   <?php print($p_body); ?>

<?php
if ($p_unsubscribeflag == "1")
{
  print("<strong>Si vous ne souhaitez plus recevoir la lettre d'information, </strong><a href='".$g_urlroot . "$g_clientadminpage?p_clientadminaction=emailhome&p_nl=$p_idegroup' class='contenu' style='text-decoration:underline; font-weight:bold'>cliquez ici</a>");
}
?>

</td>
   </tr>
  </table></td>
 </tr>
 <tr>
  <td height="21" align="center" bgcolor="#000000" class="menu_bas">&copy; AssurSant&eacute; 2004. Envoyée via <a href="http://www.kernix.com/kwo" target="_blank" class="menu_bas"><strong>KWO</strong></a></td>
 </tr>
</table>
</body>
</html>
