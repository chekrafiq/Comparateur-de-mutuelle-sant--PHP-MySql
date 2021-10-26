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
   echo "Impossible d'exécuter la requête ($sql) dans la base : " . mysql_error();
   exit;
}

if (mysql_num_rows($rsTarifs) == 0) {
   echo "Aucune ligne trouvée, rien à afficher.";
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
			€/Mois<br/><span class="nom"><?php echo htmlentities($row_rsTarifs['NOMFRML']);?></span></div>
			
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
					<caption>HOSPITALISATION MÉDICALE OU CHIRURGICALE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			séjours</strong><br />
			ÉTABLISSEMENTS CONVENTIONNÉS</td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style6" style="width: 14.25%">Frais réels</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			séjours</strong><br />
			ÉTABLISSEMENTS NON CONVENTIONNÉS</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Actes en secteur 
			Hospitalier, honoraires chirurgicaux<br />
			<strong><em>immédiat</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Chirurgie, Anesthésie, 
			Réanimation<br />
			<strong><em>après 6 mois</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style3" style="width: 14.25%">150%</td>
			<td class="auto-style6" style="width: 14.25%">175%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Chambre particulière 
			(Hors ambulatoire)<br />
			<strong><em>immédiat ( 30 jours maxi )</em></strong><br />
			</td>
			<td class="auto-style3" style="width: 14.25%">-</td>
			<td class="auto-style3" style="width: 14.25%">45€/jour</td>
			<td class="auto-style6" style="width: 14.25%">55€/jour</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Maladie, Chirurgie, 
			Maternité<br />
			<strong><em>après 6 mois</em></strong></td>
			<td class="auto-style3" style="width: 14.25%">35€/jour<br />
			durée illimitée</td>
			<td class="auto-style3" style="width: 14.25%">55€/jour<br />
			durée illimitée</td>
			<td class="auto-style6" style="width: 14.25%">65€/jour<br />
			durée illimitée</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Réadaptation 
			fonctionnelle, Rééducation,<br />
			Moyens séjours, Cures, Convalescence (30 j/an)
			<span style="text-decoration: underline"><em>après 6 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%">35€/jour</td>
			<td class="auto-style3" style="width: 14.25%">45€/jour</td>
			<td class="auto-style6" style="width: 14.25%">55€/jour</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Forfait Journalier 
			Hospitalier<br />
			<strong>Médecine, Chirurgie </strong>
			<span style="text-decoration: underline"><em>immédiat ( 30 jours 
			maxi )</em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style6" style="width: 14.25%">Frais réels</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Médecine, Chirurgie 
			(durée illimitée)<br />
			Psychiatrie et assimilés (30 jours par an)
			<span style="text-decoration: underline"><em><strong>après 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style3" style="width: 14.25%">Frais réels</td>
			<td class="auto-style6" style="width: 14.25%">Frais réels</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Réadaptation 
			fonctionnelle, Rééducation,<br />
			Moyens séjours, Cures, Convalescence
			<span style="text-decoration: underline"><em><strong>après 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">Frais réels<br />
			30 jours maxi</td>
			<td class="auto-style3" style="width: 14.25%">Frais réels<br />
			60 jours maxi</td>
			<td class="auto-style6" style="width: 14.25%">Frais réels<br />
			90 jours maxi</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais de 
			transport</strong><br />
			si acceptés par le Régime Obligatoire</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">125%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Frais 
			d’accompagnement </strong><span style="text-decoration: underline">
			<em>après 6 mois ( 30 jours/an )</em></span></td>
			<td class="auto-style3" style="width: 14.25%">15€/jour</td>
			<td class="auto-style3" style="width: 14.25%">15 €/jour</td>
			<td class="auto-style6" style="width: 14.25%">15 €/jour</td>
		</tr>
	</table>
				<p>En cas d’hospitalisation imprévue, votre GARANTIE ASSISTANCE (*) peut organiser votre transfert en ambulance, la présence d’un proche à votre chevet, la garde de vos
animaux domestiques, vous faire bénéficier d’une aide à domicile, prendre en charge la location d’un téléviseur à l’hôpital...</p>
				<table style="width: 100%">
					<caption>MALADIE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Honoraires médicaux - 
			Consultations - Visites&nbsp; <strong>
			<span style="text-decoration: underline"><em>immédiat<br />
			</em></span></strong>Généralistes, Spécialistes, Professeurs
			<span style="text-decoration: underline"><em><strong>après 6 mois</strong></em></span></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%<br />
			150%</td>
			<td class="auto-style6" style="width: 14.25%">150%<br />
			175%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Actes de 
			spécialités (ATM)</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Majoration 
			pour frais de déplacement<br />
			Actes de nuit ou le dimanche - Soins d’urgence</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09%; direction: ltr;">
			<strong>Pharmacie</strong> (remboursable par le Régime Obligatoire)<br />
			Médicaments toutes vignettes, Homéopathie</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Médecines 
			naturelles</strong><br />
			(consultations non remboursées par le Régime Obligatoire)<br />
			Ostéopathie, Étiopathie, Chiropractie, Acupuncture, Homéopathie, 
			Pédicure<strong> (prise en charge 25€ / consultation / bénéficiaire)</strong></td>
			<td class="auto-style3" style="width: 14.25%">25€<br />
			an - bénéficiaire</td>
			<td class="auto-style3" style="width: 14.25%">75€<br />
			an - bénéficiaire</td>
			<td class="auto-style6" style="width: 14.25%">100 €<br />
			an - bénéficiaire</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Actes de 
			Prévention</strong> (Prise en charge des 13 actes remboursés par le 
			Régime Obligatoire) :<br />
			Ostéodensitométrie remboursable, Prévention <br />
			buccodentaire, Vaccinations…</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Dépistage et 
			Prévention (actes non remboursés par le Régime Obligatoire)<br />
			Forfait par an et par bénéficiaire limité à 50% des dépenses 
			réalisées (se reporter aux conditions générales)</td>
			<td class="auto-style3" style="width: 14.25%">100 €</td>
			<td class="auto-style3" style="width: 14.25%">100 €</td>
			<td class="auto-style6" style="width: 14.25%">100 €</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Auxiliaires 
			Médicaux</strong><br />
			Orthophonistes, Infirmiers, Kinésithérapeutes, Orthoptistes</td>
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
			Scanographie, Mammographie, IRM, Échographie, Électrocardiographie, 
			Scintigraphie...</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">125%</td>
		</tr>
	</table>
				<p>En l’absence de votre médecin traitant, votre GARANTIE ASSISTANCE peut organiser le passage d’un autre médecin à votre domicile. Elle peut aussi vous aider à
rechercher une infirmière ou tout autre intervenant paramédical, et organiser la livraison à votre domicile des médicaments indispensables à votre traitement.</p>
				<table style="width: 100%">
					<caption>DENTAIRE</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Prothèses dentaires et 
			Orthodontie remboursables par le Régime Obligatoire <strong>À 
			compter de la date d’effet</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">150%</td>
			<td class="auto-style6" style="width: 14.25%">200%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><table><tr><td>
				AVANTAGE</td><td>2e année</td></tr><tr><td>FIDÉLITÉ</td><td>3e 
					année</td></tr><tr><td>&nbsp;</td><td>4e année</td></tr></table></td>
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
			<td class="auto-style6" style="width: 14.25%">1re année 600€<br />
			2e et suivantes 900€</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Soins</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Dentaire non 
			remboursable par le Régime Obligatoire</strong><br />
			Prothèses dentaires, Orthodontie, Implantologie, Parodontologie 
			après <span style="text-decoration: underline"><strong><em>(1 an par 
			an et par bénéficiaire)</em></strong></span></td>
			<td class="auto-style3" style="width: 14.25%">50€</td>
			<td class="auto-style3" style="width: 14.25%">100€</td>
			<td class="auto-style6" style="width: 14.25%">150€</td>
		</tr>
	</table>
				<table style="width: 100%">
					<caption>OPTIQUE &gt; forfait par an et par bénéficiaire</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Montures
			</strong><span style="text-decoration: underline"><em>immédiat par 
			an et par bénéficiaire</em></span></td>
			<td class="auto-style3" style="width: 14.25%">50€</td>
			<td class="auto-style3" style="width: 14.25%">75€</td>
			<td class="auto-style6" style="width: 14.25%">100€</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Verres
			</strong><span style="text-decoration: underline"><em>immédiat</em></span></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Lentilles</strong>
			<span style="text-decoration: underline"><em>remboursables ou non 
			par le Régime Obligatoire </em></span><strong>&nbsp;par an et par 
			bénéficiaire</strong></td>
			<td class="auto-style3" style="width: 14.25%">+ 50€</td>
			<td class="auto-style3" style="width: 14.25%">+ 100 €</td>
			<td class="auto-style6" style="width: 14.25%">+ 150 €</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><table><tr><td>
				AVANTAGE</td><td>2e année</td></tr><tr><td>FIDÉLITÉ</td><td>3e 
					année</td></tr><tr><td>&nbsp;</td><td>4e année</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>75€</td></tr><tr><td>
				100 €</td></tr><tr><td>125 €</td></tr></table></td>
			<td class="auto-style3" style="width: 14.25%"><table><tr><td>125€</td></tr><tr><td>
				150 €</td></tr><tr><td>175 €</td></tr></table></td>
			<td class="auto-style6" style="width: 14.25%"><table><tr><td>175 €</td></tr><tr><td>
				200€</td></tr><tr><td>225€</td></tr></table></td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Chirurgie 
			corrective ou réfractive non remboursable<br />
			par le Régime Obligatoire</strong> (Myopie, Presbytie, 
			Hypermétropie) <em>après 6 mois</em></td>
			<td class="auto-style3" style="width: 14.25%">50€</td>
			<td class="auto-style3" style="width: 14.25%">100 €</td>
			<td class="auto-style6" style="width: 14.25%">150 €</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Prothèses et 
			Appareillages</strong><br />
			Petit appareillage et accessoires</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style6" style="width: 14.25%">100%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Prothèses 
			orthopédiques, auditives, capillaires, mammaires cet grand 
			appareillage</strong></td>
			<td class="auto-style3" style="width: 14.25%">100%</td>
			<td class="auto-style3" style="width: 14.25%">125%</td>
			<td class="auto-style6" style="width: 14.25%">150%</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Forfait 
			naissance ou adoption</strong>
			<span style="text-decoration: underline"><em>après 9 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%">50€</td>
			<td class="auto-style3" style="width: 14.25%">&nbsp;</td>
			<td class="auto-style6" style="width: 14.25%">&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style5" style="width:57.09%; height: 56px;"><strong>
			Cures thermales</strong><br />
			Honoraires, Soins, Frais de transport, Hébergement
			<span style="text-decoration: underline"><em>après 6 mois</em></span></td>
			<td class="auto-style3" style="width: 14.25%; height: 56px;">100%</td>
			<td class="auto-style3" style="width: 14.25%; height: 56px; font-family: Arial, Helvetica, sans-serif;">
			100%<br />
			+ forfait 50€</td>
			<td class="auto-style6" style="width: 14.25%; height: 56px; font-family: Arial, Helvetica, sans-serif;">
			100%<br />
			+ forfait 100 €</td>
		</tr>
	</table>
				<table style="width: 100%">
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Garantie « 
			Exonération de Cotisations »</strong><br />
			&gt; licenciement économique<br />
			&gt; cessation d’activité suite à dépôt de bilan<br />
			&gt; affections de longue durée (ALD-30) et les poly pathologies</td>
			<td class="auto-style3" style="width: 57.72%">Prise en charge des 
			cotisations :<br />
			1 000 € par évènement et par année</td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">* <strong>Assistance</strong></td>
			<td class="auto-style3" style="width: 57.72%">oui</td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">* <strong>Protection 
			juridique médicale</strong></td>
			<td class="auto-style3" style="width: 57.72%"><strong>Maximum 20 
			000€ TTC par litige en France et dans l’U.E<br />
			</strong>en cas de litige présumé avec un professionnel de santé ou 
			un établissement de soins</td>
					</tr>
	</table>
				<table style="width: 100%">
					<caption>GARANTIES OPTIONNELLES **</caption>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Individuelle enfants 
			(scolaire - extrascolaire)</td>
			<td class="auto-style3" style="width: 57.72% ;text-align:left"><table width="100%"><tr><td style="width:80%">
				Décès par accident :</td><td style="width:20%">4 000 €</td></tr><tr><td style="width:80%">
					Invalidité permanente par accident (franchise 10%) :</td><td style="width:20%">
					50 000 €</td></tr><tr><td style="width:80%">Frais de 
					rattrapage scolaire :</td><td style="width:20%">500 €</td></tr></table></td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% ">Individuelle accident 
			(capital décès par accident)<br />
			<strong>(sans limite d’âge)</strong></td>
			<td class="auto-style3" style="width: 57.72%;text-align:left"><table width="100%"><tr><td style="width:80%">
				Adhérent principal</td><td style="width:20%">4 000 €</td></tr><tr><td style="width:80%">
					Conjoint (inscrit au contrat)</td><td style="width:20%">
					2 000 €</td></tr><tr><td style="width:80%">Enfant (désigné 
					au contrat)</td><td style="width:20%">1 500 €</td></tr></table></td>
					</tr>
		<tr>
			<td class="auto-style5" style="width:57.09% "><strong>Rapatriement 
			de Corps<br />
			</strong>ouvert à toute personne physique domiciliée en France, en 
			Guadeloupe, en Martinique, en Guyane Française ou sur l’Ile de la 
			Réunion et qui souhaite être inhumée dans son pays d’origine</td>
			<td class="auto-style3" style="width: 57.72% ;text-align:left">&nbsp;<strong>Rapatriement</strong> 
			de corps dans le pays d’origine du lieu du décès jusqu’à l’aéroport&nbsp;&nbsp;&nbsp;&nbsp; international,<br />
			<br />
			<strong>&nbsp;Prise en charge</strong> du transfert de corps 
			jusqu’au lieu d’inhumation à concurrence de 800 €<br />
			<br />
			<strong>&nbsp;Mise à disposition</strong> d’un titre de transport 
			pour un membre de la famille en accompagnement du corps<br />
			<br />
&nbsp;<strong>À la demande</strong> de la famille si le décès a lieu dans le 
			pays d’origine prise en charge des frais funéraires
			dans la limite de 1 200 € TTC.</td>
					</tr>
	</table>

	<h6 class="retour">» <a href="javascript:;" onclick="ScrollUpToPage()">Revenir 
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
