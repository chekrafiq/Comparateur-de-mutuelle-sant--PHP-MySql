<?php 
 session_start(); 

	include('../inc_dyn/gezip.php');
	include('../config/cnx.php'); 
 	include('../inc_dyn/domain_config.php');
	include('../inc_class/calsses.php'); 

?>
<?php
//recuperation des data sessions
	$clt=unserialize($_SESSION["client"]);
	if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {

    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];
	
	$opt=0;
	$hospi=0;
	$dent=0;



$idDevis=$_GET["idDevis"];
mysql_select_db($database_cnx, $cnx);
$query_rsTarifsFromIdDevis  = "SELECT * FROM devis where NDEVIS=$idDevis";
$rsTarifsFromIdDevis = mysql_query($query_rsTarifsFromIdDevis, $cnx) or die(mysql_error());
$row_rsTarifsFromIdDevis = mysql_fetch_assoc($rsTarifsFromIdDevis);
$clt=null;
do {
  	$age=$row_rsTarifsFromIdDevis['AgeProspet'];
	$sexe=$row_rsTarifsFromIdDevis['sexeProspet'];
	$regime=$row_rsTarifsFromIdDevis['regime'];
	$couple=$row_rsTarifsFromIdDevis['coupleProspet'];
	$cp=$row_rsTarifsFromIdDevis['departement'];
	
	$clt=new Client($row_rsTarifsFromIdDevis['NomProspect'],$row_rsTarifsFromIdDevis['PrenomProspet']
							,$row_rsTarifsFromIdDevis['dateNaissance']
							,$row_rsTarifsFromIdDevis['nbrEnfant'],$row_rsTarifsFromIdDevis['sexeProspet'],$row_rsTarifsFromIdDevis['coupleProspet']
							,$row_rsTarifsFromIdDevis['regime']
							,$row_rsTarifsFromIdDevis['departement'],$row_rsTarifsFromIdDevis['email'],$row_rsTarifsFromIdDevis['tel'],0,0,0,0,date("Y-m-d H:i:s"),0);
	
	if($clt->couple=="couple"){
		$conj=new Conjoint($row_rsTarifsFromIdDevis['nomConjoint'],$row_rsTarifsFromIdDevis['prenomConjoint'],$row_rsTarifsFromIdDevis['dateNaissanceConj']
								,$row_rsTarifsFromIdDevis['sexeConjoint'] 
								,$row_rsTarifsFromIdDevis['regimeConjoint'] );
		$clt->conj=$conj;
		
	}
	else
	
		$clt->conj=NULL;
			
 } while ($row_rsTarifsFromIdDevis = mysql_fetch_assoc($rsTarifsFromIdDevis)); 

$query_rsTarifs = sprintf("SELECT * FROM vw_tarifs 
						  		WHERE	(%d 				between age_min and age_max)
					   			and 	departements 	like 	%s
								and 	nregime		 	in 		(0,%s)
								and 	sexe 			in		('les deux',%s)
								and 	couple 			in		('les deux',%s)
								and 	HOSPITAL		>=		$hospi
								and 	OPTIQUE			>=		$opt
								and 	DENTAIRE		>=		$dent
								and ngamme=18
								",
						  GetSQLValueString($age, "int"),
						  "'%".$cp."%'",
						  GetSQLValueString($regime, "int"),
						  GetSQLValueString($sexe, "text"),
						  GetSQLValueString($couple, "text"));








$rsTarifs = mysql_query($query_rsTarifs, $cnx) or die(mysql_error());
$row_rsTarifs = mysql_fetch_assoc($rsTarifs);

if (!$rsTarifs) {
   echo "Impossible d'ex??cuter la requ??te ($sql) dans la base : " . mysql_error();
   exit;
}

if (mysql_num_rows($rsTarifs) == 0) {
   echo "Aucune ligne trouv??e, rien ?? afficher.";
   exit;
}
$age = $clt->getAge();

