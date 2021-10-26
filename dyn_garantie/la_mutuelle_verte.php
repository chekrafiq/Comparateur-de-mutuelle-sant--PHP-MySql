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
								and ngamme=8
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
<title>La Mutuelle Verte , Tableau de garantie</title>
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
<div class="container_10 wrapper m_t_10" style="width:1040px">
	

	<div id="content" class="grid_10 garantie_t" style="position:relative;width:auto">
	
		<?php require_once('../inc_file/inc_menu/menu_garantie.php'); ?>

	<!-- Tableau de Garantie -->
	
	<div class="clearfix"></div>
	<p style="margin-bottom:240px"></p>
		<div  class="clr2"></div>
	<img alt="alptis" style="position: absolute; top: 80px; left: 0px" src="../images/mutuelle-verte-244.jpg"/>
	

	
		<!-- box tarif 1 -->
		<?php 
	$telephone=$clt->tel;
	$email=$clt->email;
	$sexe = $clt->couple;
	$nbr_enfant = (int)$clt->nbrEnfant;
	$i=1;
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
	<div class="boxtarif boxtarif<?php echo $i ;?>" >
		
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


	<table  style="width:100%">
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;</td>
			<td class="auto-style2"><strong>GCI01 1 </strong> </td>
			<td class="auto-style2"><strong>GCI01 2 </strong> </td>
			<td class="auto-style3"><strong>GCI01 3 </strong> </td>
			<td class="auto-style3"><strong>GCI01 4 </strong> </td>
			<td class="auto-style4"><strong>GCI01 5 </strong> </td>
			
			
			<td class="auto-style4"><strong>GCI01 6 </strong> </td>
			
			
		</tr>
		</table>
		<table style="width: 100%">
					<caption>HONORAIRES MÉDICAUX</caption>
					<tr>
						<td style="width: 317px" class="auto-style5">Consultation, visite (1), radios, 
						échographie</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Analyses, auxiliaires médicaux, 
						actes techniques</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
				</table>
				<table style="width: 100%">
					<caption>PHARMACIE</caption>
					<tr>
						<td style="width: 317px" class="auto-style5">PHARMACIE (35 %* - 65 %) (2)</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style3">100 %</td>
						<td class="auto-style3">100 %</td>
						<td class="auto-style6">100 %</td>
						<td class="auto-style4">100 %</td>
					</tr>
				</table>
				<table style="width: 100%">
					<caption>OPTIQUE</caption>
					<tr>
						<td style="width: 317px" class="auto-style5">Monture, verres, lentilles acceptées 
						ou refusées (3)</td>
						<td class="auto-style2">65 %*</td>
						<td class="auto-style2">65 %*</td>
						<td class="auto-style3">65 %*</td>
						<td class="auto-style3">65 %*</td>
						<td class="auto-style6">65 %*</td>
						<td class="auto-style4">65 %*</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Forfait optique 1ère et 2ème année 
						(4)</td>
						<td class="auto-style2">25 € (5)</td>
						<td class="auto-style2">50 € (5)</td>
						<td class="auto-style3">100 € (5)</td>
						<td class="auto-style3">250 € (5)</td>
						<td class="auto-style6">300 € (5)</td>
						<td class="auto-style4">400 € (5)</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Forfait après 2 ans (4)</td>
						<td class="auto-style2">50 € (5)</td>
						<td class="auto-style2">75 € (5)</td>
						<td class="auto-style3">150 € (5)</td>
						<td class="auto-style3">250 € (5)</td>
						<td class="auto-style6">300 € (5)</td>
						<td class="auto-style4">400 € (5)</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Forfait après 4 ans (4)</td>
						<td class="auto-style2">75 € (5)</td>
						<td class="auto-style2">100 € (5)</td>
						<td class="auto-style3">200 € (5)</td>
						<td class="auto-style3">300 € (5)</td>
						<td class="auto-style6">400 € (5)</td>
						<td class="auto-style4">500 € (5)</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Supplément verres multifocaux</td>
						<td class="auto-style2">-</td>
						<td class="auto-style2">25 € (5)</td>
						<td class="auto-style3">50 € (5)</td>
						<td class="auto-style3">125 € (5)</td>
						<td class="auto-style6">150 € (5)</td>
						<td class="auto-style4">200 € (5)</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Opération des yeux par laser (myopie, 
						hypermétropie, 
						astigmatisme, presbytie)</td>
						<td class="auto-style2">150 € (5)</td>
						<td class="auto-style2">300 € (5)</td>
						<td class="auto-style3">400 € (5)</td>
						<td class="auto-style3">600 € (5)</td>
						<td class="auto-style6">700 € (5)</td>
						<td class="auto-style4">900 € (5)</td>
					</tr>
				</table>
				<table style="width: 100%">
					<caption>APPAREILLAGE</caption>
					<tr>
						<td style="width: 317px" class="auto-style5">Fournitures, orthopédie, autres 
						appareillages</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style2" style="width: 104px">120 %</td>
						<td class="auto-style3" style="width: 100px">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Fauteuil roulant</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style2" style="width: 104px">120 %</td>
						<td class="auto-style3" style="width: 100px">150 %</td>
						<td class="auto-style3">R.O. + <br />
						500 € <br />
						(6)</td>
						<td class="auto-style6">R.O. + <br />
						1000€ <br />
						(6)</td>
						<td class="auto-style4">R.O. +<br />
						1500€<br />
						(6)</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Audioprothèse</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style2" style="width: 104px">120 %</td>
						<td class="auto-style3" style="width: 100px">150 %</td>
						<td class="auto-style3">100%<br />
