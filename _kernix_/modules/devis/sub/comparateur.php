<?php
//session_start();
require_once('Connections/cnx.php');
include_once("inclusions/calsses.php");

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

if (isset($_POST['REGIME'])){
  $clt=new Client($_POST['NOM'], $_POST['PRENOM'], $_POST['JOUR']."-".$_POST['MOIS']."-".$_POST['ANNEE'], $_POST['ENFANTS'], $_POST['SEXE'], $_POST['COUPLE'], $_POST['REGIME'], substr($_POST['CP'],0,2), $_POST['EMAIL'], $_POST['telephone']);
  if ($clt->couple=="couple"){
    $conj=new Conjoint($_POST['NOMC'], $_POST['PRENOMC'], $_POST['ANNEEC'], ($_POST['SEXE']=="homme"?"femme":"homme"), $_POST['REGIMEC']);
    $clt->conj=$conj;
  }else $clt->conj=NULL;

  $_SESSION["client"]=serialize($clt);
  //	$_SESSION["conjoint"]=serialize($clt->conj);
}//fin si formulaire

//recuperation des data sessions
$clt=unserialize($_SESSION["client"]);
//	$clt->conj=unserialize($_SESSION["conjoint"]);

// Envoi par mail de la fiche prospect ï¿½ Assusante
$headers ='From: "ASSURSANTE"<contact@assursante.fr>'."\n";
$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';
$infosdemandeur = "Informations sur le demandeur :\n";
$infosdemandeurconjoint = "Informations sur le conjoint du demandeur :\n";
$couple_flag = 0;
foreach($clt as $kclt => $vclt) {
  if ($kclt=="couple" && $vclt=="couple") $couple_flag = 1;
  if ($kclt=="conj" && $couple_flag==1) {
    foreach($vclt as $kconj => $vconj) {
      $infosdemandeurconjoint .= "- ".$kconj." : ".$vconj." ;\n";
    }
    continue;
  }
  $infosdemandeur .= "- ".$kclt." : ".$vclt." ;\n";
}
if ($couple_flag==1) $infosdemandeur .= $infosdemandeurconjoint;
mail("contact@assursante.fr", 'Fiche prospect du site assursante.fr', $infosdemandeur, $headers);
// Fin


// ENREGISTREMENT DU CLIENT
$l_sql = "INSERT INTO $table_client SET firstname = '".$c_db->protect($clt->prenom)."', lastname = '".$c_db->protect($clt->nom)."', email1 = '".$c_db->protect($clt->email)."', phone = '".$c_db->protect($clt->telephone)."', date = '$l_date', idportzone = 1";
//echo "$l_sql";
$c_db->query($l_sql);
$p_idclient = $c_db->get_id();
$l_sql = "UPDATE $table_visitor SET idclient = '$p_idclient' WHERE idvisitor = '$g_idvisitor'";
//echo "$l_sql";
$c_db->query($l_sql);
//$tab_params["idclient"] = $p_idclient;

$l_sql = "REPLACE INTO $table_email (idegroup,idvisitor,emailkey,email,opt,source,flagpref,date) VALUES ('3','$g_idvisitor','3-".$c_db->protect($clt->email)."','".$c_db->protect($clt->email)."','IN','CLIENT','"."','$l_date')";
//echo "$l_sql";
$c_db->query($l_sql);


// ENREGISTREMENT DE LA SESSION
$l_sql = "INSERT INTO $table_numsession (idvisitor,date) VALUES ('$g_idvisitor','$l_date')";
//echo "$l_sql";
$c_db->query($l_sql);
$g_numsession = $c_db->get_id();

//$l_sql = "DELETE FROM $table_session WHERE numsession = '".$g_numsession."'";
//echo "$l_sql";
//$c_db->query($l_sql);

