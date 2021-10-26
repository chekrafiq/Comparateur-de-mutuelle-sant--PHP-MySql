<?php 
	include('inc_dyn/gezip.php'); 
	include('inc_dyn/domain_config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sinader Newsletter </title>
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
	<h1>Newsletter :</h1>
	<h2>Pour vous tenir au courant des dernières nouveautés !</h2>
		<p>En vous abonnant à notre newsletter, vous recevez mensuellement notre lettre d'actualité qui dresse un panorama des articles ainsi que des communiqués parus dans le presse.</p>
		<p>Elle mentionne aussi toutes les nouveautés mises en ligne dans les différentes rubriques du site ainsi que nos offres promotionnelles.

</p>
<h4 class="al_center p_l_r_100">Inscrivez vous à la newsletter
en saisissant votre adresse email ci-dessous :</h4><p></p>
<form class="al_center"  action="" method=""><input class="box" type="text"/><br/><input type="checkbox"/> je suis intéressé(e) par des offres préférentielles de nos partenaires<br/><input class="submit" type="submit"  value="Inscription"/><p></p>
</form>
	
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('inc_file/box_phone.php'); ?>
		<?php require_once('inc_file/box_btn_devis.php'); ?>
		
	</div><div class="clearfix"></div>
</div>

			<?php include_once('inc_file/footer.php'); ?>

</body>

</html>