&nbsp;+ 500€ <br />
						(6)</td>
						<td class="auto-style6">100% +<br />
&nbsp;750€ <br />
						(6)</td>
						<td class="auto-style4">100% +<br />
						1000€<br />
						(6)</td>
					</tr>
				</table>
				<table style="width: 100%">
					<caption>DENTAIRE</caption>
					<tr>
						<td style="width: 317px" class="auto-style5">Soins</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">Inlays corés</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">100 %</td>
						<td class="auto-style3">125 %</td>
						<td class="auto-style6">150 %</td>
						<td class="auto-style4">150 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Couronnes acceptées, bridges : 
						(7) - Dents visibles</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style3">300 %</td>
						<td class="auto-style6">400 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Couronnes acceptées, bridges :<br />
						- Autres dents</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">400 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Appareils mobiles, réparations</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">175 %</td>
						<td class="auto-style3">250 %</td>
						<td class="auto-style6">350 %</td>
						<td class="auto-style4">450 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Orthodontie acceptée</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style3">300 %</td>
						<td class="auto-style6">400 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Implants dentaires</td>
						<td class="auto-style2">-</td>
						<td class="auto-style2">-</td>
						<td class="auto-style3">300<br />
&nbsp;€ (5)</td>
						<td class="auto-style3">500<br />
&nbsp;€ (5)</td>
						<td class="auto-style6">750<br />
&nbsp;€ (5)</td>
						<td class="auto-style4">1000 <br />
						€ (5)</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Parodontologie, orthodontie 
						refusée</td>
						<td class="auto-style2">-</td>
						<td class="auto-style2">-</td>
						<td class="auto-style3">150 <br />
						€ (5)</td>
						<td class="auto-style3">300<br />
&nbsp;€ (5)</td>
						<td class="auto-style6">400 <br />
						€ (5)</td>
						<td class="auto-style4">500 <br />
						€ (5)</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Plafond dentaire - 1ère et 2ème 
						années (4)</td>
						<td class="auto-style2">-</td>
						<td class="auto-style2">-</td>
						<td class="auto-style3">750<br />
						€/ an</td>
						<td class="auto-style3">1000<br />
						€/ an</td>
						<td class="auto-style6">1500<br />
						€/ an</td>
						<td class="auto-style4">2000<br />
						€/ an</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">Plafond dentaire - années 
						suivantes (4)</td>
						<td class="auto-style2">-</td>
						<td class="auto-style2">-</td>
						<td class="auto-style3">1000<br />
						€/ an</td>
						<td class="auto-style3">1500<br />
						€/ an</td>
						<td class="auto-style6">3000<br />
						€/ an</td>
						<td class="auto-style4">3000<br />
						€/ an</td>
					</tr>

				</table>
				<table style="width: 100%">
					<caption>TRANSPORT</caption>
