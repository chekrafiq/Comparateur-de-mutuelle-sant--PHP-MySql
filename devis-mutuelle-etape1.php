<?php 
	include('inc_dyn/gezip.php'); 
	include('inc_dyn/domain_config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Devis MUTUELLE - AssurSanté, mutuelle et complémentaire santé : Devis en ligne - etape 1</title>
<?php include_once('inc_meta/meta.php'); ?>

<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">  google.load("jquery", "1.4.2"); </script>
<script src="js/assu_script.js" type="text/javascript"></script>
<script src="js/form-vahome.js" type="text/javascript"></script>
<script src="js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<?php require_once('inc_file/header.php'); ?>
		<?php require_once('inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div id="content" class="grid_2">
		<?php require_once('inc_file/inc_menu/menu_devis.php'); ?>
		</div>
	<div id="content" class="grid_5">
	<h1>Devis Mutuelle En Ligne :</h1>
	
	<?php require_once('inc_form/t_form_1.php'); ?>
	
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('inc_file/box_phone.php'); ?>
		<?php require_once('inc_file/box_bannier.php'); ?>
		
	</div>
		<div class="clearfix">
	</div>
</div>
			<?php include_once('inc_file/footer.php'); ?>
			</body>

</html>
