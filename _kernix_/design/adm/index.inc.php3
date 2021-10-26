<body leftmargin="5" topmargin="0" marginwidth="0" marginheight="0">
<?php 
// include("$g_modulespath/include/sub/adm_hotkeys.inc.php3"); 
?>

<table width="100%" height="100%" align="center" border="0">
 <tr>
  <td class="main" valign="top" align="center">

<?php

if (!empty($ADM))
{
  $c_adm      = new Cookie("ADM",$ADM);
  $l_login    = urldecode($c_adm->search("login"));
  $l_password = urldecode($c_adm->search("password"));
  $g_power    = $c_adm->search("power");
  $l_sql      = "SELECT * FROM $table_users WHERE login = '$l_login' AND backofficeflag = '1'";
  $c_db->query($l_sql);
  $g_admdatas  = $c_db->object_result();
  $l_login1    = $g_admdatas->login;
  $l_password1 = $g_admdatas->password;
  if (($l_login != $l_login1) || ($l_password != $l_password1))  
    die("security problem [identity] : access denied (IP logged) <$SERVER_NAME>");
  if ($SERVER_NAME != $g_domain)
    die("security problem [domain] : access denied (IP logged) <$SERVER_NAME>");
}
else
{
  die("security problem [identity 2] : access denied (IP logged) <$SERVER_NAME>");
}

$l_lastsession = urldecode($c_adm->search("lastsession"));
$l_time        = $c_adm->search("time");
$l_timenow     = time();
$l_timediff    = $l_timenow - $l_time;

//-- max session : 6 hours
if ($l_timediff > (6 * 3600))
{
  print("error : il faut vous reconnecter.");
  print("<br><a href=/admin/logout.php3 target=_top>cliquez ici</a>");
  return 0;
}

$l_admcaspart = '';
if ($p_siteadmaction == "ref_browser") $l_admcaspart = "?p_siteadmaction=ref_browser"; 

?>

<table width="100%">
 <tr>
  <td class="moduletitle" height="98%">
    &nbsp;&nbsp;&nbsp; <?=$g_title?>
   </td>
   <td class="main" valign="top" align="right">
    <img src="/pictures/adm/help-home-button.gif" width="168" height="24" usemap="#Map" border="0"> 
    <map name="Map">
     <area shape="rect" coords="51,1,70,22" href="<?php print($PHP_SELF.$l_admcaspart); ?>" title="<?=$ln['home']?>">
     <area shape="rect" coords="79,4,97,19" href="<?php print($PHP_SELF.$l_admcaspart); ?>" title="<?=$ln['help']?>">
     <area shape="rect" coords="107,4,122,20" href="<?php if ($module->code) print("/$g_modulespath/postit/adm/index.php3?p_module=$module->code"); else print($PHP_SELF.$l_admcaspart); ?>" title="<?=$ln['notes']?>">
    </map>
   </td>
  </tr>
 </table>
 <br>
<a name="TOP"></a>
<?php
show_hr();
print("<br>");
include("main.inc.php3");
show_hr();
?>
  </td>
 </tr>
 <tr>
  <td class="copyright" align="center" height="2%">

<small><a href="#TOP">haut de page </a> <img src="/pictures/adm/point.gif" border="0">
<b>KWO</b> &copy; copyright <b>KERNIX</b> <?=$l_year?> <img src="/pictures/adm/point.gif" border="0">
<a href="<?php print($PHP_SELF.$l_admcaspart); ?>">accueil</a></small>

<?php
//print("<br>$ADM<br>");
?>

   </td>
 </tr>
</table>
</body>
</html>
