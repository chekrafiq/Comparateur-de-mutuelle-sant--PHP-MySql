<?php session_start(); include('config/cnx.php'); include('inc_dyn/domain_config.php'); include('inc_class/calsses.php');?> <?php
	

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



if (!isset($_POST['REGIME']) && !isset($_SESSION["client"])) {
	header("location: ".$_SERVER['HTTP_REFERER']);
	
	exit();
}//fin si pas formulaire et pas session
 
if (isset($_POST['REGIME']))
{

	$clt=new Client($_POST['NOM'],$_POST['PRENOM']
							,$_POST['JOUR']."-".$_POST['MOIS']."-".$_POST['ANNEE']
							,$_POST['ENFANTS'],$_POST['SEXE'],$_POST['COUPLE']
							,$_POST['REGIME']
							,substr($_POST['CP'],0,2),$_POST['EMAIL'],$_POST['TELEPHONE'],0,0,0,0,date("Y-m-d H:i:s"),0);
	
	if($clt->couple=="couple"){
		$conj=new Conjoint($_POST['NOMC'],$_POST['PRENOMC'],$_POST['ANNEEC']
								,($_POST['SEXE']=="homme"?"femme":"homme")
								,$_POST['REGIMEC']);
		$clt->conj=$conj;
		
	}
	else
	
		$clt->conj=NULL;
	
	
	$_SESSION["client"]=serialize($clt);
//	$_SESSION["conjoint"]=serialize($clt->conj);
}//fin si formulaire


//recuperation des data sessions
	$clt=unserialize($_SESSION["client"]);
//	$clt->conj=unserialize($_SESSION["conjoint"]);
	
	$opt=0;
	$hospi=0;
	$dent=0;
	$prix=0;
if(isset($_POST["slid-opt-input"]))
{
	$opt=$_POST["slid-opt-input"];
	$hospi=$_POST["slid-hospi-input"];
	$dent=$_POST["slid-dent-input"];
	$prix=$_POST["slid-prix-input"];
	
}


mysql_select_db($database_cnx, $cnx);
if($prix != "0")
{
$query_rsTarifs = sprintf("SELECT * FROM vw_tarifs 
						  		WHERE	(%d 				between age_min and age_max)
					   			and 	departements 	like 	%s
								and 	nregime		 	in 		(0,%s)
								and 	sexe 			in		('les deux',%s)
								and 	couple 			in		('les deux',%s)
								and 	HOSPITAL		>=		$hospi
								and 	OPTIQUE			>=		$opt
								and 	DENTAIRE		>=		$dent
								order by TARIF $prix
								",
						  GetSQLValueString($clt->getAge(), "int"),
						  "'%".$clt->cp."%'",
						  GetSQLValueString($clt->regime, "int"),
						  GetSQLValueString($clt->sexe, "text"),
						  GetSQLValueString($clt->couple, "text"));

}
else
{
$query_rsTarifs = sprintf("SELECT * FROM vw_tarifs 
						  		WHERE	(%d 				between age_min and age_max)
					   			and 	departements 	like 	%s
								and 	nregime		 	in 		(0,%s)
								and 	sexe 			in		('les deux',%s)
								and 	couple 			in		('les deux',%s)
								and 	HOSPITAL		>=		$hospi
								and 	OPTIQUE			>=		$opt
								and 	DENTAIRE		>=		$dent
								",
						  GetSQLValueString($clt->getAge(), "int"),
						  "'%".$clt->cp."%'",
						  GetSQLValueString($clt->regime, "int"),
						  GetSQLValueString($clt->sexe, "text"),
						  GetSQLValueString($clt->couple, "text"));
}




$rsTarifs = mysql_query($query_rsTarifs, $cnx) or die(mysql_error());
$row_rsTarifs = mysql_fetch_assoc($rsTarifs);
//echo $query_rsTarifs;
if (!$rsTarifs) {
   echo "Impossible d'ex�cuter la requ�te  dans la base : " . mysql_error();
   exit;
}

