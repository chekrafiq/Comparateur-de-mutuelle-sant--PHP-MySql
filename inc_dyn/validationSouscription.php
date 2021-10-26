
	<?php
		
	
		$Date = date("d M Y");
		$Time = date("h:i A");
		$chemin = "http://www.assursante.fr";
		$Domain = "http://www.assursante.fr/";

if (isset($_POST['ADRESSE']))
{
$idDevis=$_POST['idDevis'];
$ADRESSE=$_POST["ADRESSE"];
$CODEPOSTAL=$_POST["CODEPOSTAL"];
$VILLE=$_POST["VILLE"];
$numsecu=$_POST["T1"].$_POST["T2"].$_POST["T3"].$_POST["T4"].$_POST["T5"].$_POST["T6"].$_POST["T7"];
$rib=$_POST["NUMERODECOMPTE1"].$_POST["NUMERODECOMPTE2"].$_POST["NUMERODECOMPTE3"].$_POST["NUMERODECOMPTE4"];
$dateEffect=$_POST["dateEffect"];
$datePre=$_POST["datePre"];
$typePaiment=$_POST["TYPEPRELEVEMENT"];
//##############################info conjoint#######################################
$NOMConj=$_POST["NOMConj"];
$PRENOMConj=$_POST["PRENOMConj"];
$DateConj=$_POST["DateConj"];
$numsecuConj=$_POST["TC1"].$_POST["TC2"].$_POST["TC3"].$_POST["TC4"].$_POST["TC5"].$_POST["TC6"].$_POST["TC7"];


$nom=$_POST["NOM"];
$prenom=$_POST["PRENOM"];
$tel=$_POST["TEL"];
$email=$_POST["EMAIL"];

$NOMBonq=$_POST["NOMBonq"];
$ADRBonq=$_POST["ADRBonq"];

$myPattern = '/^                        # début de chaîne
(?<sexe>[12])                           # 1 ou 2 pour le sexe
(?<naissance>[0-9]{2}(?:0[1-9]|1[0-2])) # année et mois de naissance (aamm)
(?<departement>2[AB]|[0-9]{2})          # le département
(?<numserie>[0-9]{6})                   # numéro de série sur six chiffres
(?<controle>[0-9]{2})?                  # numéro de contrôle (facultatif)  
$                                       # fin de chaîne
/x';


if (preg_match($myPattern, $numsecu, $match) //&& RIB_FR::verifierRib($_POST["NUMERODECOMPTE1"], $_POST["NUMERODECOMPTE2"], $_POST["NUMERODECOMPTE3"], $_POST["NUMERODECOMPTE4"])
) 

{

mysql_select_db($database_cnx, $cnx);

$query_Devis = "UPDATE  devis SET NomProspect='$nom',PrenomProspet='$prenom',tel='$tel', email='$email',  ADRESSE= '$ADRESSE' , CodePostal= '$CODEPOSTAL',  ville = '$VILLE'  , nsecu= '$numsecu',  rib= '$rib', dateEffect= '$dateEffect', datePrelev= '$datePre', EstSouscris= 'OUI',typePaiment='$typePaiment'
,nomConjoint='$NOMConj',prenomConjoint='$PRENOMConj',nsecuConjoint='$numsecuConj',NOMBonq='$NOMBonq', ADRBonq='$ADRBonq'  where ndevis = $idDevis";	

mysql_query($query_Devis, $cnx) or die(mysql_error());
//##############################info Enfants#######################################
$nbrenfants=$_POST["nbrenfants"];

if($nbrenfants>0)
{
	for ( $i=1;$i<$nbrenfants+1;$i++)
	{
	$nomEnfant= $_POST["NOMenfant$i"];  // "NOMenfant".$i;
	$prenomenfant=$_POST["PRENOMenfant$i"];
	$dateEnfant=$_POST["DATEenfant$i"];
		$query_enfant = "INSERT INTO enfants_souscris  VALUES ('','$nomEnfant','$prenomenfant','$dateEnfant',$idDevis)";	
		mysql_query($query_enfant, $cnx) or die(mysql_error());
	}
}


//##############################info Enfants#######################################

$query = "select * from vw_devis where ndevis = $idDevis";

$rsDevis = mysql_query($query, $cnx) or die(mysql_error());
$row_rsDevis = mysql_fetch_assoc($rsDevis);
 do {
 $ncmp=$row_rsDevis['ncmp'];
 $formule=$row_rsDevis['nomfrml'];
 $compagnie=$row_rsDevis['nomcmp'];
 $tarifs=$row_rsDevis['tarifs'];

 } while ($row_rsDevis = mysql_fetch_assoc($rsDevis)); 


mysql_free_result($rsDevis);




$message="
<html lang='en'>
  <head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <title>
      $Domain demande d'adhésion </title>
  </head>
  <body style='margin: 0; padding: 0;' >
  	<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' background=\"$chemin/images/bg_email-bleu.gif\" background=\"no-repeat\" style='background: url(\"$chemin/images/bg_email-roug.jpg\") no-repeat center top; padding: 85px 0 35px'>
		  <tr>
		  	<td align='center'>
			    <table cellpadding='0' cellspacing='0' border='0' align='center' width='599' style='font-family: Georgia, serif;' height='auto'>
			      <tr>
					  <td style='font-size: 1px; height: 15px; line-height: 1px;' height='15'>
					  <p style='color: #fff; font: bold 11px verdana, serif; padding-right: 15px; margin-bottom: 10px; line-height: 12px; text-transform: uppercase;text-align:right'>
						<span >Demande d'adhésion <span lang='fr'>Envoyer le</span> $Date , $Time, </span><p></td>
				  </tr>	
				</table><!-- header-->
				<table cellpadding='0' cellspacing='0' border='0' align='center' width='599' style='font-family: Georgia, serif;' >
			      <tr>
			        <td width='599' valign='top' align='left' bgcolor='#ffffff'style='font-family: Georgia, serif; background: #fff;border: 5px solid #f7f7f4;'>
						<table cellpadding='0' cellspacing='0' border='0'  style='color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;' width='599'>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 15px 0 5px; font-family: Georgia, serif;' valign='top' align='center' width='569'>
								<br>
								<h3 style='color:#c58123; font-weight: bold; text-transform: uppercase; margin: 0; padding: 0; line-height: 22px; font-size: 10px;'>
								<img src='$chemin/images/Logo_03.gif' alt='Sinader' style='border: 5px solid #f7f7f4;float:left'><img alt='' src='$chemin/images/compagnie/$ncmp.png' style='border: 5px solid #f7f7f4;float:right'></h3>
							</td>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<h2 style='color:#393023; font-weight: normal; margin: 0; padding: 0; line-height: 30px; font-size: 17px;font-family: Helvetica, Arial, sans-serif;'>
								<strong>Bonjour</strong> ,</h2>
								<p style='color:; font-weight: normal; margin: 0; padding: 0;font-size:12px '>
									Vous venez d'effectuer une demande d'adhésion à  une Complémentaire Santé sur notre site <span class='' title=''> <span style='color:#000'>$Domain<span >
									</span></span> Cette demande d'adhésion a bien été  prise en compte et concerne la formule Complémentaire Santé</span> : <br>
									<span ></span><br> 
				 				   <a href='#' style='font-size:18px;color: #0fa2e6; text-decoration: none;'>
									<strong>$formule - $compagnie 
				( à <span style='color:#ED1000'>$tarifs</span><span> €/mois<span lang='fr'>
									</span></span>)</strong></a>,&nbsp;
								</p>
							</td>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								&nbsp;</td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'>
							&nbsp;</td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<img alt='' src='$chemin/images/divider_full.png' ></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 55px; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<p style='font-size:18px;color: #0fa2e6;text-align:center'>
								<span style='color:#000'>Service Adhésion : <br><span style='font-style:normal;font-weight:normal;color: #0fa2e6'>(Appel sans surcoût du Lundi Au Vendredi de 9h30
								à 19h00) </span><br><span style='color:#ED1000;'>Tel :03 44 48 21 21</span></span>
 </p><p><span>Nota 
		Bene :<br ><span style='color:#000;font-weight:bold'>Toute souscription à une Complémentaire Santé par l&#39;intermédiaire 
		de Sinader signifie que :
</span><br><br><span >- je reconnais avoir lu et accepté
		<a style='color:black;text-decoration:none' href='$chemin/condition.html' target='_blank'>
		les conditions générales de ventes </a>&nbsp;Sinader,<br >
		<span>- je reconnais avoir lu et approuvé le formulaire d&#39;adhésion, les 
		conditions générales de ventes associées ainsi que les garanties de la 
		formule <span >,</span></span><br>
</span>
</span></p><p><span style='color:black;font-weight:bold'>Cordialement,</span></p>
 							   <p style='text-align:center'>
							   <span id='result_box' class='' lang='fr'>
							   <span class='hps' title=''>
							   Vous</span>
								<span class='hps' title=''>
								recevez</span>
								<span class='hps' title=''>
								ce courier via&nbsp; notre site web</span><span class='' title=''> <span style='color:black'>$Domain</span></span>
								</span></p>
							</td>
						</tr>  
						</table>	
					</td>
			      </tr>
				 </table><!-- body -->
				<!-- footer-->
		  	</td>
		</tr>
    </table>
  </body>
</html>";
$headers ='From: "Sinader (assursanté)"<contact@assursante.fr>'."\n"; 
$headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
$headers .= "CC: horizons-plus@orange.fr\r\n";

$headers .='Content-Type: text/html; charset="utf-8"'."\n"; 
$headers .='Content-Transfer-Encoding: 8bit'; 
mail($email, 'Votre Adhésion sur Assursante.fr', $message , $headers );
?>
	<?php
echo '	<div class="success message_box_wrap" >Votre souscription est <span><strong>Validée</strong></span><br><span>Votre confirmation d’adhésion vient d’être envoyée sur votre adresse email .</span><br><span><strong>Merci de nous avoir fait confiance.<br/>Cordialement </strong></span><br>

<span>Pour toute information n’hésitez pas à nous contacter au <span style=\'color:red\'>0344482121</span> ou par email : <span><strong>contact@assursante.fr</strong></span></span></div>';
include('inc_dyn/mail_Sou_AD.php');
 }
else
{
echo '<div class="error message_box_wrap"> le numéro de sécurité social que vous avez saisie  ou Le RIB est incorrect !</div>';

}
}
	?>

