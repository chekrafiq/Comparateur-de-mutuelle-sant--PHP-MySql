<?php 
	include('../../inc_dyn/gezip.php'); 
	include('../../inc_dyn/domain_config.php');
	//define('PATCH',"../../"); //patch of css and include file

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Swiss Santé : formules assurance santé de Swisslife, mutuelle et complémentaire santé Swiss Life</title>
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
			<img alt="Swiss Sante" src="http://www.assursante.fr/upload/pictures/sante.jpg" />
			<ul class="color_bl">
				<li><a href="swiss-sante-ma-formule.php" title="Ma Formule">Ma Formule</a></li>
				<li><a href="swiss-sante-les-astucieuses.php" title="Astucieuses">Les Astucieuses </a></li>
				<li class="retour_bl"><a href="#">Retour</a></li>
			</ul>
		</div>
		</div>
	<div id="content" class="grid_5">
		<h1><a href="swiss-sante.php" title="Swiss Sante">Swiss Sante :</a></h1>
		<h2>Pour notre <a title="assurance sante" href="../../assurance-sante.html">assurance sante</a>, nous faisons confiance au spécialiste de la Complémentaire Santé !</h2>
		<h3>Trois formules au choix :</h3>
		<ul style="color: black">
			<li>Assurance Santé Ma Formule</li>
			<li>Assurance Santé Les Astucieuses</li>
			<li>Assurance Santé Génération Vitalité</li>
		</ul>


		<h4>Assurance Santé Ma Formule :</h4><p>		
		Nouveauté SWISS Santé 2010 : la <a href="#" title="complementaire sante"><strong> complementaire sante
		</strong></a>Ma Formule est la nouvelle gamme SWISSLIFE. Une gamme santé pour tous de 0 à 99 ans, entièrement modulable : 7 formules et 4 modules par formule pour plus d'une centaine de combinaisons possibles.</p>
		<h4><span class="liste_bleu"><strong>Assurance santé Les Astucieuses :</strong></span></h4>
		<p>Payez moins cher tout en conservant l'essentiel.
La plupart des assurances santés comportent des services ainsi que des garanties qui ne semblent pas toujours nécessaires...mais pour lesquels vous payez! Avec les astucieuses de 
		<a title="swiss sante" href="#"><strong>swiss sante</strong></a>, vous assurez l'essentiel.</p>
		
		<h4>Assurance santé Génération Vitalité :</h4>
		<p>Payez moins cher tout en conservant l'essentiel et ce quelque soit votre âge ! Avec nos formules Génération Vitalité, bénéficiez de tarifs très compétitifs sans questionnaire de santé et sans limité d'âge pour la S01.</p>
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