$l_sql = "INSERT INTO $table_session (numsession, status, idref, idproduct, productcode, quantity, options, description, priceht, pricettc, purchasepriceht, taxe, currency, idport, portvalue, idsupplier, icon, date) VALUES ('".$g_numsession."', '2', '$p_idref', '1', 'NA', '1', '', '".$c_db->protect($infosdemandeur)."', '0', '0', '0', '19.60', 'EUR', '0', '0', '0', '', '$l_date')";
//echo "$l_sql";
$c_db->query($l_sql);


$l_sql = "INSERT INTO $table_command (numsession, status, date) values ('".$g_numsession."', '2', '$l_date')";
//echo "$l_sql";
$c_db->query($l_sql);
$g_idcommand = $c_db->get_id();

$l_sql = "UPDATE $table_session SET billdate = '$l_date' WHERE numsession = '".$g_numsession."'";
//echo "$l_sql";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_command SET billdate = '$l_date', idclient = '".$p_idclient."', status = '2', mode = 'NONE', quantity = 1, priceht = '0', pricettc = '0', pricettcport = '0', currency = 'EUR' WHERE idcommand = '".$g_idcommand."'";
//echo "$l_sql";
$c_db->query($l_sql);


$opt=0;
$hospi=0;
$dent=0;
if(isset($_POST["slid-opt-input"]))
{
  $opt=$_POST["slid-opt-input"];
  $hospi=$_POST["slid-hospi-input"];
  $dent=$_POST["slid-dent-input"];
}


mysql_select_db($database_cnx, $cnx);
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



//echo $query_rsTarifs;


$rsTarifs = mysql_query($query_rsTarifs, $cnx) or die(mysql_error());
$row_rsTarifs = mysql_fetch_assoc($rsTarifs);




?>

