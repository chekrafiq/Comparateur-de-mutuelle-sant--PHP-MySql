<?php 
	include('../../inc_dyn/gezip.php'); 
	include('../../inc_dyn/domain_config.php');
	//define('PATCH',"../../"); //patch of css and include file

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>SwissLife Retraite, assurance retraite </title>
<?php include_once('../../inc_meta/meta.php'); ?>

<link href="../../css/reset.css" rel="stylesheet" type="text/css" />
<link href="../../css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="../../css/screen.css" rel="stylesheet" type="text/css" />
<link href="../../css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="../../css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="../../js/assu_script.js" type="text/javascript"></script>
<script src="../../js/form-vahome.js" type="text/javascript"></script>
<script src="../../js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script src="../../js/jquery.prettyPhoto.js" type="text/javascript"></script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<?php require_once('../../inc_file/header.php'); ?>
		<?php require_once('../../inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div class="grid_2">
		<div id="menu_for_statique">
			<img alt="SwissLife Retraite" src="../../images/retraite.jpg" />
			<ul class="color_ver">
				<li><a title="Garanties" href="gamme/garantie/garantie-swissLife-retraite.php">Garanties</a></li>
				<li><a title="Montants" href="gamme/garantie/montants-swissLife-retraite.php">Montants</a></li>
				<li><a title="Conditions" href="gamme/condition/swissLife-retraite-condition.php">Conditions</a></li>
				<li><a title="Devis" href="gamme/garantie/devis-swissLife-retraite.php">Demande de Devis</a></li>

				<li class="retour_ver"><a href="#">Retour</a></li>
			</ul>
		</div>
		</div>
	<div id="content" class="grid_5">
	<h1>SwissLife Retraite :</h1>
	<h2>Réussissez votre retraite tout en protégeant vos proches…
</h2>
	<h3>Vos atouts gagnants :</h3>
		<p>Vous le savez : les régimes de retraite obligatoires sont insuffisants pour vous assurer demain un niveau de vie identique à celui que vous avez aujourd’hui.</p>
		<p>Pour vous préparer une retraite paisible tout en protégeant votre famille, découvrez 
		<strong>SwissLife Retraite</strong> et anticipez votre avenir et celui de vos proches.</p>
		<h3>Vos atouts gagnants :</h3>
		<ul style="color:black"><li>Votre retraite garantie à la souscription (taux de rente garanti).</li><li>
			Un large choix de versements.</li>
			<li>Une fiscalité attrayante (fiscalité assurance vie)</li>
			<li>De hautes performances assurées : 5% nets distribuées en 2004.</li></ul>
		<div class="message_box_wrap notice">Pour plus d'informations concernant ce produit, merci de nous adresse votre demande par mail à l'adresse suivante : 
		<strong style="color:red"><a href="mailto:contact@assursante.fr"></a>contact@assursante.fr</strong> ou par tél. au 
		<strong style="color:green">03 44 48 21 21</strong> .</div>
	
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('../../inc_file/box_phone.php'); ?>
		<?php require_once('../../inc_file/box_help.php'); ?>
		<?php require_once('../../inc_file/box_bannier.php'); ?>
		
	</div>
		<div class="clear">
	</div>
</div>
			<?php include_once('../../inc_file/footer.php'); ?>
			</body>

</html>
