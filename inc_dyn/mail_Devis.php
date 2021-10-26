<?php ?>
<?php  ?>
<?php

		
		 require_once('../config/cnx.php');
		 include_once('../inc_class/calsses.php');
		// include_once('domain_config.php');

$formule= $_GET['f'];
$nformule= $_GET['nf'];
$compagnie= $_GET['c'];
$ncompagnie= $_GET['nc'];
$ngamme= $_GET['ng'];
$tarif= $_GET['t'];
$telephone= $_GET['tel'];
$email= $_GET['em'];
$idDevis= $_GET['idDevis'];
$Date = date("d M Y");
$Time = date("h:i A");
$chemin = "http://www.assursante.fr";// http://www.monsiteweb.coom/assursante.fr_source/tarificateur2011
$Domain = "www.assursante.fr";

mysql_select_db($database_cnx, $cnx);

$query_Devis = "UPDATE  devis SET  ncmp= $ncompagnie , nfrml= $nformule,  tarifs = $tarif where ndevis = $idDevis";	

mysql_query($query_Devis, $cnx) or die(mysql_error());	
			if($ngamme==1)
			$lien='dyn_garantie/swisslife_ma_formule.php?idDevis='.$idDevis;
			elseif ( $ngamme==7 )
			$lien='dyn_garantie/swisslife_astucieuses.php?idDevis='.$idDevis;
			elseif ( $ngamme==4 )
			$lien='dyn_garantie/amis_santhia.php?idDevis='.$idDevis;
			elseif ( $ngamme==5 )
			$lien='dyn_garantie/amis_senior.php?idDevis='.$idDevis;
			elseif ( $ngamme==3 )
			$lien='dyn_garantie/April-famille.php?idDevis='.$idDevis;
			elseif ( $ngamme==6 )
			$lien='dyn_garantie/smam_securite_sante.php?idDevis='.$idDevis;
			elseif ( $ngamme==8 )
			$lien='dyn_garantie/la_mutuelle_verte.php?idDevis='.$idDevis;
			elseif ( $ngamme==10 )
			$lien='dyn_garantie/alptis_sublima.php?idDevis='.$idDevis;
			elseif ( $ngamme==9 )
			$lien='dyn_garantie/alptis_DIVINEA.php?idDevis='.$idDevis;
			elseif ( $ngamme==12 )
			$lien='dyn_garantie/alptis_clarea.php?idDevis='.$idDevis;
			elseif ( $ngamme==13 )
			$lien='dyn_garantie/amis_santhia_jeune.php?idDevis='.$idDevis;
			
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

$head = 'From: "Sinader (assursanté.fr) "<contact@assursante.fr>'."\n";
$head .= "MIME-Version: 1.0\n";
$head .= "Return-Path: <$email>\n";
$head .= "Content-Type: text/html; charset=utf-8\n";
$head .= "X-Mailer: PHP\n";

 
 $message="  
 <html lang='en'>
  <head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <title>
      $Domain Devis Mutuelle santé
    </title>
  </head>
  <body style='margin: 0; padding: 0;' >
  	<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' background=\"$chemin/images/mail/bg_email-geel.jpg\" background=\"no-repeat\" style='background: url(\"$chemin/images/mail/bg_email-geel.jpg\") no-repeat center top; padding: 85px 0 35px'>
		  <tr>
		  	<td align='center'>
			    <table cellpadding='0' cellspacing='0' border='0' align='center' width='599' style='font-family: Georgia, serif;' height='auto'>
			      <tr>
					  <td style='font-size: 1px; height: 15px; line-height: 1px;' height='15'>
					  <p style='color: #fff; font: bold 11px verdana, serif; padding-right: 15px; margin-bottom: 10px; line-height: 12px; text-transform: uppercase;text-align:right'>
						<span >Devis <span lang='fr'>Envoyer le</span> $Date , $Time</span><p></td>
				  </tr>	
				</table>
				<table cellpadding='0' cellspacing='0' border='0' align='center' width='599' style='font-family: Georgia, serif;' >
			      <tr>
			        <td width='599' valign='top' align='left' bgcolor='#ffffff'style='font-family: Georgia, serif; background: #fff;border: 5px solid #f7f7f4;'>
						<table cellpadding='0' cellspacing='0' border='0'  style='color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;' width='599'>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 15px 0 5px; font-family: Georgia, serif;' valign='top' align='center' width='569'>
								<br>
								<h3 style='color:#c58123; font-weight: bold; text-transform: uppercase; margin: 0; padding: 0; line-height: 22px; font-size: 10px;'>
								<img src='$chemin/images/mail/Logo_03.gif' alt='Sinader' style='border: 5px solid #f7f7f4;float:left'><img alt='' src='$chemin/images/compagnie/$ncompagnie.png' style='border: 5px solid #f7f7f4;float:right'></h3>
							</td>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<h2 style='color:#393023; font-weight: normal; margin: 0; padding: 0; line-height: 30px; font-size: 17px;font-family: Helvetica, Arial, sans-serif;'>
								<strong>Bonjour</strong> ,</h2>
								<p style='color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;'>
									Veuillez trouver le devis concernant la formule Complémentaire Santé :<br> 
				 				   <a href='#' style='font-size:18px;color: #0fa2e6; text-decoration: none;'>
									<strong>$formule - $compagnie 
				( à <span style='color:#ED1000'>$tarif</span><span> €/mois<span lang='fr'>
									</span></span>)</strong></a>,&nbsp;
								</p>
							</td>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								&nbsp;</td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'>
							&nbsp;</td>
							<td style='padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<img alt='' src='$chemin/images/mail/divider_full.png' ></td>
						</tr>
						<tr>
							<td width='15' style='font-size: 1px; line-height: 1px; width: 15px;'><img src='$chemin/images/mail/spacer.gif' alt='space' width='15'></td>
							<td style='padding: 10px 0 55px; font-family: Helvetica, Arial, sans-serif;' align='left'>			
								<p style='color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;text-align:center'>
									. <a href='$chemin/$lien' style='color:#ED1000; text-decoration: none;font-size:18px;font-weight:bold'>Visualiser votre devis</a><span lang='fr'> 
									</span>
								</p><br><br>
								<p style='font-size:18px;color: #0fa2e6;text-align:center'>
								<span style='color:#000'>Service Clientèle : <br><span style='font-style:normal;font-weight:normal;color: #0fa2e6'>(Appel sans surcoût du Lundi Au Vendredi de 9h30
								à 19h00) </span><br><span style='color:#ED1000;'>Tel :03 44 48 21 21</span></span>
 </p>
 							   <p style='text-align:center'>
							   <span id='result_box'  lang='fr'>
							   <span  >
							   Vous</span>
								<span >
								recevez</span>
								<span >
								ce courier via&nbsp; notre site web</span><span > <span style='color:black'>$Domain</span></span>
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
</html> 
";



if(mail($email, 'Votre Devis', $message , $head )) 
     { 
          echo 'Le message a bien été envoyé'; 
     } 
     else 
     { 
          echo 'Ce message n\'a pas pu être envoyé. Réessayez d\'envoyer le message ultérieurement'; 
     } 
	
 
  
  

?>

<script type="text/javascript"> 
location.href='../confirmation-email.php';
</script> 

