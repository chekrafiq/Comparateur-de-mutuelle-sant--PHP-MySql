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
								and ngamme=15
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
<title>NEOLIANE , ESSENTIEL</title>
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
	<img alt="alptis" style="position: absolute; top: 80px; left: 0px" src="../images/neoliane-244.jpg"/>
	

	
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


	<table style="width: 100%">
                                        <tr>
                        <td  class="auto-style6" style="width: 42.84%">
                            <center><strong>GARANTIE DE BASE  </strong></center>
                        </td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          <center><strong> 100</strong> </center>  
                        </td>
                        <td class="auto-style4" style="width: 9.52%">
                            <center><strong>125 </strong></center>
                        </td>
                        <td class="auto-style6" style="width: 9.52%">
                            <center><strong>150</strong></center>
                        </td>
                        <td class="auto-style6"  style="width: 9.52%">
                            <center><strong>175 </strong></center>
                        </td>
                                                <td class="auto-style6" style="width: 9.52%">
                            <center><strong>200</strong></center>
                        </td>
                        <td class="auto-style6"  style="width: 9.52%">
                            <center><strong>225 </strong></center>
                        </td>

                    </tr>
                </table>
	<p></p>
	<table style="width: 100%">
                                        <caption>HOSPITALISATION SECTEUR 
										CONVENTIONNE</caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Frais de séjour</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            150%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            Frais réels</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					Frais réels</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            Frais réels</td>

                    </tr>
                    
                    <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Acte de chirurgie et d'anesthésie</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            150%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					200%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            225%</td>

                    </tr>

<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait journalier hospitalier (1)</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          Frais réels</td>
                        <td class="auto-style4" style="width: 9.52%">
                            Frais réels</td>
                        <td class="auto-style6" style="width: 9.52%">
                            Frais réels</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            Frais réels</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					Frais réels</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            Frais réels</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chambre particulière</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          Néant</td>
                        <td class="auto-style4" style="width: 9.52%">
                            25 € / jour</td>
                        <td class="auto-style6" style="width: 9.52%">
                            35 € / jour</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            45 € / jour</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					55 € / jour</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            65 € / jour</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Lit accompagnant</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          Néant</td>
                        <td class="auto-style4" style="width: 9.52%">
                            15 € / jour</td>
                        <td class="auto-style6" style="width: 9.52%">
                            15 € / jour</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            15 € / jour</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					15 € / jour</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            15 € / jour</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Transport du malade</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>

                </table>
	<p></p>
	<table style="width: 100%">
                                        <caption>HOSPITALISATION SECTEUR NON 
										CONVENTIONNE</caption>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Frais de séjour</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Acte de chirurgie et d'anesthésie</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chambre particulière</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          Néant</td>
                        <td class="auto-style4" style="width: 9.52%">
                            Néant</td>
                        <td class="auto-style6" style="width: 9.52%">
                            Néant</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            25 € / jour</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					25 € / jour</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            25 € / jour</td>

                    </tr>

                </table>
	<p></p>
	<table style="width: 100%">
                                        <caption>DENTAIRE ET OPTIQUE</caption>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Soins dentaires</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Prothèses et orthodontie acceptées</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            150%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					200%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            225%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Prothèses dentaires non acceptées : implantologie, 
							parodontie</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          Néant</td>
                        <td class="auto-style4" style="width: 9.52%">
                            125 € / an</td>
                        <td class="auto-style6" style="width: 9.52%">
                            150 € / an</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175 € / an</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					200 € / an</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            225 € / an</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Plafond dentaire : Année 1</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          illimité</td>
                        <td class="auto-style4" style="width: 9.52%">
                            illimité</td>
                        <td class="auto-style6" style="width: 9.52%">
                            illimité</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            illimité</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					700 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            900 €</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Plafond dentaire : Année 2 et suivantes</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          illimité</td>
                        <td class="auto-style4" style="width: 9.52%">
                            illimité</td>
                        <td class="auto-style6" style="width: 9.52%">
                            illimité</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            illimité</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					1 000 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            1 200 €</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait optique annuel</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          75 €</td>
                        <td class="auto-style4" style="width: 9.52%">
                            150 €</td>
                        <td class="auto-style6" style="width: 9.52%">
                            175 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            200 €</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					250 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            275 €</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Report 50% si non utilisé une année, soit sur 2 ans 
							(2)</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          112,50 €</td>
                        <td class="auto-style4" style="width: 9.52%">
                            225 €</td>
                        <td class="auto-style6" style="width: 9.52%">
                            262,50 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            300 €</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					375 €</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            412,50 €</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Opération de la myopie</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          idem forfait optique</td>
                        <td class="auto-style4" style="width: 9.52%">
                            idem forfait optique</td>
                        <td class="auto-style6" style="width: 9.52%">
                            idem forfait optique</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            idem forfait optique</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					idem forfait optique</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            idem forfait optique</td>

                    </tr>

                </table>
	<p></p>
	<table style="width: 100%">
                                        <caption>CONSULTATION ET PHARMACIE</caption>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Pharmacie (vignettes bleues, blanches et oranges)</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Médecins généralistes ou spécialistes (3)</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            150%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					175%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Auxiliaires médicaux</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            150%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					175%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Actes techniques médicaux et actes de spécialité</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            125%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            150%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					175%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            175%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Radiologie</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Laboratoire</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          100%</td>
                        <td class="auto-style4" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					100%</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            100%</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait ostéopathie, chiropractie (limité à 25 € / 
							acte)</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          50 € / an</td>
                        <td class="auto-style4" style="width: 9.52%">
                            75 € / an</td>
                        <td class="auto-style6" style="width: 9.52%">
                            100 € / an</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            125 € / an</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					150 € / an</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            150 € / an</td>

                    </tr>

                </table>
	<p></p>
	<table style="width: 100%">
                                        <caption>SERVICES</caption>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Délai d'attente</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          aucun</td>
                        <td class="auto-style4" style="width: 9.52%">
                            aucun</td>
                        <td class="auto-style6" style="width: 9.52%">
                            aucun</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            aucun</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					aucun</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            aucun</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Questionnaire de santé</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          aucun</td>
                        <td class="auto-style4" style="width: 9.52%">
                            aucun</td>
                        <td class="auto-style6" style="width: 9.52%">
                            aucun</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            aucun</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					aucun</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            aucun</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Tiers payant national Viamedis<br />
							<span>Remboursements automatisés (télétransmission)</span></td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          oui</td>
                        <td class="auto-style4" style="width: 9.52%">
                            oui</td>
                        <td class="auto-style6" style="width: 9.52%">
                            oui</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            oui</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					oui</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            oui</td>

                    </tr>
<tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            <p>Assistance - Néoliane Santé</p>
						</td>
                        
                        <td class="auto-style3" style="width: 9.52%">
                          oui</td>
                        <td class="auto-style4" style="width: 9.52%">
                            oui</td>
                        <td class="auto-style6" style="width: 9.52%">
                            oui</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            oui</td>
                                                <td class="auto-style6" style="width: 9.52%">
                            					oui</td>
                        <td class="auto-style6"  style="width: 9.52%">
                            oui</td>

                    </tr>

                </table>

	<p>(1) Établissements et services de psychiatrie, neuropsychiatrie et assimilés : au maximum 30 jours par an et par assuré.</p>
	<p> (2) Si l'assuré ne perçoit aucune prestation optique pendant la première année d'adhésion, alors le montant du forfait optique est majoré de 50 % l'année suivante, la majoration du forfait reste acquise à l'assuré tant qu'il ne perçoit pas de prestation optique. </p>
	<p> (3) Psychiatres, neuropsychiatres et assimilés : au maximum 3 consultations par an et par assuré hors parcours de soins coordonnés.</p>
	<p>Aucun délai de stage pour toutes les formules (maternité 9 mois à 100 % pour les honoraires chirurgicaux)</p>
	<p>Aucun questionnaire médical</p>
	<p> -4 % pour un tarif couple • -6 % si au moins 1 enfant (monoparentale ou couple) • -10 % pour les TNS et agricole • -30 % pour le régime Alsace-Moselle</p>
	<p>Gratuité du 3ème enfant, payant à compter du 4ème</p>
	<p>L'Assureur des garanties est L'équité (Groupe GENERALI) ou la Mutuelle UMC (Mutuelle soumise aux dispositions du Livre II du Code de la Mutualité)</p>
	<p>Vos forfaits sont valables par année civile d'adhésion et par assuré, ils ne sont pas cumulables d'une année sur l'autre. Vos remboursements sont toujours effectués déduction faite du remboursement de la Sécurité Sociale dans la limite de l'option choisie. Dans tous les cas, les remboursements sont limités au montant de la dépense réelle en euro. (Contrat responsable en application de la loi N° 2004-810 du 13 août 2004) - Hors parcours de soins, la majoration du ticket modérateur, et la franchise de 8 € ainsi que les franchises sur les boîtes de médicaments, les actes paramédicaux et les transports sanitaires prévues à l'art. L 322-2 du code de la Sécurité Sociale ne sont pas pris en charge conformément au décret N° 2005-1226 du 29 septembre 2005.</p>
	<p>Sauf mention contraire, seules les prestations ayant donné lieu à un remboursement du régime obligatoire ouvrent droit à un remboursement complémentaire. Hors parcours de soins ou en l'absence de déclaration à la Sécurité Sociale du choix de son médecin traitant, il convient de retirer aux montants exprimés ci-dessus la majoration du ticket modérateur prévue par les textes et en vigueur à la date des soins, en aucun cas la Mutuelle ne peut rembourser ce montant d'honoraires. Sauf mention particulière, les garanties ne concernent que les prestations acceptées par la Sécurité Sociale et le secteur conventionné.</p>

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
