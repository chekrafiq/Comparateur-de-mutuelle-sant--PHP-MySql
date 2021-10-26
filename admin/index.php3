<?php

include("_kernix_/var.inc.php3");

//if (eregi("en",$_SERVER['HTTP_ACCEPT_LANGUAGE'])) $l_lang = '_en';

//setcookie("ADM","",time()-3600);

$table_users = "users";

if ((($REQUEST_METHOD != "POST") || ($SERVER_NAME != $g_domain)) && isset($_POST['p_login']))
{
  $l_str = "Location: $g_urladm";
  header($l_str);
  return 0;
}

if (isset($_POST['p_login']))
{
  $l_sql = "SELECT * FROM $table_users WHERE login = '" . $_POST['p_login'] . "' AND backofficeflag = '1'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {	  
    $l_user = $c_db->object_result();
    if ($p_password == $l_user->password)
    {
      $p_newlog = "yes";
      //include("$g_modulespath/cookie/sub/adm.inc.php3");
      include("frame.php3");
      return 1;
    }
    else
    {
      $l_str = "Location: $g_urladm";
      header($l_str);
      return 0;
    }
  }
  else
  {
    $l_str = "Location: $g_urladm";
    header($l_str);
    return 0;
  }
}

$g_skin = "adm";

?>

<html>

<head>
<title> - Kernix WEB OFFICE Adm - <?=$g_sitename?> </title>

<META NAME="keywords"    CONTENT="KWO,KerniX WEB OFFICE,admin">
<META NAME="description" CONTENT="BackOffice KerniX WEB OFFICE">

<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">

<META NAME="robots"              CONTENT="NOINDEX,NOFOLLOW">

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Refresh"       CONTENT="14400;URL=/">

<?php include("$g_skindir/$g_skin.inc"); ?>

</head>

<body bgcolor="white">
<br><br>

<form action="<?=$PHP_SELF?>" method="POST" name="login">
<input type="hidden" name="p_newlog" value="yes">

<table background="/pictures/adm/login_window.gif" border="0" width="400" height="250" align="center">

 <tr>
  <td align="center">
   <br><br><br>
   
    <table align="center">
     <tr>
      <td align="right" class="color2">
<?php

if ($l_lang == '_en') print('login');
else print('identifiant');

?> &nbsp;
      </td>
      <td class="color2">
       <input type="text" name="p_login" class="text" autocomplete="off">
      </td>
     </tr>
     <tr>
      <td align="right" class="color2">
<?php

if ($l_lang == '_en') print('password');
else print('mot de passe');

?> &nbsp;
      </td>
      <td class="color2">
       <input type="password" name="p_password" class="text" autocomplete="off">
      </td>
     </tr>
     <tr>
      <td colspan="2" align="center" class="color2">
       <br>
       <input type="submit" value="connexion - <?=$g_sitename?> -" class="button"> 
      </td> 
     </tr>
    </table>

  </td>
 </tr>

</table>
</form>

<center>
<p class="copyright">&copy; copyright KerniX Software</a>
<br><small>http://www.kernix.com</small>
<br><small><?php if (isset($ADM)) print(" . "); ?></small>
</p>
</center>

<script language="JavaScript">
<!--
document.login.p_login.focus();
// -->
</script>

</body>
</html>