<tr>
						<td style="width: 317px" class="auto-style5">TRANSPORT</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">120 %</td>
						<td class="auto-style3">150 %</td>
						<td class="auto-style3">200 %</td>
						<td class="auto-style6">300 %</td>
						<td class="auto-style4">500 %</td>
					</tr>

				</table>
				<table style="width: 100%">
					<caption>CURE THERMALE</caption>
<tr>
						<td style="width: 317px" class="auto-style5">CURE THERMALE</td>
						<td class="auto-style2" style="width: 103px">R.O.</td>
						<td class="auto-style2">R.O. + 100 €<br />
(5)</td>
						<td class="auto-style3">R.O. + 150 €<br />
(5)</td>
						<td class="auto-style3">R.O. + 300 € <br />
						(5)</td>
						<td class="auto-style6">R.O. + 400 € <br />
						(5)</td>
						<td class="auto-style4">R.O. + 500 €<br />
(5)</td>
					</tr>

				</table>
				<table style="width: 100%">
					<caption class="auto-style8">HOSPITALISATION MÉDICALE, 
					MATERNITÉ<br />
					ET PSYCHIATRIE (8)</caption>
<tr>
						<td style="width: 317px" class="auto-style5">• Honoraires et frais de séjour</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style2" style="width: 103px">120 %</td>
						<td class="auto-style3" style="width: 100px">150 %</td>
						<td class="auto-style3" style="width: 104px">300 %</td>
						<td class="auto-style6">350 %</td>
						<td class="auto-style4">500 %</td>
					</tr>
					<tr>
						<td style="width: 317px" class="auto-style5">• Forfait journalier 
						hospitalier (9)</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style3" style="width: 100px">100 %</td>
						<td class="auto-style3" style="width: 104px">100 %</td>
						<td class="auto-style6">100 %</td>
						<td class="auto-style4">100 %</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">• Chambre particulière (10)</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style3" style="width: 100px">46€/ jour</td>
						<td class="auto-style3" style="width: 104px">60€/ jour</td>
						<td class="auto-style6">80€/ jour</td>
						<td class="auto-style4">100€/ jour</td>
					</tr>
<tr>
						<td style="width: 317px" class="auto-style5">• Participation aux frais 
						d’accouchement (11)</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style2" style="width: 103px">100€</td>
						<td class="auto-style3" style="width: 100px">150€</td>
						<td class="auto-style3" style="width: 104px">300€</td>
						<td class="auto-style6">400€</td>
						<td class="auto-style4">500€</td>
					</tr>


				</table>
				<table style="width: 100%">
					<caption>HOSPITALISATION CHIRURGICALE
					<span class="auto-style9">(8)</span></caption>
<tr>
						<td style="width: 317px" class="auto-style5">• Honoraires et frais de séjour</td>
						<td class="auto-style2" style="width: 103px">100%</td>
						<td class="auto-style2" style="width: 103px">120 %</td>
						<td class="auto-style3" style="width: 103px">150 %</td>
						<td class="auto-style3" style="width: 103px">300 %</td>
						<td class="auto-style6">350 %</td>
						<td class="auto-style4">500 %</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Forfait journalier 
						hospitalier (durée illimitée)</td>
						<td class="auto-style2" style="width: 103px">100%</td>
						<td class="auto-style2" style="width: 103px">100 %</td>
						<td class="auto-style3" style="width: 103px">100 %</td>
						<td class="auto-style3" style="width: 103px">100 %</td>
						<td class="auto-style6">100 %</td>
						<td class="auto-style4">100 %</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Chambre particulière (durée 
						illimitée)</td>
						<td class="auto-style2" style="width: 103px">30€/ jour</td>
						<td class="auto-style2" style="width: 103px">40€/ jour</td>
						<td class="auto-style3" style="width: 103px">46€/ jour</td>
						<td class="auto-style3" style="width: 103px">60€/ jour</td>
						<td class="auto-style6">80€/ jour</td>
						<td class="auto-style4">100€/ jour</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Frais accompagnant (enfant - 
						de 12 ans) (12)</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style3" style="width: 103px">10€/ jour</td>
						<td class="auto-style3" style="width: 103px">20€/ jour</td>
						<td class="auto-style6">40€/ jour</td>
						<td class="auto-style4">50€/<br />
						jour</td>
					</tr>


				</table>
				<table style="width: 100%">
					<caption></caption>
