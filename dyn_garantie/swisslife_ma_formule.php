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
								and ngamme=1
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
<title>Tableaux des garanties Siwsslife , Ma Formule</title>
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
<script src="../js/form-vahome.js" type="text/javascript"></script>
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
	<img alt="alptis" style="position: absolute; top: 80px; left: 0px" src="../images/swisslife-244.jpg"/>
	

	
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

<table  style="width:100%">
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;</td>
			<td class="auto-style2"><strong>Niveau 1 </strong> </td>
			<td class="auto-style2"><strong>Niveau 2 </strong> </td>
			<td class="auto-style3"><strong>Niveau 3 </strong> </td>
			<td class="auto-style3"><strong>Niveau 4 </strong> </td>
			<td class="auto-style4"><strong>Niveau 5 </strong> </td>
			
			
		</tr>
		</table>
	<p></p>
	
	<table style="width:100%">
		<caption>Hospitalisation et Maternit??</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Frais de s??jour</strong> 
			en secteur conventionn??</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style4">Frais r??els</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Frais de s??jour</strong> 
			en secteur non conventionn??</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">250 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Chirurgie, anesth??sie, 
			obst??trique</strong></td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style2">175 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">250 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Transport du malade</strong></td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style3">100 %</td>
			<td class="auto-style3">100 %</td>
			<td class="auto-style4">150 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Forfait hospitalier* 
			- dur??e illimit??e</strong></td>
			<td class="auto-style2">Frais r??els</td>
			<td class="auto-style2">Frais r??els</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style4">Frais r??els</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;<strong>Chambre particuli??re</strong> 
			en secteur conventionn?? - <strong>dur??e illimit??e</strong></td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">50 ???/j</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style3">Frais r??els</td>
			<td class="auto-style4">Frais r??els</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Chambre particuli??re</strong> 
			en secteur non conventionn?? - <strong>dur??e illimit??e</strong></td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">30 ???/j</td>
			<td class="auto-style3">30 ???/j</td>
			<td class="auto-style3">40 ???/j</td>
			<td class="auto-style4">50 ???/j</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;<strong>Lit d&#39;accompagnant</strong> 
			- pendant 15 jours par ??v??nement</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">20 ???/j</td>
			<td class="auto-style3">20 ???/j</td>
			<td class="auto-style4">25 ???/j</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Frais de t??l??vision</strong> 
			- pendant 15 jours</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">5 ???/j</td>
			<td class="auto-style3">5 ???/j</td>
			<td class="auto-style4">5 ???/j</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Dentaire</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Dentaire rembours?? 
			par la S??curit?? sociale</strong> : soins, proth??ses</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">250 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Orthodontie</strong> 
			: forfait/an/b??n??ficiaire, en plus du remboursement de la Sociale</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">300 ???</td>
			<td class="auto-style3">400 ???</td>
			<td class="auto-style3">600 ???</td>
			<td class="auto-style4">800 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;<strong>Dentaire 
			non rembours??</strong> par la S??curit?? sociale y compris implants, proth??ses, 
			orthodontie &quot;adultes&quot;, parodontologie - Maxi/an/b??n??ficiaire</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">100 ???</td>
			<td class="auto-style3">200 ???</td>
			<td class="auto-style3">250 ???</td>
			<td class="auto-style4">300 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;<strong>Plafond</strong> 
			sur proth??ses dentaires(rembours??es ou non par la SS) et autres actes 
			dentaires non rembours??s par la SS /an/b??n??ficiaire<br />
			</td>
			<td class="auto-style2">&nbsp;</td>
			<td class="auto-style2">&nbsp;</td>
			<td class="auto-style3"></td>
			<td class="auto-style3"></td>
			<td class="auto-style4">&nbsp;</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">- pendant les 2 premi??res 
			ann??es</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">-</td>
			<td class="auto-style3">800 ???</td>
			<td class="auto-style4">1 000 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">- les ann??es suivantes</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">-</td>
			<td class="auto-style3">1 200 ???</td>
			<td class="auto-style4">1 500 ???</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Optique</caption>
		<tr>
			<td class="auto-style5" style="width: 317px">&nbsp;<strong>Verres + 
			montures + lentilles</strong> rembours??es par la S??curit?? sociale</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">+ <strong>forfait/an/b??n??ficiaire</strong> 
			y compris pour lentilles non rembours??es et chirurgie r??fractive</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">100 ???</td>
			<td class="auto-style3">150 ???</td>
			<td class="auto-style3">200 ???</td>
			<td class="auto-style4">250 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">+ <strong>bonus : report 
			de 50% du forfait</strong> l&#39;ann??e suivante, si non utilis?? une 
			ann??e, soit un forfait cumul?? sur 2 ans de:</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">150 ???</td>
			<td class="auto-style3">225 ???</td>
			<td class="auto-style3">300 ???</td>
			<td class="auto-style4">375 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">+<strong> Forfait sup</strong>. 
			pour verres a corrections <strong>sup??rieures a 6 dioptries</strong> 
			ou<br />
			<strong>verres progressifs-multifocaux</strong></td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">-</td>
			<td class="auto-style3">50 ???</td>
			<td class="auto-style4">75 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px">+<strong> Forfait sup</strong>. 
			pour <strong>chirurgie r??fractive</strong> (myopie, presbytie, hyperm??tropie) 
			Les montants ci-dessus constituent des maxi/an/b??n??ficiaire.</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">-</td>
			<td class="auto-style3">100 ???</td>
			<td class="auto-style4">150 ???</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>M??decine courante</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>M??decins</strong> 
			y compris avec mention hom??opathie, acupuncture, phytoth??rapie</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">125 %</td>
			<td class="auto-style3">150 %</td>
			<td class="auto-style3">175 %</td>
			<td class="auto-style4">200 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Ost??opathes, chiropracteurs, 
			di??t??ticiens </strong>non rembours??s par la<br />
			S??curit?? sociale par consultation (maxi 5 consultations/an)</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">30 ???</td>
			<td class="auto-style3">30 ???</td>
			<td class="auto-style3">30 ???</td>
			<td class="auto-style4">40 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Auxiliaires m??dicaux, 
			laboratoires</strong></td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">125 %</td>
			<td class="auto-style3">150 %</td>
			<td class="auto-style3">175 %</td>
			<td class="auto-style4">200 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Radiologie - Imagerie 
			- Echographie - ATM</strong> (actes techniques m??dicaux)</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">125 %</td>
			<td class="auto-style3">150 %</td>
			<td class="auto-style3">175 %</td>
			<td class="auto-style4">200 %</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Pharmacie</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>M??dicaments et 
			hom??opathie</strong> rembours??s par la S??curit?? sociale</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style3">100 %</td>
			<td class="auto-style3">100 %</td>
			<td class="auto-style4">100 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Pharmacie non rembours??e</strong> 
			: vaccins, contraceptifs, m??dicaments d'hom??opathie et de 
			phytoth??rapie, sur prescription m??dicale Maxi /an/b??n??ficiaire</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">20 ???</td>
			<td class="auto-style3">30 ???</td>
			<td class="auto-style3">40 ???</td>
			<td class="auto-style4">50 ???</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Proth??ses et appareillage (auditif, orthop??dique, capillaire,...)</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Proth??ses et appareillage 
			(auditif, orthop??dique, capillaire,...)</strong></td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">250 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>+ forfait appareils 
			auditifs</strong> - Maxi/an/b??n??ficiaire</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">150 ???</td>
			<td class="auto-style3">200 ???</td>
			<td class="auto-style4">250 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>+ forfait proth??ses 
			capillaires</strong> - Maxi/an/b??n??ficiaire</td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">100 ???</td>
			<td class="auto-style3">150 ???</td>
			<td class="auto-style4">200 ???</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Cures thermales</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Cures thermales</strong></td>
			<td class="auto-style2">100 %</td>
			<td class="auto-style2">150 %</td>
			<td class="auto-style3">200 %</td>
			<td class="auto-style3">250 %</td>
			<td class="auto-style4">300 %</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>+ forfait cure 
			thermale - Maxi/an/b??n??ficiaire</strong></td>
			<td class="auto-style2">-</td>
			<td class="auto-style2">-</td>
			<td class="auto-style3">100 ???</td>
			<td class="auto-style3">150 ???</td>
			<td class="auto-style4">200 ???</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Forfait pr??vention sant??</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Prise en charge 
			de 50% des d??penses de pr??vention non rembours??es<br />
			par la S??curit?? sociale parmi une liste </strong>- Maxi/an/b??n??ficiaire
			</td>
			<td class="auto-style2">50 ???</td>
			<td class="auto-style2">75 ???</td>
			<td class="auto-style3">100 ???</td>
			<td class="auto-style3">125 ???</td>
			<td class="auto-style4">150 ???</td>
			
			
		</tr>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Adh??sion gratuite 
			du nouveau-n?? la premi??re ann??e d&#39;adh??sion </strong></td>
			<td class="auto-style2">Inclus</td>
			<td class="auto-style2">Inclus</td>
			<td class="auto-style3">Inclus</td>
			<td class="auto-style3">Inclus</td>
			<td class="auto-style4">Inclus</td>
			
			
		</tr>
	</table>
	<table style="width:100%">
		<caption>Assistance</caption>
		<tr>
			<td class="auto-style5" style="width: 317px"><strong>Assistance : aide 
			au quotidien et aide ?? la m??diation en cas d&#39;erreur ou de n??gligence 
			m??dicale</strong></td>
			<td class="auto-style2">oui</td>
			<td class="auto-style2">oui</td>
			<td class="auto-style3">oui</td>
			<td class="auto-style3">oui</td>
			<td class="auto-style4">oui</td>
			
			
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