if (mysql_num_rows($rsTarifs) == 0) {
   echo "Aucune ligne trouv�e, rien � afficher.";
   exit;
}
$age = $clt->getAge();


	$query_Devis1 = "INSERT INTO devis 	values ('','$clt->nom','$clt->prenom','$clt->sexe','$clt->couple','$clt->dateNaiss',$age ,'$clt->regime',$clt->nbrEnfant,'$clt->cp','$clt->email',";
	$query_Devis2 = "'$clt->tel',$clt->ncmp,$clt->nfrml,$clt->nzone,$clt->tarifs,'$clt->dateDevis'";
	
	if($clt->couple<>"couple")
	{
	$query_Devis3 =",'','',0,'','','','','','','','','','','','','',1)";
	}
	else
	{
	$conj=$clt->conj;
	$ageConj = $conj->getAge();
	 $query_Devis3 =",'$conj->nom','$conj->prenom',$ageConj,'$conj->naiss','$conj->sexe','$conj->regime','','','','','','','','','','',1)";
	}
	 $query_Devis = $query_Devis1.$query_Devis2.$query_Devis3;
	
	//,$conj->nom,$conj->prenom,$conj->naiss,$conj->sexe,$conj->regime)"	;	
	mysql_query($query_Devis, $cnx) or die(mysql_error());	