$idDevis=$_GET["idDevis"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>SMAM ,New Equilibre sante Moins 65 Ans</title>
<?php include_once('../inc_meta/meta.php'); ?>

<link href="../css/reset.css" rel="stylesheet" type="text/css" />
<link href="../css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="../css/screen.css" rel="stylesheet" type="text/css" />
<link href="../css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="../css/garantie.css" rel="stylesheet" type="text/css" />

<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="../js/assu_script.js" type="text/javascript"></script>
<script src="../js/up.js" type="text/javascript"></script>
<script src="../js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<!-- Light Box -->
<link href="../css/perttyfoto.css" rel="stylesheet" type="text/css" />
<script  src="../js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script type="text/javascript">$(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto();

		});
</script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<!-------------------------->
		<!------- H E A D E R ------>
		<!-------------------------->
	<?php require_once('../inc_file/header.php'); ?>
		<!------ E N D header ------>
		<!-------------------------->
		<!------- M E N U---- ------>
		<!-------------------------->
	<?php require_once('../inc_file/inc_menu/menu.php'); ?>
	<!------ E N D menu --------></div>
<div class="container_10 wrapper m_t_10">
	

	<div id="content" class="grid_10 garantie_t" style="position:relative">
	
		<?php require_once('../inc_file/inc_menu/menu_garantie.php'); ?>

	<!-- Tableau de Garantie -->
	
	<div class="clearfix"></div>
	<p style="margin-bottom:240px"></p>
		<div  class="clr2"></div>
	<img alt="alptis" style="position: absolute; top: 80px; left: 0px" src="../images/smam-244.jpg"/>
	

	
		<!-- box tarif 1 -->
		<?php 
	$telephone=$clt->tel;
	$email=$clt->email;
	$sexe = $clt->couple;
	$nbr_enfant = (int)$clt->nbrEnfant;
	$i=2;
    do {
  		

		$tarif=round($row_rsTarifs['TARIF'],2);
	 
		if($clt->conj)
		{
			$tarifConj=$clt->conj->getTarif($row_rsTarifs['nforumle'],$clt->cp);
			$tarifConj= round($tarifConj,2);
			
		}
		else
		{
			$tarifConj=0;
		}
		
		$tarifEnf=$clt->getTarifEnf($row_rsTarifs['nforumle'],$row_rsTarifs['ncomp']);
		
		$letarif = $tarif+$tarifConj;
		
		$company_id = (int)$row_rsTarifs['ncomp'];
		$gamme_id = (int)$row_rsTarifs['ngamme'];
		$formule_id = (int)$row_rsTarifs['nforumle'];
		$regime_id = (int)$row_rsTarifs['NREGIME'];
		$age = $clt->getAge();
		$age_conj = 0;
		if ($clt->conj) $age_conj = $clt->conj->getAge();
		
		$letarif = $clt->getTarif($company_id, $gamme_id, $formule_id, $sexe, $nbr_enfant, $letarif, $tarifEnf, $regime_id, $age, $age_conj);
   ?>
		<!-- box tarif 1 -->
	<div class="boxtarif boxtarif<?php echo $i ;?>"  >
		
		<a class="autre"  href="../inc_dyn/souscrire-update-table.php?f=<?php echo $row_rsTarifs['NOMFRML'];?>&nf=<?php echo $row_rsTarifs['nforumle'];?>&c=<?php echo $row_rsTarifs['NOMCMP'];?>&nc=<?php echo $row_rsTarifs['ncomp'];?>&t=<?php echo round($letarif,2);?>&tel=<?php echo $telephone ?>&em=<?php echo $email?>&idDevis=<?php echo $idDevis?>"><img alt="" class="auto-style8" src="../images/button-souscrire.jpg" /></a>
		<div class="boxtarifprix">
			<span><?php 
				  echo round($letarif,2);
				  ?></span><br />
			???/Mois<br/><span class="nom"><?php echo htmlentities($row_rsTarifs['NOMFRML']);?></span></div>
			
	</div>
<?php
$i++;
 } while ($row_rsTarifs = mysql_fetch_assoc($rsTarifs)); ?>	


	<table style="width: 100%">
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>GARANTIE DE 
			BASE</strong></td>
			<td class="auto-style3" style="width: 14.25%"><strong>New Equilibre  125</strong></td>
			<td class="auto-style3" style="width: 14.25%"><strong>New Equilibre  150</strong></td>
			<td class="auto-style6" style="width: 14.25%"><strong>New Equilibre  200</strong></td>
		</tr>
	</table>
				<table style="width: 100%">
					<caption>HOSPITALISATION M??DICALE OU CHIRURGICALE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			s??jours</strong><br />
			??TABLISSEMENTS CONVENTIONN??S</td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style6" style="width: 14.25%">Frais r??els</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			s??jours</strong><br />
			??TABLISSEMENTS NON CONVENTIONN??S</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Actes en secteur 
			Hospitalier, honoraires chirurgicaux<br />
			<strong><em>imm??diat</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Chirurgie, Anesth??sie, 
			R??animation<br />
			<strong><em>apr??s 6 mois</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style3" style="width: 14.25%">150%</td>
			<td class="auto-style6" style="width: 14.25%">175%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Chambre particuli??re 
			(Hors ambulatoire)<br />
			<strong><em>imm??diat ( 30 jours maxi )</em></strong><br />
			</td>
			<td class="auto-style3" style="width: 14.25%">-</td>
			<td class="auto-style3" style="width: 14.25%">45???/jour</td>
			<td class="auto-style6" style="width: 14.25%">55???/jour</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Maladie, Chirurgie, 
			Maternit??<br />
			<strong><em>apr??s 6 mois</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">35???/jour<br />
			dur??e illimit??e</td>
			<td class="auto-style3" style="width: 14.25%">55???/jour<br />
			dur??e illimit??e</td>
			<td class="auto-style6" style="width: 14.25%">65???/jour<br />
			dur??e illimit??e</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">R??adaptation 
			fonctionnelle, R????ducation,<br />
			Moyens s??jours, Cures, Convalescence (30 j/an)
			<span style="text-decoration: underline"><em>apr??s 6 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%">35???/jour</td>
			<td class="auto-style3" style="width: 14.25%">45???/jour</td>
			<td class="auto-style6" style="width: 14.25%">55???/jour</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Forfait Journalier 
			Hospitalier<br />
			<strong>M??decine, Chirurgie </strong>
			<span style="text-decoration: underline"><em>imm??diat ( 30 jours 
			maxi )</em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style6" style="width: 14.25%">Frais r??els</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">M??decine, Chirurgie 
			(dur??e illimit??e)<br />
			Psychiatrie et assimil??s (30 jours par an)
			<span style="text-decoration: underline"><em><strong>apr??s 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els</td>
			<td class="auto-style6" style="width: 14.25%">Frais r??els</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">R??adaptation 
			fonctionnelle, R????ducation,<br />
			Moyens s??jours, Cures, Convalescence
			<span style="text-decoration: underline"><em><strong>apr??s 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els<br />
			30 jours maxi</td>
			<td class="auto-style3" style="width: 14.25%">Frais r??els<br />
			60 jours maxi</td>
			<td class="auto-style6" style="width: 14.25%">Frais r??els<br />
			90 jours maxi</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			transport</strong><br />
			si accept??s par le R??gime Obligatoire</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">125%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais 
			d???accompagnement </strong><span style="text-decoration: underline">
			<em>apr??s 6 mois ( 30 jours/an )</em></span></td>
			<td class="auto-style3" style="width: 14.25%">15???/jour</td>
			<td class="auto-style3" style="width: 14.25%">15 ???/jour</td>
			<td class="auto-style6" style="width: 14.25%">15 ???/jour</td>
		</tr>
	</table>
				<p>En cas d???hospitalisation impr??vue, votre GARANTIE ASSISTANCE (*) peut organiser votre transfert en ambulance, la pr??sence d???un proche ?? votre chevet, la garde de vos
