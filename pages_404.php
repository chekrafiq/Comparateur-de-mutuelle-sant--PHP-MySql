<?php 
	include('inc_dyn/gezip.php'); 
	include('inc_dyn/domain_config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Erreur 404 </title>
<?php include_once('inc_meta/meta.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script type="text/javascript" src="js/assu_script.js"></script>
<script type="text/javascript" src="js/form-vahome.js"></script>
<script type="text/javascript" src="js/min.jquery.smartSocialCount.js"></script>

<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</head>

<body class="si_layout">

<div class="container_10 wrapper">
	<?php require_once('inc_file/header.php'); ?>
	<?php require_once('inc_file/inc_menu/menu.php'); ?>
	
</div>
<div class="container_10 wrapper m_t_10">
	<div id="content" class="grid_7">
	<h1>Erreur 404 :</h1>
	<p>une <strong style="color:black">“ Erreur 404 “</strong> est survenue sur Notre site&nbsp;

merci test de nous <strong>contacter</strong>
pour nous permettre de résoudre le
problème dans les plus brefs délais.

( précisez la page posant problème,
celle où vous étiez précédemment
et toute information susceptible
de nous aider ) </p><img alt="page 404" src="images/404.png"/><input onclick="location.href='contact.php'" class="submit f_r" value="Contacter le Webmaster" type="submit"/>
	<p></p><div class="clear"></div></div>
	<div class="grid_3">
		<p></p>
		<?php require_once('inc_file/box_phone.php'); ?>
		<?php require_once('inc_file/box_btn_devis.php'); ?>
		<?php require_once('inc_file/box_bannier.php'); ?>
		
	</div><div class="clearfix"></div>
</div>
			<?php include_once('inc_file/footer.php'); ?>

</body>

</html>
