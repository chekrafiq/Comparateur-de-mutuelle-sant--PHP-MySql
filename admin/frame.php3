<?php

include("_kernix_/tables.inc.php3");

$l_sql = "SELECT * FROM $table_admshop, $table_admsite, $table_admadm";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$g_kwotarget = '';
if ($adm->doubleframeflag == 1) $g_kwotarget   = 'target=kwo2';

?>

<html>

<head>
<title> KERNIX WEB OFFICE Admin - <?php print($g_sitename); ?></title>


<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">

<META NAME="robots"              CONTENT="NOINDEX,NOFOLLOW">

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
</head>

<frameset rows="50,*" border=0>

  <frame name="top" scrolling="no" noresize target="sommaire" src="top.php3" border="0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <frameset cols="120,*" border="0">
    <frame name="left" target="principal" src="left.php3" border="0">
<?php if (!empty($g_kwotarget)): ?>
    <frameset cols="580,*" border="0">
     <frame name="kwo1" src="/_kernix_/modules/homesite/adm/index.php3" border="0">
     <frame name="kwo2" src="/_kernix_/modules/traffic/adm/index.php3" border="0">
    </frameset>
<?php else: ?>
    <frame name="kwo1" src="/_kernix_/modules/homesite/adm/index.php3?<?php print("p_newlog=$p_newlog&p_login=$p_login&p_password=$p_password"); ?>" border="0">    
<?php endif; ?>

  </frameset>

  <noframes>
  <body>

  <p>Cette page utilise des cadres, mais votre navigateur ne les prend pas en
  charge.</p>

  </body>
  </noframes>

</frameset>

</html>
