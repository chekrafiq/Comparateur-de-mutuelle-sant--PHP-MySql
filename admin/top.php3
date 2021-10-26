<?php
include("_kernix_/var.inc.php3");
$g_skin = "adm";

$p_width1 = "width=100%";

if (!eregi("MSIE|gecko",$HTTP_USER_AGENT)) 
{
  $p_width1 = "width=800";
  $p_width2 = "width=2";
}

?>

<html>

<head>
 
<title>top</title>

<base target="_top">

<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">

<META NAME="robots"              CONTENT="NOINDEX,NOFOLLOW">

<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
 
<?php include("$g_skindir/$g_skin.inc"); ?>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="white" color="white">

<table height="50" <?=$p_width1?>
 cellspacing="0" cellpadding="0" border="0" background="/pictures/adm/bg_top.gif" >
 <tr>
 
  <td width="660">
   <img src="/pictures/adm/top_left.gif">
  </td>

  <td align=right <?=$p_width2?> >
   &nbsp;
  </td>

  <td width="138" background="/pictures/adm/bg_top_right.gif" valign="top" align="right">
   <form action="logout.php3" method="post"> 
   <table height="30" align="middle" valign="top" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td valign="bottom">
  <input type="image" value="submit" src="/pictures/adm/logout.gif" alt="quitter / exit">&nbsp;&nbsp;&nbsp;
     </td>
    </tr>
   </table>
   </form>
  </td>

 </tr>
</table>

</body>

</html>


