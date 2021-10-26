<HTML>

<HEAD>

<TITLE> <?=$g_title?> </TITLE>

<META NAME="description" CONTENT="<?php print(strtr($ref->description,"\r\n","  ")); ?>">
<META NAME="keywords"    CONTENT="<?="$ref->keywords $g_keywords"?>">

<META HTTP-EQUIV="Content-Type" content="text/html; charset=<?=$adm->charset?>">

<META NAME="soft"                CONTENT="KWO - KerniX WEB OFFICE - ultimate ecommerce-portal solution - http://www.kernix.com">
<META NAME="htdig-keywords"      CONTENT="<?=$ref->keywords?>">
<META NAME="GOOGLEBOT"           CONTENT="NOARCHIVE">
<?php if (isset($p_za)): ?>
<META NAME="robots"              CONTENT="noindex,nofollow">
<META HTTP-EQUIV="Expires"       CONTENT="0">
<META HTTP-EQUIV="Pragma"        CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<META HTTP-EQUIV="Refresh"       CONTENT="14400;URL=/">
<?php elseif ($ref->indexflag == 1): ?>
<META NAME="robots"              CONTENT="index,follow">
<?php else: ?>
<META NAME="robots"              CONTENT="noindex,follow">
<?php endif; ?>


<?php include("$g_skindir/$g_skin.inc"); ?>

<script type='text/javascript' src='<?=$g_jspath?>/kernix.js'></script>
<script type='text/javascript' src='<?=$g_jspath?>/CalendarPopup.js'></script>
<script type='text/javascript' src='<?=$g_jspath?>/backtothehtml.js'></script>

<?=$basetarget?>

</HEAD>

<?php
//if ($g_robotflag == true)
generate_comment($l_month);
?>