<tr>
						<td style="width: 317px" class="auto-style5">• Ostéopathie, chiropractie 
						(13)</td>
						<td class="auto-style2" style="width: 103px">10€<br />
						/séance</td>
						<td class="auto-style2" style="width: 103px">15€<br />
						/séance</td>
						<td class="auto-style3" style="width: 103px">20€<br />
						/séance</td>
						<td class="auto-style3" style="width: 103px">30€<br />
						/séance</td>
						<td class="auto-style6">40€<br />
						/séance</td>
						<td class="auto-style4">50€<br />
						/séance</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Consultation diététique 
						(enfant - de 15 ans) (14)</td>
						<td class="auto-style2" style="width: 103px">3 par an</td>
						<td class="auto-style2" style="width: 103px">3 par an</td>
						<td class="auto-style3" style="width: 103px">3 par an</td>
						<td class="auto-style3" style="width: 103px">3 par an</td>
						<td class="auto-style6">3 par an</td>
						<td class="auto-style4">3 par an</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Consultation d’un psychologue 
						(enfant - de 15 ans) (15)</td>
						<td class="auto-style2" style="width: 103px">maxi.</td>
						<td class="auto-style2" style="width: 103px">maxi.</td>
						<td class="auto-style3" style="width: 103px">maxi.</td>
						<td class="auto-style3" style="width: 103px">maxi.</td>
						<td class="auto-style6">maxi.</td>
						<td class="auto-style4">maxi.</td>
					</tr>