$idDevis=mysql_insert_id();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Devis Comparatif Personnalisé - AssurSanté, mutuelle et complémentaire 
santé : Adhésion en ligne</title>
<?php include_once('inc_meta/meta.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="js/assu_script.js" type="text/javascript"></script>
<script src="js/form-vahome.js" type="text/javascript"></script>
<script src="js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>

<!-- Light Box -->
<link href="css/perttyfoto.css" rel="stylesheet" type="text/css" />
<script  src="js/jquery.prettyPhoto.js" type="text/javascript"></script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
	<?php require_once('inc_file/header.php'); ?>
	<?php require_once('inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	

	<div id="content" class="grid_8">
	
	<div id="Contenair" >

	<div class="grille" >
	<h1>Devis Comparatif Personnalisé :</h1>
		<input id="telephone" name="telephone" type="hidden" value="<?php echo $clt->telephone;  ?>" />
		<input id="EMAIL" name="EMAIL" type="hidden" value="<?php echo $clt->email ; ?>" />
		<?php 
	$telephone=$clt->tel;
	$email=$clt->email;

    do {
  		$i=0;

		$tarif=round($row_rsTarifs['TARIF'],2);
		$tarifBase = $tarif;
		
	 //####################################################################################
	 //################# modification avant réduction #####################################
	 //####################################################################################
	 // Tarifs 2012 : ajouter 8,5% au tarifs de base
	 if($row_rsTarifs['NOMCMP']=='APRIL')
	{
		$tarif=$tarif * 1.085;
	}
	// Tarifs 2012 : ajouter 4,5% au tarifs de base  pour formule 1 e astucieuse de swisslife
	  if( $row_rsTarifs['nforumle']==23 )
	{
		$tarif=$tarif * 1.045;
	}// Tarifs 2012 : ajouter 10% au tarifs de base  pour formule 2,3,4 DE SWISSLIFE
	 else if( $row_rsTarifs['nforumle']==1  | $row_rsTarifs['nforumle']==2  | $row_rsTarifs['nforumle']==3  | $row_rsTarifs['nforumle']==4 | $row_rsTarifs['nforumle']==5)
	{
		$tarif=$tarif * 1.05;
	}
	 //####################################################################################
	 //####################################################################################
	 //####################################################################################
	 
		if($clt->conj)
		{
			$tarifConj=$clt->conj->getTarif($row_rsTarifs['nforumle'],$clt->cp);
			$tarifConj= round($tarifConj,2);
			
		}
		else
		{
			$tarifConj=0;
		}

		//sauter si formule non disponible pour le conjoint
		//if($tarifConj==-1) continue;
		//
		
		$tarifEnf=$clt->getTarifEnf($row_rsTarifs['nforumle'],$row_rsTarifs['ncomp']);
		//sauter si formule non disponible pour les enfants
		//if($tarifEnf==-1) continue;
		
	
		$reduction=$clt->getReduction($row_rsTarifs['NOMCMP'],$row_rsTarifs['ngamme']);
			
		$suplemNiv1=$clt->getSupplement($row_rsTarifs['NOMCMP']);
		$suplemNiv2=$clt->getSupplement($row_rsTarifs['NOMCMP'],2);
		
		if($row_rsTarifs['ngamme']==9)
		{	
			$letarif=($tarif+$tarifConj)*$reduction;
			$letarif= $letarif+$tarifEnf;
		}
		else
		{
			$letarif=($tarif+$tarifConj+$tarifEnf)*$reduction;
		}
		
		
		//if($reduction!=0 && $row_rsTarifs['NOMCMP']=="AMIS")//pakah obligatoire si reduction pr amis
		if( $row_rsTarifs['NOMCMP']=="AMIS")
		{
			/*if($row_rsTarifs['ngamme']==4)
			{
				$letarif+=$clt->couple=="seul"?2:4;
					
			}
			else
			{
			$letarif+=$clt->couple=="seul"?3:6;
			}*/
			$letarif+=0.87;
		}
					
		//NOUVEAU TARIFS : ajouter 3.5% au tarif swisslife
		if($row_rsTarifs['NOMCMP']=='SWISSLIFE')
		{
			$letarif=$letarif * 1.035 ;
			// suite � la deuxieme v�rification on va remultiplier par 3,5
			$letarif=$letarif * 1.035 ;
			// suite � la demande d'amine on ajoute  3.19% au tarif swisslife
			$letarif=$letarif * 1.0319 ;
			
			//TARIFS 2012 : multiplier  ajouter 7% au tarif après réduction
			//$letarif=$letarif * 1.07 ;
			
		}

		//NOUVEAU TARIFS : ajouter 3.5% au tarif april
		if($row_rsTarifs['NOMCMP']=='APRIL')
		{
			
			$letarif=$letarif * 1.035 ;
			//TARIFS 2012 : multiplier  ajouter 7% au tarif après réduction
			$letarif=$letarif * 1.07 ;
		}
		
		// suite � la demande d'amine on ajoute  3.19% au tarif AMIS
		if($row_rsTarifs['NOMCMP']=='AMIS')
		{
		    
			//$letarif=$letarif * 1.0319 ;
			//TARIFS 2012 : multiplier  ajouter 7% au tarif après réduction
			//$letarif=$letarif * 1.07 ;
		}
		
		if($row_rsTarifs['NOMCMP']=='LA MUTUELLE VERTE')
		{
			$letarif=$letarif + 0.80 ;
		}
		if($row_rsTarifs['NOMCMP']=='ALPTIS')
		{
		
			if($row_rsTarifs['ngamme']==10)
			{	
				$letarif=$letarif + 2.30 ;
			}
			else if ($row_rsTarifs['ngamme']==9)
			{
				// Pour Divinea 1,2   -10%  a la fin

				if($row_rsTarifs['nforumle']==36 | $row_rsTarifs['nforumle']==37  )
				{
					$letarif=$letarif * 0.9 ;
				}
				// Divinea 3,4 -8%	
				else
				{
				$letarif=$letarif * 0.92 ;
				}
				$letarif=$letarif + 1.55 ;			
			}
		}
   ?>
		<div class="boxprix">
			<h6><?php echo htmlentities($row_rsTarifs['NOMFRML']);    ?></h6>
			<h6 class="doth">.........................</h6>
			<h3>
			<img alt="les tarifs" src="images/compagnie/<?php echo $row_rsTarifs['ncomp']; ?>.png" /></h3>
			<h6 class="doth">.........................</h6>
			<h4>Délai D&#39;attente :</h4>
			<h5><?php echo $row_rsTarifs['ATTENTE']; ?></h5>
			<h4>Hospitalisation :</h4>
			<h5><?php echo $row_rsTarifs['HOSPITAL']==1000?"frais r&eacute;els":$row_rsTarifs['HOSPITAL']."%"; ?>
			</h5>
			<h4>Optique</h4>
			<h5><?php echo $row_rsTarifs['OPTIQUE']; ?>% (<?php echo $row_rsTarifs['FORFAIT_OPTIQUE']; ?> €/an)</h5>
			<h4>Dentaire</h4>
			<h5><?php echo $row_rsTarifs['DENTAIRE']; ?>%</h5>
			<h2 class="buy"><?php 
				  echo round($letarif,2);
				  ?><span>€</span></h2>
			<h5><?php 
			$lien='#';
			if($row_rsTarifs['ngamme']==1)
			$lien='dyn_garantie/swisslife_ma_formule.php?idDevis='.$idDevis;
			else if ( $row_rsTarifs['ngamme']==7 )
			$lien='dyn_garantie/swisslife_astucieuses.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==4 )
			$lien='dyn_garantie/amis_santhia.php?idDevis='.$idDevis;
			elseif ($row_rsTarifs['ngamme']==5 )
			$lien='dyn_garantie/amis_senior.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==3 )
			$lien='dyn_garantie/April-famille.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==6 )
			$lien='dyn_garantie/smam_securite_sante.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==8 )
			$lien='dyn_garantie/la_mutuelle_verte.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==10 )
			$lien='dyn_garantie/alptis_sublima.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==9 )
			$lien='dyn_garantie/alptis_DIVINEA.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==12 )
			$lien='dyn_garantie/alptis_clarea.php?idDevis='.$idDevis;
			elseif ( $row_rsTarifs['ngamme']==13 )
			$lien='dyn_garantie/amis_santhia_jeune.php?idDevis='.$idDevis;			
			else
			$lien='#';
			
			?>
			<input class="tableaux" name="pdf" onclick="javascript:window.open('<?php echo $lien; ?>')" type="button" value="Garantie" /></h5>
			<!--######################## SOUSCRIPTION ################################"-->
			<!--######################## SOUSCRIPTION ################################"-->
			<h5>
			<a class="autre" href="inc_dyn/souscrire-update-table.php?f=<?php echo $row_rsTarifs['NOMFRML'];?>&amp;nf=<?php echo $row_rsTarifs['nforumle'];?>&amp;c=<?php echo $row_rsTarifs['NOMCMP'];?>&amp;nc=<?php echo $row_rsTarifs['ncomp'];?>&amp;t=<?php echo round($letarif,2);?>&amp;tel=<?php echo $telephone ?>&amp;em=<?php echo $email?>&amp;idDevis=<?php echo $idDevis?>">
			Souscrire en ligne</a>
			</h5>
			<!--######################## FIN SOUSCRIPTION ################################"-->
			<!--######################## FIN SOUSCRIPTION ################################"-->
			<!--######################## RECEVOIR LE DEVIS ################################"-->
			<!--######################## RECEVOIR LE DEVIS ################################"-->
			<h5>
			<a class="autre"  href="inc_dyn/mail_Devis.php?f=<?php echo $row_rsTarifs['NOMFRML'];?>&amp;nf=<?php echo $row_rsTarifs['nforumle'];?>&amp;c=<?php echo $row_rsTarifs['NOMCMP'];?>&amp;nc=<?php echo $row_rsTarifs['ncomp'];?>&amp;t=<?php echo round($letarif,2);?>&amp;tel=<?php echo $telephone ?>&amp;em=<?php echo $email?>&amp;idDevis=<?php echo $idDevis?>&amp;ng=<?php echo $row_rsTarifs['ngamme'];?>">
			Recevoir le Devis</a>
			</h5>
			<!--######################## FIN RECEVOIR LE DEVIS ################################"-->
			<!--######################## FIN RECEVOIR LE DEVIS ################################"-->
			<!--######################## CONTACTER NOUS ################################"-->
			<!--######################## CONTACTER NOUS ################################"-->
			<h5>
			<a href="ecrire.php?iframe=true&width=430&height=470" rel="prettyPhoto[iframes]" class="autre">Contacter nous</a>  
			</h5>
			<!--######################## FIN CONTACTER NOUS ################################"-->
			<!--######################## FIN CONTACTER NOUS ################################"-->
		</div>
		<?php } while ($row_rsTarifs = mysql_fetch_assoc($rsTarifs)); ?></div>
	
	</div>

	
	</div>
	<div class="grid_2"><div class="box m_l_5 m_t_25" ><h3>
			<img alt="Etre appele"  src="http://www.assursante.fr/upload/modules/devis/etre_appele.gif"/> 
			Vos Besoin :</h3>
				
				<form method="post" action="comparateur-mutuelle.php">
				
					<select name="slid-opt-input">
					<option value="0"><?php if(!$opt == 0)  $filtre_op = $opt.' %'; else $filtre_op = "Optique"; echo $filtre_op; ?> </option>
					<option value="100">100 %</option>
					<option value="200">200 %</option>
					<option value="300">300 %</option>
					</select> <br />
					<select name="slid-dent-input">
					<option value="0"><?php if(!$dent == 0)  $filtre_dent = $dent.' %'; else $filtre_dent = "Dentaire"; echo $filtre_dent; ?></option>
					<option value="100">100 %</option>
					<option value="200">200 %</option>
					<option value="300">300 %</option>
					</select> <br />
					<select name="slid-hospi-input">
					<option value="0"><?php if(!$hospi == 0)  $filtre_hospi = $hospi.' %'; else $filtre_hospi = "Hospitalisation";  echo $filtre_hospi; ?></option>
					<option value="100">100 %</option>
					<option value="200">200 %</option>
					<option value="300">300 %</option>
					</select> <br />
					<select name="slid-prix-input">
					<option value="0"><?php   echo "Prix" ; ?></option>
					<option value="asc">Du - au + Ch�re</option>
					<option value="desc">Du + au - ch�re</option>
					</select>
					<center>
	

					<?php
					 if ($opt==0 && $hospi==0 && $dent==0 )
					$btn="btn_filter";
					//elseif (!$opt==0 || !$hospi==0 || !$dent==0  )
				//	$btn="btn_filter_a";
					if  (!$prix=='0' || !$opt==0 || !$hospi==0 || !$dent==0  ){		
					$btn="btn_filter_a";}
					else {
					$btn="btn_filter";}
							
					 ?>
					<input id="button" src="images/<?php echo"$btn"; ?>.gif" name="button" type="image"  value="Filtrer" />
					</center></form>

				</div>
				<div class="box m_l_5 p_l_r_0"><input onclick="location.href='devis-mutuelle-etape1.php'"  type="image" src="images/ndevis-btn.png" value="Nouveau devis" /></div>
				
				<div class="box m_l_5"><h3>
			<img alt="Etre appele"  src="http://www.assursante.fr/upload/modules/devis/etre_appele.gif"/>
				Etre appel� :</h3><form action="control/etre_appele.php" method="post" onsubmit="return validateFormOnSubmit(this)"><p class="p_l_r_5 "><input id="NOMPRENOM" name="NOMPRENOM" class="box"  value="Votre Prénom" onblur="if(this.value=='') this.value='Votre Prénom'" onfocus="if(this.value =='Votre Prénom' ) this.value=''" type="text"/>
				<input id="TEL"  class="box" value="Votre Numéro" onblur="if(this.value=='') this.value='Votre Numéro'" onfocus="if(this.value =='Votre Numéro' ) this.value=''" type="text" name="TEL"/><select name="HEUR" id="HEUR" class="box"><option value="">Heur d'appel&nbsp; </option><option>8:00</option>

				<option>9:00</option>
				<option>10:00</option>
				<option>11:00</option>
				<option>12:00</option>
				<option>13:00</option>
				<option>14:00</option>
				<option>15:00</option>
				<option>16:00</option>
				<option>17:00</option>
				<option>18:00</option>
				<option>19:00</option></select><br/><input class="submit" value="envoyer" type="submit"/>
				&nbsp;</p></form></div>

</div>
	

	<div class="clearfix">
	</div>
</div>
			<?php include_once('inc_file/footer.php'); ?>


<?php
 
 	include_once('inc_dyn/function.php'); 
 	//get_ip(); 
	
	mysql_free_result($rsTarifs);
	if ($_GET['Fiche']=1 && !empty($_GET['Fiche']) ) {


$to = 'horizons-plus@orange.fr';

$subject = 'Fich Assursante';

$headers = "From: contact@assursante.fr \r\n";
$headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
$headers .= "CC: amine@sinader.fr\r\n";//zquran@gmail.com
$headers .= "CC: zquran@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$message = '<html><body>';
$message .= '<img src="http://www.assursante.fr/devis-mutuelle/images/assursante.jpg" alt="Assursante.fr" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Nom Client:</strong> </td><td>$clt->nom</td></tr>";
$message .= "<tr><td><strong>Prenom Client :</strong> </td><td>$clt->prenom</td></tr>";
$message .= "<tr><td><strong>Email Client:</strong> </td><td>$clt->email</td></tr>";
$message .= "<tr><td><strong>Telephone Client:</strong> </td><td>$clt->tel</td></tr>";
$message .= "<tr><td><strong>D�partement Client:</strong> </td><td>$clt->cp</td></tr>";
$message .= "<tr><td><strong>Genre de l'adherent principal :</strong> </td><td>$clt->sexe</td></tr>";
$message .= "<tr><td><strong>Date de Naissance  Client :</strong> </td><td>$clt->dateNaiss</td></tr>";
$message .= "<tr><td><strong>Age Client :</strong> </td><td>$age</td></tr>";
$message .= "<tr><td><strong>Regime :</strong> </td><td>$clt->regime</td></tr>";
$message .= "<tr><td><strong>Enfants :</strong> </td><td>$clt->nbrEnfant</td></tr>";
$message .= "<tr><td><strong>Ip Du Client :</strong> </td><td>$ip</td></tr>";

$message .= "</table><br/><br/>";
if($clt->couple<>"couple")
	{
	echo"Pas de Conjoint" ;
	}
	else
	{
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

$message .= "<tr style='background: #eee;'><td><strong>Conjoint Du CLIENTS:</strong> </td><td>------</td></tr>";
$message .= "<tr><td><strong>Date de Naissance Du Conjoint :</strong> </td><td>$conj->naiss</td></tr>";
$message .= "<tr><td><strong>Age Du Conjoint :</strong> </td><td>$ageConj</td></tr>";
$message .= "<tr><td><strong>Regime Du Conjoint :</strong> </td><td>$conj->regime</td></tr>";
$message .= "<tr><td><strong>Sex Du Conjoint :</strong> </td><td>$conj->sexe</td></tr>";
$message .= "</table><br/><br/>";


   }

$message .= "</body></html>";
 mail($to, $subject, $message, $headers);
    }
    else { echo"test no ";}



?>

</body>

</html>