<style type="text/css">
* {
	margin: 0px;
}
.classh1 {
	background-position: right bottom;
	color: #fc0019;
	font-family: "times New Roman", Times, serif;
	margin-top: 15px;
	padding-left: 15px;
	background-image: url('/_kernix_/modules/devis/sub/images/upf.jpg');
	background-repeat: no-repeat;
	height: 33px;
	margin-bottom: 15px;
	width:616px;
}
.classh1up {
	background-position: right bottom;
	margin-top: 15px;
	padding-left: 15px;
	background-image: url('/_kernix_/modules/devis/sub/images/dwf.gif');
	background-repeat: no-repeat;
	height: 26px;
	margin-bottom: 15px;
	width:616px;
}
.grille {
	width: 615px;
	height: 438px;
	float: left;
	margin-left: 10px;
	overflow: auto;
	margin-bottom: 10px;
}
.grille div {
	border: 1px solid #e8e8e8;
	height: 430px;
	width: 144px;
	float: left;
	margin-right: 2px;
	margin-bottom: 10px;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.grille div:hover {
	border: 1px solid #FC0019;
}
.grille div h6 {
	padding: 5px;
	margin-top: 15px;
	margin-bottom: 0px;
	font-family: "times New Roman", Times, serif;
	font-size: 14px;
	background-color: #f3f3f3;
	line-height: 14px;
	text-align: center;
}
.grille div h6.doth {
	padding: 0px;
	margin: 0px;
	font-family: "times New Roman", Times, serif;
	font-size: 14px;
	background-color: #fff;
	line-height: normal;
	font-weight: normal;
}
.grille div h3 {
	text-align: center;
}
.grille div h3 a img {
	border-style: none;
	border-width: none;
}
.grille div h4 {
	text-align: center;
	color: #6b6b6b;
	font-size: 12px;
	font-family: verdana, Geneva, Tahoma, sans-serif;
}
.grille div h5 {
	text-align: center;
	color: #000000;
	margin-bottom: 4px;
	font-family: georgia, "Times New Roman", Times, serif;
	font-size: 12px;
}
.grille div h2.buy {
	text-align: center;
	color: #287dc7;
	margin-bottom: 8px;
	font-family: georgia, "Times New Roman", Times, serif;
	font-size: 22px;
	font-weight: bold;
}
.grille div h2 {
	text-align: center;
	color: #e30d0d;
	margin-bottom: 15px;
	font-size: 24px;
}
.grille div h5 a {
	width: 135px;
	height: 25px;
	font-family: verdana, Geneva, Tahoma, sans-serif;
	font-weight: normal;
	font-size: 12px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	line-height: 25px;
	background-repeat: repeat-x;
	display: block;
	margin-left: auto;
	margin-right: auto;
	text-decoration: none;
}
.grille div h5 input{
	padding: 0px;
	border-style: none !important;
	width: 135px;
	height: 25px;
	font-family: verdana, Geneva, Tahoma, sans-serif;
	font-weight: normal;
	font-size: 12px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	line-height: 33px;
	cursor: pointer;
	background-repeat: repeat-x;
	border: 0px;
}
.grille div h5 input:hover,.grille div h5 a:hover {
	-webkit-box-shadow: 1px 1px 3px #696969;
	-moz-box-shadow: 1px 1px 3px #696969;
	box-shadow: 1px 1px 3px #696969;
}
.grille div h5 input.tableaux,.grille div h5 a.tableaux {
	background-image: url('_kernix_/modules/devis/sub/images/btn_tableaux.gif');
	color: #FFCC00;
	font-weight: normal;
	font-size: 12px;
}
.grille div h5 input.tableaux:hover {
	color: #FFDD55;
}
.grille div h5 input.autre,.grille div h5 a {
	background-image: url('_kernix_/modules/devis/sub/images/btn_souscrire.gif');
	color: #000000;
	font-weight: bolder;
	font-size: 12px;
}
#Contenair {
	width: 816px;
	margin-left: auto;
	margin-right: auto;
}
#Contenair h1 {
}
#Contenair div.header {
	background-image: url('_kernix_/modules/devis/sub/images/header-page.jpg');
	height: 131px;
}
#Contenair div.footer {
	background-image: url('_kernix_/modules/devis/sub/images/footer.jpg');
	height: 49px;
	background-repeat: no-repeat;
}
#Contenair div.right {
	height: 490px;
	width: 641px;
	float: left;
}
#Contenair div.left {
	height: auto;
	width: 161px;
	float: right;
	margin-right: 15px;
}
#Contenair div.left div#box {
	height: auto;
	width: auto;
	margin-bottom: 15px;
}
#Contenair div.left div#box div.middle {
	height: auto;
	width: auto;
	background-image: url('_kernix_/modules/devis/sub/images/middle-boxfilter.jpg');
	padding-top: 10px;
	background-repeat: repeat-y;
}
#Contenair div.left div#box div.middle select {
	width: 85%;
	margin-left: 10px;
	margin-right: 10px;
	margin-bottom: 5px;
	border-style: none;
	border-width: 0px;
}
#Contenair div.left div#box div.middle select.optique {
	background-color: #297DC8;
}
#Contenair div.left div#box div.middle select.Dentair {
	background-color: #33A02C;
}
#Contenair div.left div#box div.middle select.hospi {
	background-color: #FB0019;
}
#Contenair div.left div#box div.bottom {
	height: 7px;
	background-image: url('_kernix_/modules/devis/sub/images/bottom-box-filter.jpg');
}
.single_news_container {
	display: none;
}
/*  BELLOW IS JUST STYLING, NOT REQUIRED FOR THIS TO WORK  */
/* just styling */
/* style the h3 (title) in the news container */
/* style the navigation div */
#news_navigation {
	position: relative;
	color: #FFFFFF;
}
/* style */
#all_news_container {
	padding: 10px;
	color: black;
	height: 530px;
}
/* if you want this app to have a specific width, just make a specific width for wrapper div */
#wrapper {
	width: 580px;
	margin-bottom: 15px;
	float: left;
}
#filter {
	width: 300px;
	margin-right: auto;
	margin-left: auto;
	padding-top: 10px;
	padding-right: 10px;
	padding-left: 10px;
}
#filter li {
	list-style-type: none;
	width: 50%;
	float: left;
	padding-bottom: 4px;
	text-align: center;
}
#filter li label {
	width: 100%;
	font-family: georgia, "Times New Roman", Times, serif;
	font-size: 18px;
	color: #FC0019;
}
#filter li select {
	width: 100%;
	margin-bottom: 7px;
	background-color: #fff;
	border: 1px solid #ddd;
	color: #333333;
	font: 16px Arial, Helvetica, sans-serif;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	height: 28px;
}
#filter li select.left {
	float: right;
	width: 96%;
}
</style>
<script src="_kernix_/modules/devis/sub/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

  //show the first signe news container using fadeIn
  $('.single_news_container:first').fadeIn(100);
  /*add news_visible class to the same container
  important: this class has no css effects, it's only used so we can know which
  news container is currently shown '*/
  $('.single_news_container:first').addClass('news_visible');

  //DECLARE VARIABLES WE WILL NEED
  var news_No = $('.single_news_container').length; //get number of single news containers
  var prev_html = '<img border=0 src="images/prev.png" style="vertical-align:middle;position: absolute;top: 250px;left: -8px">'; //the html inside <a>  for previous news
  var next_html = '<img border=0 src="images/next.png" style="vertical-align:middle;position: absolute;top: 250px;right: -0px">'; //the html inside <a>  for next news

  //fill the news_navigation container with the navigation html
  $('#news_navigation').html('<a href="javascript:prev_news();">' + prev_html + '</a> <span style="display: none" id="current_news_num">1</span>/' + news_No +' <a href="javascript:next_news();">' + next_html + '</a>');
  /* explanation: we have - previous link , current news number, / , amount of news, next link
  so it looks like &lt; 1/5 &gt. As you can see in the href attribute inside our two <a> are
  links to function we will declare bellow, so when clicked those functions are called*/

});

