<?php

include("_kernix_/var.inc.php3");

setcookie('ADM','',time()-3600);

?>

<html>

<head>

<META NAME="keywords"    CONTENT="KWO,KerniX WEB OFFICE,admin">
<META NAME="description" CONTENT="BackOffice KerniX WEB OFFICE">

<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">

<META NAME="robots"              CONTENT="NOINDEX,NOFOLLOW">

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">

<base target="_top">

</head>

<body>

<Script language=javascript>
 parent.document.location = "<?php print("$p_urlroot/admin/"); ?>";
</Script>

</body>

</html>
