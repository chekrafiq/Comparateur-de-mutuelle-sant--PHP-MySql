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
								and ngamme=16
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
<title>N??oliane , reference</title>
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
                        <td  class="auto-style6" style="width: 42.84%">
                            <center><strong>GARANTIE DE BASE  </strong></center>
                        </td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          <center><strong>R 1</strong> </center>  
                        </td>
                        <td class="auto-style4" style="width: 14.28%">
                            <center><strong>R 2 </strong></center>
                        </td>
                        <td class="auto-style6" style="width: 14.28%">
                            <center><strong>R 3</strong></center>
                        </td>
                        <td class="auto-style6"  style="width: 14.28%">
                            <center><strong>R 4 </strong></center>
                        </td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Frais de s??jour</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          
                        100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            135%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            160%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            200%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chirurgie et anesth??sie</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            135%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            160%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            200%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait journalier hospitalier (1)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Frais r??els</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Frais r??els</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Frais r??els</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Frais r??els</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chambre particuli??re</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          N??ant</td>
                        <td class="auto-style4" style="width: 14.28%">
                            25 ??? / jour</td>
                        <td class="auto-style6" style="width: 14.28%">
                            35 ??? / jour</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            45 ??? / jour</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Frais accompagnant</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          N??ant</td>
                        <td class="auto-style4" style="width: 14.28%">
                            15 ??? / jour</td>
                        <td class="auto-style6" style="width: 14.28%">
                            15 ??? / jour</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            15 ??? / jour</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Transport du malade</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Frais de s??jour</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chirurgie et anesth??sie</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Chambre particuli??re</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          N??ant</td>
                        <td class="auto-style4" style="width: 14.28%">
                            N??ant</td>
                        <td class="auto-style6" style="width: 14.28%">
                            N??ant</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            25 ??? / jour</td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Soins dentaires</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Proth??ses et orthodontie accept??es par le RO</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            120%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            145%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            175%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Proth??ses dentaires non accept??es : implantologie, 
							parodontie</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          N??ant</td>
                        <td class="auto-style4" style="width: 14.28%">
                            125 ??? / an</td>
                        <td class="auto-style6" style="width: 14.28%">
                            150 ??? / an</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            175 ??? / an</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Plafond dentaire annuel</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Illimit??</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Illimit??</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Illimit??</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Illimit??</td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait optique annuel</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          75 ???</td>
                        <td class="auto-style4" style="width: 14.28%">
                            150 ???</td>
                        <td class="auto-style6" style="width: 14.28%">
                            175 ???</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            200 ???</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Report de 50% si non utilis?? une ann??e, soit sur 2 
							ans (2)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          112,50 ???</td>
                        <td class="auto-style4" style="width: 14.28%">
                            225 ???</td>
                        <td class="auto-style6" style="width: 14.28%">
                            262,50 ???</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            300 ???</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            R??fraction de l'??il - Inclus au forfait optique</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Oui</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Oui</td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Pharmacie (vignettes bleues et blanches)(3)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            M??decins g??n??ralistes ou sp??cialistes (4)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            125%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            150%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Auxiliaires m??dicaux</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            125%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            150%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Actes techniques m??dicaux et actes de sp??cialit??</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            125%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            150%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Imagerie m??dicale et biologie m??dicale</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          100%</td>
                        <td class="auto-style4" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100%</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            100%</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Forfait ost??opathie, chiropractie (limit?? ?? 25 ??? / 
							acte)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          50 ??? / an</td>
                        <td class="auto-style4" style="width: 14.28%">
                            75 ??? / an</td>
                        <td class="auto-style6" style="width: 14.28%">
                            100 ??? / an</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            125 ??? / an</td>
                    </tr>
                </table>
				<table style="width: 100%">
                                        <caption></caption>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            D??lai d'attente</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Aucun</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Aucun</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Aucun</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Aucun</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Questionnaire de sant??</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Aucun</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Aucun</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Aucun</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Aucun</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Tiers payant national - Remboursements automatis??s 
							(t??l??transmission)</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Oui</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Oui</td>
                    </tr>
                                        <tr>
                        <td  class="auto-style5" style="width: 42.84%">
                            Assistance IMA Assurances - N??oliane Sant??</td>
                        
                        <td class="auto-style3" style="width: 14.28%">
                          Oui</td>
                        <td class="auto-style4" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6" style="width: 14.28%">
                            Oui</td>
                        <td class="auto-style6"  style="width: 14.28%">
                            Oui</td>
                    </tr>
                </table>
                <p>Aucun d??lai de stage pour toutes les formules (maternit?? 9 mois ?? 100% pour les honoraires chirurgicaux)</p>
            <p>Aucun questionnaire m??dical</p>
            <p>-4% pour un tarif couple ??? -6% si au moins 1 enfant (monoparentale ou couple) ??? -10% pour les TNS et agricole ??? -30% pour le r??gime Alsace-Moselle</p>
            <p>Gratuit?? du 3??me enfant, payant ?? compter du 4??me</p>
            <p>L'Assureur des garanties est la Mutuelle UMC - Mutuelle soumise aux dispositions du Livre II du Code de la Mutualit??</p>
                        <p>Vos forfaits sont valables par ann??e civile d'adh??sion et par assur??, ils ne sont pas cumulables d'une ann??e sur l'autre. Vos remboursements sont toujours effectu??s d??duction faite du remboursement de la S??curit?? Sociale dans la limite de l'option choisie. Dans tous les cas, les remboursements sont limit??s au montant de la d??pense r??elle en Euro. (Contrat responsable en application de la loi N?? 2004-810 du 13 
						aout 2004) - Hors parcours de soins, la majoration du ticket mod??rateur, et la franchise de 8 ??? ainsi que les franchises sur les 
						boites de m??dicaments, les actes param??dicaux et les transports sanitaires pr??vues ?? l'art. L 322-2 du code de la S??curit?? Sociale ne sont pas pris en charge conform??ment au d??cret n?? 2005-1226 du 29 septembre 2005</p>
            <p>Sauf mention contraire, seules les prestations ayant donn?? lieu ?? un remboursement du r??gime obligatoire ouvrent droit ?? un remboursement compl??mentaire. Hors parcours de soins ou en l'absence de d??claration ?? la S??curit?? Sociale du choix de son m??decin traitant, il convient de retirer aux montants exprim??s ci-dessus la majoration du Ticket Mod??rateur pr??vue par les textes et en vigueur ?? la date des soins, en aucun cas la Mutuelle ne peut rembourser ce montant d'honoraires. Sauf mention particuli??re, les garanties ne concernent que les prestations accept??es par la S??curit?? Sociale et le secteur conventionn??</p>
            <p>(1) ??tablissements et services de psychiatrie, neuropsychiatrie et assimil??s : au maximum 10 jours par an et par assur??</p>
                        <p> (2) Si vous ne percevez aucune prestation optique pendant la premi??re ann??e d'adh??sion, alors le montant du forfait optique est major?? de 50 % l'ann??e suivante, la majoration du forfait reste acquise tant que vous ne percevez pas de prestation optique</p>
            <p> (3) Les m??dicaments et les produits pharmaceutiques ?? vignettes oranges sont exclus</p>
            <p> (4) Psychiatres, neuropsychiatres et assimil??s : au maximum 3 consultations par an et par assur?? pour hors parcours de soins coordonn??s</p>
            
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