//now we start our functions

function prev_news(){

  //check if there is a single news container before the current visible container...
  if($('.news_visible').prev('.single_news_container').length){

    //... and if there is we hide the current visible news container by using fadeOut...
    $('.news_visible').fadeOut(100, function(){
      /*...and when the animation ends we have few chain events.
      explanation: we first remove the news_visible class from the current visible news container
      and apply it to the previous news container, and show that container by using fadeIn()...*/
      $('.news_visible').removeClass('news_visible').prev('.single_news_container').addClass('news_visible').fadeIn(100);
      //... then we get the current page number and using parseInt we convert it from text to number (string to integer)...
      var current = parseInt($('#current_news_num').text());
      //...and change the current page number
      $('#current_news_num').text(current - 1);
    });
  }

}

/*bellow we make a function for next_news. I wont explain it line by line because it's almost the same like the previous function.
the difference:
1) instead of checking if there is previous news (by using prev()) we check if there is by using next()
2) and in the chained events we change the prev() to next() so we show the next news div  '*/
function next_news(){
  if($('.news_visible').next('.single_news_container').length){
    $('.news_visible').fadeOut(100, function(){
      $('.news_visible').removeClass('news_visible').next('.single_news_container').addClass('news_visible').fadeIn(100);
      var current = parseInt($('#current_news_num').text());
      $('#current_news_num').text(current + 1);
    });
  }
}

</script>

