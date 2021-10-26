<HTML>

<HEAD>

<TITLE> <?php print("$g_sitename : $g_title"); ?> </TITLE>

<META NAME="keywords"    CONTENT="KWO,KerniX WEB OFFICE,admin">
<META NAME="description" CONTENT="BackOffice KerniX WEB OFFICE">

<META NAME="publisher"   CONTENT="KERNIX - http://www.kernix.com - online software provider">
<META NAME="generator"   CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution">

<META NAME="robots"      CONTENT="NOINDEX,NOFOLLOW">

<?php

/*<META HTTP-EQUIV="Expires"       CONTENT="<?php print(gmdate("D, d M Y H:i:s",time()+600)); ?> GMT"> */
//<META HTTP-EQUIV="Expires"       CONTENT="-1">
//<META HTTP-EQUIV="Expires"       CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
//<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
//<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate, max_age=0">

if ($adm->ln == 'jp')
{
  echo "<META HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=shift_jis\">";
}

?>
<META HTTP-EQUIV="Refresh"       CONTENT="14400;URL=/admin/logout.php3">

<?php include("$g_skindir/$g_skin.inc"); ?>

<?=$basetarget?>

</HEAD>
