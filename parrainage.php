<?php 
	include('inc_dyn/gezip.php'); 
	include('inc_dyn/domain_config.php');
	//define('PATCH',"../../"); //patch of css and include file

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Parrainage : Avec AssurSant√©, vous parrainez et gagnez du CASH </title>
<?php include_once('inc_meta/meta.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="js/assu_script.js" type="text/javascript"></script>
<script src="js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>


</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<?php require_once('inc_file/header.php'); ?>
		<?php require_once('inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div id="content" class="grid_2">
		<div id="menu_for_statique">
			<img alt="Garantie des Accidents " src="images/santes.jpg" />
			<ul class="color_bl">
				<li class="retour_bl"><a href="#">Retour</a></li>
			</ul>
		</div>
		</div>
	<div id="content" class="grid_5">
	<h1><a href="parrainage.php" title="Parrainage">Parrainage :</a></h1>
	<h2>Avec AssurSant√©, vous parrainez et gagnez du CASH !</h2>
	<p>Dans la vie, vous √™tes entour√©s de votre famille, d'amis, de copains, de coll√®gues qui cherchent une compl√©mentaire sant√© fiable et performante.</p>
		<p>Recommandez-nous aupr√®s de vos proches, ils ne seront pas d√©√ßus !</p>
		<h3>A Filleuls satisfaits, Parrain combl√© !</h3>
		<p>D√®s que votre filleul aura souscrit son contrat Compl√©mentaire Sant√© aupr√®s d' AssurSant√©, vous recevrez des ch√®ques de :</p>
		<ul style="color:blue"><li><strong>1 Filleul = 1 mois offert</strong></li>
			<li><strong>2 Filleuls = 2 mois offerts</strong></li>
			<li><strong>3 Filleuls = 3 mois offerts</strong></li>
		</ul>
		<p>Pour permettre √† votre ou vos filleul(s) de b√©n√©ficiez de tous nos avantages, remplissez le formulaire suivant : </p>
		<p><strong>Nous restons √† votre enti√®re disposition par mail ou par t√©l√©phone pour de plus amples informations.

N'h√©sitez pas √† consulter notre site www.assursante.fr ou nous contacter par :</strong></p>
<ul><li style="color:green">T√©l√©phone : <strong>03 44 48 21 21</strong></li><li style="color:red">Email : <strong>contact@assursante.fr</strong></li>
<li style="color:black"><strong>L‚Äô√©quipe AssurSant√© se fera un plaisir de vous r√©pondre !</strong></li>
</ul>
	
	<form method="post" action="control/ctr_parrainage.php" onsubmit="return validateFormOnSubmit(this)">
	<fieldset class="p_l_r_100">
	<input value="Votre Nom & votre Pr√©nom (vous-m√™me)" onblur="if(this.value=='') this.value='Votre Nom & votre Pr√©nom (vous-m√™me)'" onfocus="if(this.value =='Votre Nom & votre Pr√©nom (vous-m√™me)' ) this.value=''" id="NOMPRENOMPARRAIN" name="NOMPRENOMPARRAIN" class="box w_250" type="text"/><input value="Adresse du Parrain (vous-m√™me)" onblur="if(this.value=='') this.value='Adresse du Parrain (vous-m√™me)'" onfocus="if(this.value =='Adresse du Parrain (vous-m√™me)' ) this.value=''" id="ADRESSEPARRAIN" name="ADRESSEPARRAIN" class="box w_250" type="text"/><input  value="Filleul 1 : Nom et Pr√©nom" onblur="if(this.value=='') this.value='Filleul 1 : Nom et Pr√©nom'" onfocus="if(this.value =='Filleul 1 : Nom et Pr√©nom' ) this.value=''" id="NOMPRENOM_FILLEUL1" name="NOMPRENOM_FILLEUL1" class="box w_250" type="text"/>
	<input id="ADRESSE_FILLEUL1" name="ADRESSE_FILLEUL1" class="box w_250" type="text" value="Filleul 1 : Adresse" onblur="if(this.value=='') this.value='Filleul 1 : Adresse'" onfocus="if(this.value =='Filleul 1 : Adresse' ) this.value=''" />
	<input id="TEL_FILLEUL1" name="TEL_FILLEUL1" class="box w_250" type="text" value="Filleul 1 : N¬į de T√©l√©phone" onblur="if(this.value=='') this.value='Filleul 1 : N¬į de T√©l√©phone'" onfocus="if(this.value =='Filleul 1 : N¬į de T√©l√©phone' ) this.value=''" />
	<input id="NAISSANCE_FILLEUL1" name="NAISSANCE_FILLEUL1" class="box w_250" type="text"  value="Filleul 1 : Date de naissance" onblur="if(this.value=='') this.value='Filleul 1 : Date de naissance'" onfocus="if(this.value =='Filleul 1 : Date de naissance' ) this.value=''" /><input  value="Filleul 2 : Nom et Pr√©nom" onblur="if(this.value=='') this.value='Filleul 2 : Nom et Pr√©nom'" onfocus="if(this.value =='Filleul 2 : Nom et Pr√©nom' ) this.value=''" id="NOMPRENOM_FILLEUL2" name="NOMPRENOM_FILLEUL2" class="box w_250" type="text"/>
	<input id="ADRESSE_FILLEUL2" name="ADRESSE_FILLEUL2" class="box w_250" type="text" value="Filleul 2 : Adresse" onblur="if(this.value=='') this.value='Filleul 2 : Adresse'" onfocus="if(this.value =='Filleul 2 : Adresse' ) this.value=''" />
	<input id="TEL_FILLEUL2" name="TEL_FILLEUL2" class="box w_250" type="text" value="Filleul 2 : N¬į de T√©l√©phone" onblur="if(this.value=='') this.value='Filleul 2 : N¬į de T√©l√©phone'" onfocus="if(this.value =='Filleul 2 : N¬į de T√©l√©phone' ) this.value=''" />
	<input id="NAISSANCE_FILLEUL2" name="NAISSANCE_FILLEUL2" class="box w_250" type="text"  value="Filleul 2 : Date de naissance" onblur="if(this.value=='') this.value='Filleul 2 : Date de naissance'" onfocus="if(this.value =='Filleul 2 : Date de naissance' ) this.value=''" />
	<input  value="Filleul 3 : Nom et Pr√©nom" onblur="if(this.value=='') this.value='Filleul 3 : Nom et Pr√©nom'" onfocus="if(this.value =='Filleul 3 : Nom et Pr√©nom' ) this.value=''" id="NOMPRENOM_FILLEUL3" name="NOMPRENOM_FILLEUL3" class="box w_250" type="text"/>
	<input id="ADRESSE_FILLEUL3" name="ADRESSE_FILLEUL3" class="box w_250" type="text" value="Filleul 3 : Adresse" onblur="if(this.value=='') this.value='Filleul 3 : Adresse'" onfocus="if(this.value =='Filleul 3 : Adresse' ) this.value=''" />
	<input id="TEL_FILLEUL3" name="TEL_FILLEUL3" class="box w_250" type="text" value="Filleul 3 : N¬į de T√©l√©phone" onblur="if(this.value=='') this.value='Filleul 3 : N¬į de T√©l√©phone'" onfocus="if(this.value =='Filleul 3 : N¬į de T√©l√©phone' ) this.value=''" />
	<input id="NAISSANCE_FILLEUL3" name="NAISSANCE_FILLEUL3" class="box w_250" type="text"  value="Filleul 3 : Date de naissance" onblur="if(this.value=='') this.value='Filleul 3 : Date de naissance'" onfocus="if(this.value =='Filleul 3 : Date de naissance' ) this.value=''" />

	<div class="clearfix"><input class="submit" type="submit" value="Envoyer"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="submit" type="reset" value="Annuler "/></div></fieldset>
	
	</form>

	<p></p>
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('inc_file/box_help.php'); ?>
		<?php require_once('inc_file/box_btn_devis.php'); ?>
		<?php require_once('inc_file/box_bannier.php'); ?>

	</div>
		<div class="clear">
	</div>
</div>
			<?php include_once('inc_file/footer.php'); ?>
			<div style="text-align:center"><a href="http://www.frcasinobonus.com/casinos-rtg.html" target="_blank">rtg super casino</a>

</div>
</body>

</html>