animaux domestiques, vous faire b??n??ficier d???une aide ?? domicile, prendre en charge la location d???un t??l??viseur ?? l???h??pital...</p>
				<table style="width: 100%">
					<caption>MALADIE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Honoraires m??dicaux - 
			Consultations - Visites&nbsp; <strong>
			<span style="text-decoration: underline"><em>imm??diat<br />
			</em></span></strong>G??n??ralistes, Sp??cialistes, Professeurs
			<span style="text-decoration: underline"><em><strong>apr??s 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%<br />
			150%</td>
			<td class="auto-style6" style="width: 14.25%">150%<br />
			175%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Actes de 
			sp??cialit??s (ATM)</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Majoration 
			pour frais de d??placement<br />
			Actes de nuit ou le dimanche - Soins d???urgence</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09%; direction: ltr;">
			<strong>Pharmacie</strong> (remboursable par le R??gime Obligatoire)<br />
			M??dicaments toutes vignettes, Hom??opathie</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>M??decines 
			naturelles</strong><br />
			(consultations non rembours??es par le R??gime Obligatoire)<br />
			Ost??opathie, ??tiopathie, Chiropractie, Acupuncture, Hom??opathie, 
			P??dicure<strong> (prise en charge 25??? / consultation / b??n??ficiaire)</strong></td>
			<td class="auto-style3" style="width: 14.25%">25???<br />
			an - b??n??ficiaire</td>
			<td class="auto-style3" style="width: 14.25%">75???<br />
			an - b??n??ficiaire</td>
			<td class="auto-style6" style="width: 14.25%">100 ???<br />
			an - b??n??ficiaire</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Actes de 
			Pr??vention</strong> (Prise en charge des 13 actes rembours??s par le 
			R??gime Obligatoire) :<br />
			Ost??odensitom??trie remboursable, Pr??vention <br />
			buccodentaire, Vaccinations???</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">D??pistage et 
			Pr??vention (actes non rembours??s par le R??gime Obligatoire)<br />
			Forfait par an et par b??n??ficiaire limit?? ?? 50% des d??penses 
			r??alis??es (se reporter aux conditions g??n??rales)</td>
			<td class="auto-style3" style="width: 14.25%">100 ???</td>
			<td class="auto-style3" style="width: 14.25%">100 ???</td>
			<td class="auto-style6" style="width: 14.25%">100 ???</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Auxiliaires 
			M??dicaux</strong><br />
			Orthophonistes, Infirmiers, Kin??sith??rapeutes, Orthoptistes</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Analyses - 
			Actes de Biologie</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Radiologie</strong><br />
			Scanographie, Mammographie, IRM, ??chographie, ??lectrocardiographie, 
			Scintigraphie...</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">125%</td>
		</tr>
	</table>
				<p>En l???absence de votre m??decin traitant, votre GARANTIE ASSISTANCE peut organiser le passage d???un autre m??decin ?? votre domicile. Elle peut aussi vous aider ??
