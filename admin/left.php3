<?php

include("_kernix_/var.inc.php3");
include("_kernix_/tables.inc.php3");

$g_skin = "adm";

$l_sql = "SELECT * FROM $table_admshop, $table_admsite, $table_admadm";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$g_kwotarget = '';
if ($adm->doubleframeflag == 1) $g_kwotarget   = 'target=kwo2';

?>

<html>

<head>
<title>links</title>
<META NAME="keywords"    CONTENT="KWO,KerniX WEB OFFICE,admin">
<META NAME="description" CONTENT="BackOffice KerniX WEB OFFICE">

<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">

<META NAME="robots"              CONTENT="NOINDEX,NOFOLLOW">

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<base target="kwo1">
<?php include("$g_skindir/$g_skin.inc"); ?>
</head>

<script language="Javascript">

function formhandler(form)
{
  form.submit();
}

function uploadwindow(str)
 {
   w = window.open("","","toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=600,height=500 ");
   w.location = str;
 }

</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="white">

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" background="/pictures/adm/bg_left.gif">

<tr><td height="10">&nbsp;</td></tr>

<tr>
<td valign="top" align="right">

<?php

include("$g_classpath/admtablinks.php3");

$tab = new AdmTabLinks();
$tab->startTab("Site");
$tab->addRow("/$g_modulespath/homesite/adm/","accueil","Page d'accueil du Back Office du site");
$tab->addRow("/$g_modulespath/site/adm/","pages web","Accès aux pages web du site");
$tab->addRow("/$g_modulespath/traffic/adm/","traffic","Module de visualisation du traffic du site");
$tab->addRow("/$g_modulespath/listmodules/adm/","modules","Accès aux modules du site");
$tab->endTab();

print("<br>");

if ($adm->ecommerceflag == 1)
{
  print("<br>");
  $tab = new AdmTabLinks();
  $tab->startTab("E-commerce");
//  $tab->addRow("/$g_modulespath/homeshop/adm/","accueil - stats","Page d'accueil du Back Office e-commerce");
//  $tab->addRow("/$g_modulespath/site/adm/index.php3?p_idref=4","pages produits","Accès aux pages produits du site");
  $tab->addRow("/$g_modulespath/command/adm/","commandes","Module de gestion des commandes");
  $tab->addRow("/$g_modulespath/client/adm/","clients","Module de gestion des clients");
//  $tab->addRow("/$g_modulespath/affiliate/adm/","affiliation","Module de gestion de l'affiliation");
//  $tab->addRow("/$g_modulespath/supplier/adm/","fournisseur","Module de gestion des fournisseurs");
  $tab->endTab();
}

print("<br>");

if ($p_action == "advanced")
{
  print("<br>");
  $tab = new AdmTabLinks();
  $tab->startTab("Avancé");
  $tab->addRow("/extern/clientadmin.php3","client admin","Page public de gestion par les clients de leurs données sur le site");
  $tab->addRow("/$g_modulespath/property/adm/","type de page","Module de gestion des types de page");
//  $tab->addRow("/$g_modulespath/hashcache/adm/","hash - cache","Module de gestion du cache serveur");
  $tab->addRow("/$g_modulespath/users/adm/","utilisateurs","Module de gestion des utilisateurs du Back Office");
  $tab->addRow("/$g_modulespath/superuser/adm/","superuser","Espace réservé aux administrateurs KerniX");
  $tab->endTab();
}

?>

<br><br>

</td></tr>

<tr><td>

<table align="center" border="0" cellpadding="0" cellspacing="0"> 
<form action="<?=$PHP_SELF?>" target="left">
<tr>
<td align="center">
 <select onChange="formhandler(this.form)" name="p_action" class="selectleft"> 
  <option value="normal">-- m o d e --</option>
  <option value="normal"> &#187; n o r m a l </option>
  <option value="advanced"> &#187; a v a n c é </option>
 </select>
</td>
</tr>
</form>
</table>

</td></tr>

<tr>
 <td align="center">

  <table align="center" border="0" cellpadding="0" cellspacing="0" align="center">
   <tr>
    <td align="center">
     <a href="#" target="left"><img src="/pictures/adm/icon_upload_fr.gif" OnClick="uploadwindow('<?=$g_urlroot?>/_kernix_/modules/files/adm/');" alt="envoi de fichier" border="0" vspace="3"></a>
     </td>
    </tr>
    <tr>
     <td align="center">
     <a href="#" target="left"><img src="/pictures/adm/icon_browse_fr.gif" OnClick="uploadwindow('<?=$g_urlroot?>/_kernix_/modules/site/adm/index.php3?p_siteadmaction=ref_browser');"  alt="parcourir tout le site" border="0" vspace="3"></a>
     </td>
    </tr>
  </table>

 </td>
</tr>

<tr>
 <td align="center" height="65" valign="center">
  <a href="/<?=$g_modulespath?>/about/adm">
   <img src="/pictures/adm/logo.gif" border="0"  name="logo" onMouseOver="javascript:document.logo.src='/pictures/adm/logo_over.gif'" onMouseOut="javascript:document.logo.src='/pictures/adm/logo.gif'" alt="Contacter KerniX" title="Contacter KerniX">
  </a>
  <br>
 </td>
</tr>

</table>

</body>

</html>
