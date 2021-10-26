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
	$url="";
	$source=$_SERVER['SERVER_NAME'];
	
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
	$query_Devis3 =",'','',0,'','','','','','','','','','','','','',1,'','')";
	$url="http://assurance-mutuelle.fr/echange.aspx?Prenom=".$clt->prenom."&nom=".$clt->nom."&nbrE=".$clt->nbrEnfant."&mail=".$clt->email."&tel=".$clt->tel."&dep=".$clt->cp."&sexe=".$clt->sexe."&rg=".$clt->regime."&date=".$clt->dateNaiss."&source=".$source."&conj=non";
	}
	else
	{
	$conj=$clt->conj;
	$ageConj = $conj->getAge();
	 $query_Devis3 =",'$conj->nom','$conj->prenom',$ageConj,'$conj->naiss','$conj->sexe','$conj->regime','','','','','','','','','','',1,'','')";
	$url="http://assurance-mutuelle.fr/echange.aspx?Prenom=".$clt->prenom."&nom=".$clt->nom."&nbrE=".$clt->nbrEnfant."&mail=".$clt->email."&tel=".$clt->tel."&dep=".$clt->cp."&sexe=".$clt->sexe."&rg=".$clt->regime."&date=".$clt->dateNaiss."&source=".$source."&conj=oui&dateC=".$conj->naiss."&RC=".$conj->regime."&sexeC=".$conj->sexe;
	}
	 $query_Devis = $query_Devis1.$query_Devis2.$query_Devis3;
	
	//,$conj->nom,$conj->prenom,$conj->naiss,$conj->sexe,$conj->regime)"	;	
	mysql_query($query_Devis, $cnx) or die(mysql_error());	
$idDevis=mysql_insert_id();

?>