rechercher une infirmi??re ou tout autre intervenant param??dical, et organiser la livraison ?? votre domicile des m??dicaments indispensables ?? votre traitement.</p>
				<table style="width: 100%">
					<caption>DENTAIRE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Proth??ses dentaires et 
			Orthodontie remboursables par le R??gime Obligatoire <strong>?? 
			compter de la date d???effet</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">150%</td>
			<td class="auto-style6" style="width: 14.25%">200%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><table><tr><td>
				AVANTAGE</td><td>2e ann??e</td></tr><tr><td>FID??LIT??</td><td>3e 
					ann??e</td></tr><tr><td>&nbsp;</td><td>4e ann??e</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>125%</td></tr><tr><td>
				150%</td></tr><tr><td>175%</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>175%</td></tr><tr><td>
				200%</td></tr><tr><td>225%</td></tr></table></td>
			<td class="auto-style6" style="width: 14.25%"><table><tr><td>225%</td></tr><tr><td>
				250%</td></tr><tr><td>275%</td></tr></table></td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Plafond 
			dentaire</strong></td>
			<td class="auto-style3" style="width: 14.25%">Aucun</td>
			<td class="auto-style3" style="width: 14.25%">Aucun</td>
			<td class="auto-style6" style="width: 14.25%">1re ann??e 600???<br />
			2e et suivantes 900???</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Soins</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Dentaire non 
			remboursable par le R??gime Obligatoire</strong><br />
			Proth??ses dentaires, Orthodontie, Implantologie, Parodontologie 
			apr??s <span style="text-decoration: underline"><strong><em>(1 an par 
			an et par b??n??ficiaire)</em></strong></span></td>
			<td class="auto-style3" style="width: 14.25%">50???</td>
			<td class="auto-style3" style="width: 14.25%">100???</td>
			<td class="auto-style6" style="width: 14.25%">150???</td>
		</tr>
	</table>
				<table style="width: 100%">
					<caption>OPTIQUE &gt; forfait par an et par b??n??ficiaire</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Montures
			</strong><span style="text-decoration: underline"><em>imm??diat par 
			an et par b??n??ficiaire</em></span></td>
			<td class="auto-style3" style="width: 14.25%">50???</td>
			<td class="auto-style3" style="width: 14.25%">75???</td>
			<td class="auto-style6" style="width: 14.25%">100???</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Verres
			</strong><span style="text-decoration: underline"><em>imm??diat</em></span></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Lentilles</strong>
			<span style="text-decoration: underline"><em>remboursables ou non 
			par le R??gime Obligatoire </em></span><strong>&nbsp;par an et par 
			b??n??ficiaire</strong></td>
			<td class="auto-style3" style="width: 14.25%">+ 50???</td>
			<td class="auto-style3" style="width: 14.25%">+ 100 ???</td>
			<td class="auto-style6" style="width: 14.25%">+ 150 ???</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><table><tr><td>
				AVANTAGE</td><td>2e ann??e</td></tr><tr><td>FID??LIT??</td><td>3e 
					ann??e</td></tr><tr><td>&nbsp;</td><td>4e ann??e</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>75???</td></tr><tr><td>
				100 ???</td></tr><tr><td>125 ???</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>125???</td></tr><tr><td>
				150 ???</td></tr><tr><td>175 ???</td></tr></table></td>
			<td class="auto-style6" style="width: 14.25%"><table><tr><td>175 ???</td></tr><tr><td>
				200???</td></tr><tr><td>225???</td></tr></table></td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Chirurgie 
			corrective ou r??fractive non remboursable<br />
			par le R??gime Obligatoire</strong> (Myopie, Presbytie, 
			Hyperm??tropie) <em>apr??s 6 mois</em></td>
			<td class="auto-style3" style="width: 14.25%">50???</td>
			<td class="auto-style3" style="width: 14.25%">100 ???</td>
			<td class="auto-style6" style="width: 14.25%">150 ???</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Proth??ses et 
			Appareillages</strong><br />
			Petit appareillage et accessoires</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Proth??ses 
			orthop??diques, auditives, capillaires, mammaires cet grand 
			appareillage</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Forfait 
			naissance ou adoption</strong>
			<span style="text-decoration: underline"><em>apr??s 9 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%">50???</td>
			<td class="auto-style3" style="width: 14.25%">&nbsp;</td>
			<td class="auto-style6" style="width: 14.25%">&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09%; height: 56px;"><strong>
			Cures thermales</strong><br />
			Honoraires, Soins, Frais de transport, H??bergement
			<span style="text-decoration: underline"><em>apr??s 6 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%; height: 56px;">100%</td>
			<td class="auto-style3" style="width: 14.25%; height: 56px; font-family: Arial, Helvetica, sans-serif;">
			100%<br />
			+ forfait 50???</td>
			<td class="auto-style6" style="width: 14.25%; height: 56px; font-family: Arial, Helvetica, sans-serif;">
			100%<br />
			+ forfait 100 ???</td>
		</tr>
	</table>
				<table style="width: 100%">
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Garantie ?? 
			Exon??ration de Cotisations ??</strong><br />
			&gt; licenciement ??conomique<br />
			&gt; cessation d???activit?? suite ?? d??p??t de bilan<br />
			&gt; affections de longue dur??e (ALD-30) et les poly pathologies</td>
			<td class="auto-style3" style="width: 57.72%">Prise en charge des 
			cotisations :<br />
			1 000 ??? par ??v??nement et par ann??e</td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">* <strong>Assistance</strong></td>
			<td class="auto-style3" style="width: 57.72%">oui</td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">* <strong>Protection 
			juridique m??dicale</strong></td>
			<td class="auto-style3" style="width: 57.72%"><strong>Maximum 20 
			000??? TTC par litige en France et dans l???U.E<br />
			</strong>en cas de litige pr??sum?? avec un professionnel de sant?? ou 
			un ??tablissement de soins</td>
					</tr>
	</table>
				<table style="width: 100%">
					<caption>GARANTIES OPTIONNELLES **</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Individuelle enfants 
			(scolaire - extrascolaire)</td>
			<td class="auto-style3" style="width: 57.72% ;text-align:left"><table width="100%"><tr><td style="width:80%">
				D??c??s par accident :</td><td style="width:20%">4 000 ???</td></tr><tr><td style="width:80%">
					Invalidit?? permanente par accident (franchise 10%) :</td><td style="width:20%">
					50 000 ???</td></tr><tr><td style="width:80%">Frais de 
					rattrapage scolaire :</td><td style="width:20%">500 ???</td></tr></table></td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Individuelle accident 
			(capital d??c??s par accident)<br />
			<strong>(sans limite d?????ge)</strong></td>
			<td class="auto-style3" style="width: 57.72%;text-align:left"><table width="100%"><tr><td style="width:80%">
				Adh??rent principal</td><td style="width:20%">4 000 ???</td></tr><tr><td style="width:80%">
					Conjoint (inscrit au contrat)</td><td style="width:20%">
					2 000 ???</td></tr><tr><td style="width:80%">Enfant (d??sign?? 
					au contrat)</td><td style="width:20%">1 500 ???</td></tr></table></td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Rapatriement 
			de Corps<br />
			</strong>ouvert ?? toute personne physique domicili??e en France, en 
			Guadeloupe, en Martinique, en Guyane Fran??aise ou sur l???Ile de la 
			R??union et qui souhaite ??tre inhum??e dans son pays d???origine</td>
			<td class="auto-style3" style="width: 57.72% ;text-align:left">&nbsp;<strong>Rapatriement</strong> 
			de corps dans le pays d???origine du lieu du d??c??s jusqu????? l???a??roport&nbsp;&nbsp;&nbsp;&nbsp; international,<br />
			<br />
			<strong>&nbsp;Prise en charge</strong> du transfert de corps 
			jusqu???au lieu d???inhumation ?? concurrence de 800 ???<br />
			<br />
			<strong>&nbsp;Mise ?? disposition</strong> d???un titre de transport 
			pour un membre de la famille en accompagnement du corps<br />
			<br />
&nbsp;<strong>?? la demande</strong> de la famille si le d??c??s a lieu dans le 
			pays d???origine prise en charge des frais fun??raires
			dans la limite de 1 200 ??? TTC.</td>
					</tr>
	</table>

	<h6 class="retour">?? <a href="javascript:;" onclick="ScrollUpToPage()">Revenir 
	vers le haut</a> </h6>


	
	<!-- End Tableau de Garantie -->

	
	</div>
	
	

	<div class="clearfix">
	</div>
</div>
			<!-------------------------->
			<!------- F O O T E R ------>
			<!-------------------------->
			<?php include_once('../inc_file/footer.php'); ?>
			<!------ E N D footer  ----->


</body>

</html>