<div id="Contenair">

	<h1 class="classh1" >Comparatif personnalis&eacute; </h1>
	<div style="clear: both">
	</div>
	<div style="clear: both">
	</div>
	<div class="grille">
	<input name="telephone" type="hidden" id="telephone" value="<?php echo $clt->telephone;  ?>" />
	<input name="EMAIL" type="hidden" id="EMAIL" value="<?php echo $clt->email ; ?>" />
	<?php
	$telephone=$clt->telephone;
	$email=$clt->email;
	do {

	  $tarif=round($row_rsTarifs['TARIF'],2);
	  if($clt->conj){
	    $tarifConj=$clt->conj->getTarif($row_rsTarifs['nforumle'],$clt->cp);
	    $tarifConj= round($tarifConj,2);
	  }else $tarifConj=0;
	  //sauter si formule non disponible pour le conjoint
	  if($tarifConj==-1) continue;
	  //

	  $tarifEnf=$clt->getTarifEnf($row_rsTarifs['nforumle']);
	  //sauter si formule non disponible pour les enfants
	  if($tarifEnf==-1) continue;
	  //

	  $reduction=$clt->getReduction($row_rsTarifs['NOMCMP']);

	  $suplemNiv1=$clt->getSupplement($row_rsTarifs['NOMCMP']);
	  $suplemNiv2=$clt->getSupplement($row_rsTarifs['NOMCMP'],2);

	  $letarif=($tarif+$tarifConj+$tarifEnf)*$reduction;

	  if($reduction!=0 && $row_rsTarifs['NOMCMP']=="AMIS")//pakah obligatoire si reduction pr amis
	  $letarif+=$clt->couple=="seul"?2:4;
	  //$letarif+=0.87;

	  //NOUVEAU TARIFS : ajouter 3.5% au tarif swisslife
	  if($row_rsTarifs['NOMCMP']=='SWISSLIFE')
	  {
	    $letarif=$letarif * 1.035 ;
	    // suite ï¿½ la deuxieme vï¿½rification on va remultiplier par 3,5
	    $letarif=$letarif * 1.035 ;

	  }

	  //NOUVEAU TARIFS : ajouter 3.5% au tarif april
	  if($row_rsTarifs['NOMCMP']=='APRIL')
	  {
	    $letarif=$letarif * 1.035 ;
	  }

	  //NOUVEAU TARIFS : ajouter 0% au tarif AMIS
	  if($row_rsTarifs['NOMCMP']=='AMIS')
	  {
	    $letarif=$letarif * 1.09 ;
	  }

   ?>
		<div>

			<h6><?php echo htmlentities($row_rsTarifs['NOMFRML']);    ?>

			</h6>
			<h6 class="doth">.........................</h6>

			<h3><a href="#default">
			<img alt="les tarifs" src="_kernix_/modules/devis/sub/img/<?php echo $row_rsTarifs['ncomp']; ?>.png" /></a></h3>
			<h6 class="doth">.........................</h6>
			<h4>Délai D&apos;attente :</h4>
			<h5><?php echo $row_rsTarifs['ATTENTE']; ?></h5>
			<h4>Hospitalisation :</h4>
			<h5><?php echo $row_rsTarifs['HOSPITAL']==1000?"frais r&eacute;els":$row_rsTarifs['CONSULTATION']."%"; ?></h5>
			<h4>Optique</h4>
			<h5><?php echo $row_rsTarifs['OPTIQUE']; ?> % (<?php echo $row_rsTarifs['FORFAIT_OPTIQUE']; ?>&euro;/an)</h5>
			<h4>Dentaire</h4>
			<h5><?php echo $row_rsTarifs['DENTAIRE']; ?> %</h5>
			<h2 class="buy"><?php
			echo round($letarif,2);
				  ?> <span>&euro;</span></h2>
			<h5>
			<?php
			$lien='#';
			if($row_rsTarifs['ngamme']==1)
			$lien='_kernix_/modules/devis/sub/Tableau/swisslife_ma_formule.html';
			else if ( $row_rsTarifs['ngamme']==7 )
			$lien='_kernix_/modules/devis/sub/Tableau/swisslife_astucieuses.html';
			elseif ( $row_rsTarifs['ngamme']==4 )
			$lien='_kernix_/modules/devis/sub/Tableau/amis_santhia.html';
			elseif ($row_rsTarifs['ngamme']==5 )
			$lien='_kernix_/modules/devis/sub/Tableau/amis_senior.html';
			elseif ( $row_rsTarifs['ngamme']==3 )
			$lien='_kernix_/modules/devis/sub/Tableau/April-famille.html';
			elseif ( $row_rsTarifs['ngamme']==6 )
			$lien='_kernix_/modules/devis/sub/Tableau/smam_securite_sante.html';
			else
			$lien='#';
			?>
			<input class="tableaux" name="pdf" type="button" value="Tableaux de garantie" onclick="javascript:window.open('<?php echo $lien; ?>')" /></h5>

			<!--######################## SOUSCRIPTION ################################"-->
			<!--######################## SOUSCRIPTION ################################"-->
			<h5>
			<a class="autre" href="/?p_idref=<?=$p_idref?>&p_devisaction=etape&p_devissubaction=mail&p_etape=<?=$p_etape?>&f=<?php echo $row_rsTarifs['NOMFRML'];?>&c=<?php echo $row_rsTarifs['NOMCMP'];?>&t=<?php echo round($letarif,2);?>&info=<?=urlencode($infosdemandeur)?>&finfo=<?=urlencode($row_rsTarifs['ATTENTE']."-".$row_rsTarifs['HOSPITAL']."-".$row_rsTarifs['CONSULTATION']."-".$row_rsTarifs['OPTIQUE']."-".$row_rsTarifs['FORFAIT_OPTIQUE']."-".$row_rsTarifs['DENTAIRE']."-".$lien)?>" target="_blank">Souscrire</a>

			</h5>
			<!--######################## FIN SOUSCRIPTION ################################"-->
			<!--######################## FIN SOUSCRIPTION ################################"-->
			<h5>
			<a class="autre" href="/?p_idref=<?=$p_idref?>&p_devisaction=etape&p_devissubaction=mail&p_etape=<?=$p_etape?>&f=<?php echo $row_rsTarifs['NOMFRML'];?>&c=<?php echo $row_rsTarifs['NOMCMP'];?>&t=<?php echo round($letarif,2);?>&tel=<?php echo $telephone ?>&em=<?php echo $email?>&finfo=<?=urlencode($row_rsTarifs['ATTENTE']."-".$row_rsTarifs['HOSPITAL']."-".$row_rsTarifs['CONSULTATION']."-".$row_rsTarifs['OPTIQUE']."-".$row_rsTarifs['FORFAIT_OPTIQUE']."-".$row_rsTarifs['DENTAIRE']."-".$lien)?>" target="_blank">Recevoir le Devis</a>
			</h5>
			<!--######################## CONTACTER NOUS ################################"-->
			<!--######################## CONTACTER NOUS ################################"-->
			<h5>
			<a class="autre" href="/?p_idref=12" target="_blank">Contacter nous</a>
			</h5>
			<!--######################## CONTACTER NOUS ################################"-->
			<!--######################## CONTACTER NOUS ################################"-->

		</div>
	<?php } while ($row_rsTarifs = mysql_fetch_assoc($rsTarifs)); ?>
	</div>

	<div class="left"   style="display: none;">
		<div id="box">
			<div>
				<img alt="image for box" src="images/Header-box-filter.jpg" /></div>
					<form method="post">
			<div class="middle">

				<select name="slid-opt-input" >
				<option  value="0">Optique</option>
				<option value="100" >100%</option>
				<option value="200">200%</option>
				<option value="300">300%</option>
				</select>
<br>
				<select name="slid-dent-input" >
				<option value="0">Dentaire</option>
				<option value="100" >100%</option>
				<option value="200">200%</option>
				<option value="300">300%</option>
				</select>
<br>
				<select name="slid-hospi-input" >
				<option  value="0">Hospitalisation</option>
				<option value="100" >100%</option>
				<option value="200">200%</option>
				<option value="300">300%</option>
				</select>
<br>
				<center>

				<input type="submit" name="button" id="button" value="Filtrer" />

				</center>
				</div>
				</form>

			<div class="bottom">
			</div>

		</div>

		<input src="images/devis-btn.gif" type="image"/>
		<img alt="info" src="images/page-5-assursante-2-copy_17.jpg" />
		<div id="box">
		</div>

	</div>
	<div style="clear: both">
	</div>
	<div class="classh1up"></div>

</html>
<?php
mysql_free_result($rsTarifs);
?>