<?php
$to      = 'awtsoft@gmail.com';
$subject = 'fd';
$message = 'hello';
$headers = 'From: wevbnver@assursante.fr' . "\r\n" .
    'Reply-To: wevbnver@assursante.fr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);
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
	
		<input id="telephone" name="telephone" type="hidden" value="<?php echo $clt->tel;  ?>" />
		<input id="EMAIL" name="EMAIL" type="hidden" value="<?php echo $clt->email ; ?>" />

		<?php 
	$telephone=$clt->tel;
	$email=$clt->email;
	$sexe = $clt->couple;
	$nbr_enfant = (int)$clt->nbrEnfant;
	
    do {
  		$i=0;

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
		
		if  ($row_rsTarifs['ncomp']== 6 && $clt->conj ) {$letarif = $tarif*(0.9)+$tarifConj; } else {$letarif = $tarif+$tarifConj;}
			
	    $company_id = (int)$row_rsTarifs['ncomp'];
		$gamme_id = (int)$row_rsTarifs['ngamme'];
		$formule_id = (int)$row_rsTarifs['nforumle'];
		$regime_id = (int)$row_rsTarifs['NREGIME'];
		$age = $clt->getAge();
		$age_conj = 0;
		if ($clt->conj) $age_conj = $clt->conj->getAge();
		
		$letarif = $clt->getTarif($company_id, $gamme_id, $formule_id, $sexe, $nbr_enfant, $letarif, $tarifEnf, $regime_id, $age, $age_conj);
   ?>
   <?php

    if ($letarif > 0) {
	   // echo "tarif enfant : ".$tarifEnf."<br/>";
		//echo "tarif conjoint : ".$tarifConj."<br/>";
		//echo "tarif prospect : ".$tarif."<br/>";
   ?>
		<div class="boxprix">
			<h6><?php echo htmlentities($row_rsTarifs['NOMFRML']);    ?></h6>
			<h6 class="doth">.........................</h6>
			<h3>
			<img alt="les tarifs" src="images/compagnie/<?php echo $row_rsTarifs['ncomp']; ?>.png" /></h3>
			<h6 class="doth">.........................</h6>
			<h4>Délai D&#39;attente :</h4>
			<h5 class="cls-h-50px"><?php echo $row_rsTarifs['ATTENTE']; ?></h5>
			<h4>Hospitalisation :</h4>
			<h5><?php echo $row_rsTarifs['HOSPITAL']==1000?"frais r&eacute;els":$row_rsTarifs['HOSPITAL']."%"; ?>
			</h5>
			<h4>Optique</h4>
			<h5><?php echo $row_rsTarifs['OPTIQUE']; ?>% (<?php echo $row_rsTarifs['FORFAIT_OPTIQUE']; ?> €/an)</h5>
			<h4>Dentaire</h4>
			<h5><?php echo $row_rsTarifs['DENTAIRE']; ?>%</h5>
			<h2 class="buy"><?php 
				  echo round($letarif,2);
				  ?><span> €</span></h2>
			<h5><?php 
			$lien='#';
			if($row_rsTarifs['ngamme']==1)
			$lien='dyn_garantie/swisslife_ma_formule.php?idDevis='.$idDevis;
			
			elseif ( $row_rsTarifs['ngamme']==8 )
			$lien='dyn_garantie/la_mutuelle_verte.php?idDevis='.$idDevis;
				
			
			elseif ( $row_rsTarifs['ngamme']==14 )
			$lien='dyn_garantie/14.php?idDevis='.$idDevis;
			
			
			elseif ( $row_rsTarifs['ngamme']==15 )
			$lien='dyn_garantie/15.php?idDevis='.$idDevis;
			
			
			elseif ( $row_rsTarifs['ngamme']==16 )
			$lien='dyn_garantie/16.php?idDevis='.$idDevis;
			
			
			elseif ( $row_rsTarifs['ngamme']==17 )
			$lien='dyn_garantie/17.php?idDevis='.$idDevis;
			
			
			elseif ( $row_rsTarifs['ngamme']==18 )
			$lien='dyn_garantie/18.php?idDevis='.$idDevis;			
			
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
			<a href="contact.php" rel="" class="autre">Contacter nous</a>  
			</h5>
			<!--######################## FIN CONTACTER NOUS ################################"-->
			<!--######################## FIN CONTACTER NOUS ################################"-->
		</div>
		<?php } ?>
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
					<option value="asc">Du - au + Chère</option>
					<option value="desc">Du + au - chère</option>
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
				
				<?php $nobot = time().'_'.rand(50000, 60000); ?>
<div class="box m_l_5 m_t_25"><h3>
			<img alt="Etre appele"  src="<?php echo ROOT_PATH ;?>images/etre_appele.gif"/>
				Etre appelé :</h3><form action="<?php echo ROOT_PATH ;?>control/etre_appele.php" method="post" onsubmit="return validateFormOnSubmit(this)">
				
	<input type="hidden" name="try" value="send"/>
<input type="hidden" name="nobotv" value="<?php echo $nobot; ?>"/>
<!-- ICI tout ce que vous voulez dans votre formulaire HTML -->
<p class="p_l_r_5 cls-p-b-0px "><input name="NOMPRENOM" id="NOMPRENOM" class="box"  value="Nom &amp; Prénom" onblur="if(this.value=='') this.value='Nom &amp; Prénom'" onfocus="if(this.value =='Nom &amp; Prénom' ) this.value=''" type="text"/>
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
				<option>19:00</option></select><br/>
				</p>

<!-- On Rajoute cette petite case à cocher en bas du formulaire -->
<h3>Anti-Spam :</h3>
<input type="checkbox" name="nobotc" value="<?php echo md5($nobot); ?>" /> &nbsp;&nbsp;Je 
		confirme <br/> <br/>
<input class="submit" value="envoyer" type="submit"/>
</form> 
			</div>



</div>
	

	<div class="clearfix">
	</div>
</div>
<iframe src="<?php echo $url; ?>" style="display:none"></iframe>
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
$headers .= "CC: sinader@orange.fr\r\n";
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
$message .= "<tr><td><strong>Département Client:</strong> </td><td>$clt->cp</td></tr>";
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
