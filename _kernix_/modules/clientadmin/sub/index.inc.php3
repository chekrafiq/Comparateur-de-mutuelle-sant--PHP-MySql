<?php

$g_skin= "clientadmin";

$table_admsite   = "adm_site";
$table_admshop   = "adm_shop";
$table_affiliate = "affiliate";
$table_visitor   = "visitor";
$table_client    = "client";
$table_egroup    = "egroup";
$table_email     = "email";
$table_zone      = "port_zone";

$l_sql = "SELECT * FROM $table_admsite, $table_admshop";
$c_db->query($l_sql);
$adm = $c_db->object_result();

function show_white_hr()
{
  print("<img src=/pictures/clientadmin/client_admin_line.gif>");
}

function show_ca_response($response)
{
  print("<table width=60% border=1>");
  print("<tr><td class=response align=center valign=center height=40>$response</td>");
  print("</table><br>");
  show_white_hr();
  return(1);
}

function show_ca_back()
{
  $l_backlabel = "-- retour --";
  print("<form><input type=\"button\" name=\"retour\" Onclick=\"history.back()\" value=\"$l_backlabel\" class=\"button\"></form>");
}

include("$g_classpath/validator.php3");
if (isset($COOKIE))
{
  include("$g_modulespath/cookie/sub/cookie.inc.php3");
}

?>

<html>

<head>
 <title>KWO Client Admin - <?php print("$g_sitename"); ?></title>
 <?php include("$g_skindir/$g_skin.inc"); ?>

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Refresh"       CONTENT="14400;URL=/extern/clientadmin.php3">

</head>

<body>

<br>

<center>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="538">
 <tr>
  <td align="center" valign="center" height="61"><a href="<?php print("$PHP_SELF"); ?>" title="Client Admin Home"><img src="/pictures/clientadmin/client_admin_top.gif" border="0"></a></td>
 </tr>
 <tr>
  <td class="middle" height="300">
   <br><table width="90%" align="center" cellspacing="0" cellpadding="0"><tr><td class="main" align="center">
    <?php include("$g_modulespath/clientadmin/sub/main.inc.php3"); ?>
   </td></tr></table>
  </td>
 </tr>
 <tr>
  <td class="main" align="center" valign="bottom">
   <a href="<?php print("$g_urlroot"); ?>">site <i><?php print("$g_sitename"); ?></i></a> |
   <a href="<?php print("$g_clientadminpage"); ?>">KerniX Client Admin</a>
   <br><br>
  </td>
 </tr>
 <tr>
  <td height="68" valign="bottom" align="center"><a href="http://www.kernix.com/kwo" target="_blank"><img src="/pictures/clientadmin/client_admin_bottom.gif" border="0"></a></td>
 </tr>
</table>

<br><br>
<img src="/pictures/clientadmin/client_admin_on_line.gif" border="0">

</center>

</body>
</html>