<tr>
						<td style="width: 317px" class="auto-style5">• Sevrage tabagique (adulte de 
						18 ans et plus) (3)</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style2" style="width: 103px">&nbsp;</td>
						<td class="auto-style3" style="width: 103px">30 € (5)</td>
						<td class="auto-style3" style="width: 103px">50 € (5)</td>
						<td class="auto-style6">50 € (5)</td>
						<td class="auto-style4">50 € (5)</td>
					</tr>


				</table>
				<table style="width: 100%">
					<caption>OBSÈQUES (jusqu&#39;à 65 ans)</caption>
<tr>
						<td style="width: 317px" class="auto-style5">OBSÈQUES (jusqu&#39;à 65 ans)</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style2" style="width: 103px">-</td>
						<td class="auto-style3" style="width: 103px">500€</td>
						<td class="auto-style3" style="width: 103px">750€</td>
						<td class="auto-style6">1000€</td>
						<td class="auto-style4">2000€</td>
					</tr>


				</table>
				<table style="width: 100%">
					<caption>FORFAIT ACTES LOURDS (18 euros*)</caption>
<tr>
						<td style="width: 317px" class="auto-style5">FORFAIT ACTES LOURDS (18 
						euros*)</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style2">100 %</td>
						<td class="auto-style3">100 %</td>
						<td class="auto-style3">100 %</td>
						<td class="auto-style6">100 %</td>
						<td class="auto-style4">100 %</td>
					</tr>


				</table>
				<table style="width: 100%">
					<caption>MUTUELLE VERTE ASSISTANCE</caption>
<tr>
						<td style="width: 317px" class="auto-style5">MUTUELLE VERTE ASSISTANCE</td>
						<td class="auto-style2">Oui</td>
						<td class="auto-style2">Oui</td>
						<td class="auto-style3">Oui</td>
						<td class="auto-style3">Oui</td>
						<td class="auto-style6">Oui</td>
						<td class="auto-style4">Oui</td>
					</tr>


				</table>
<p class="description"><strong>(1)</strong> : La majoration de déplacement des consultations à domicile considérées comme médicalement non justifiées par les médecins et le Régime d'Assurance Maladie Obligatoire n'est pas prise en charge (actes codifiés "DE" : Dépassement
Exceptionnel).</p>
				<p class="description"><strong>(2)</strong> : Remboursement sur la base du Tarif Forfaitaire de Responsabilité (TFR). Aucun remboursement n'est prévu pour les médicaments à vignette orange que la Haute Autorité de Santé a jugé à service médical rendu
faible ou insuffisant et pour lesquels le ROAM participe à hauteur de 15% au 01/01/2010.</p>
				<p class="description"><strong>(3)</strong> : Pris en charge si médicalement prescrit.</p>
				<p class="description"><strong>(4)</strong> : L'avantage fidélité est calculé à partir de la date d'adhésion à la garantie ci dessus.
</p>
				<p class="description"><strong>(5)</strong> : Forfait pour une année civile et par bénéficiaire, proratisé en cas d'adhésion ou de radiation en cours d'année.</p>
				<p class="description"><strong>(6)</strong> : Forfait pour 2 années civiles et par bénéficiaire, proratisé en cas d'adhésion ou de radiation au cours des 2 années.
</p>
				<p class="description"><strong>(7)</strong> : Dents visibles = incisives, canines et 1ères prémolaires, autres dents = 2èmes prémolaires, molaires. Sur présentation de la facture et du schéma dentaire détaillés. </p>
				<p class="description"><strong>(8)</strong> : Hors soins externes. Les soins externes font l'objet d'un remboursement
suivant la nature de l'acte. </p>
				<p class="description"><strong>(9)</strong> : Forfait journalier hospitalier (selon tarifs en vigueur) illimité en médecine. Limité à 90 j maison de repos et convalescence à 30 jours en psychiatrie (par année civile et par bénéficiaire).
</p>
				<p class="description"><strong>(10)</strong> : Chambre particulière limitée à 90 j en médecine, maison de repos et de convalescence à 30 j en psychiatrie (par année civile et par bénéficiaire). </p>
				<p class="description"><strong>(11)</strong> : Directement liée aux prestations maternité et versée à la mère lorsqu'elle
est bénéficiaire des prestations de la Mutuelle Verte. </p>
				<p class="description"><strong>(12)</strong> : En milieu hospitalier uniquement et limités à 30 jours par année civile et par bénéficiaire. Lors d’une hospitalisation, les frais d’accompagnant étant facturés à l’enfant, celui-ci
doit être bénéficiaire des prestations de La Mutuelle Verte. </p>
				<p class="description"><strong>(13)</strong> : Pour les actes effectués par un praticien titulaire d'un diplôme officiellement reconnu sanctionnant une formation spécifique à ces pratiques médicales. </p>
				<p class="description"><strong>(14)</strong> : Sur présentation
de la facture acquittée du(de la) diététicien(ne) Diplômé(e) d'État et d'une attestation du médecin traitant (sous forme d'une demande d'un conseil diététique, sans donnée médicale). </p>
				<p class="description">&nbsp;<strong>(15)</strong> : Sur présentation de la facture acquittée
du(de la) praticien(ne) Diplômé(e) d'État et d'une attestation du médecin traitant (sous forme d'une demande d'un bilan psychologique, sans donnée médicale). </p>
				<p class="description">&nbsp;<strong>(16)</strong> : Remboursement au titre du poste Prévention plafonné par année
civile et par bénéficiaire à 30 Euros sur la GCI01, 45 Euros sur la GCI02, 60 Euros sur la GCI03, 90 Euros sur la GCI04, 120 Euros sur la GCI05 et 150 Euros sur la GCI06.</p>

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
