<?php 
/////////////////// Mail //////////////////////////
$query2 = "SELECT * FROM devis WHERE  NDEVIS = $idDevis";
$rsMail = mysql_query($query2, $cnx) or die(mysql_error());
$row_rsMail = mysql_fetch_assoc($rsMail);
 do {
 $NomProspect=$row_rsMail['NomProspect'];
 $PrenomProspet=$row_rsMail['PrenomProspet'];
 $sexeProspet=$row_rsMail['sexeProspet'];
 $coupleProspet=$row_rsMail['coupleProspet'];
 $dateNaissance=$row_rsMail['dateNaissance'];
 $AgeProspet=$row_rsMail['AgeProspet'];
 $regime=$row_rsMail['regime'];
 $nbrEnfant=$row_rsMail['nbrEnfant'];
 $departement=$row_rsMail['departement'];
 $emaill=$row_rsMail['email'];
 $tell=$row_rsMail['tel'];
 $dateDevis=$row_rsMail['dateDevis'];
 $nomConjoint=$row_rsMail['nomConjoint'];
 $prenomConjoint=$row_rsMail['prenomConjoint'];
 $dateNaissanceConj=$row_rsMail['dateNaissanceConj'];
 $ageConjoint=$row_rsMail['ageConjoint'];
 $sexeConjoint=$row_rsMail['sexeConjoint'];
 $regimeConjoint=$row_rsMail['regimeConjoint'];
 $Adresse=$row_rsMail['Adresse'];
 $CodePostal=$row_rsMail['CodePostal'];
 $ville=$row_rsMail['ville'];
 $nsecu=$row_rsMail['nsecu'];
 $nsecuConjoint=$row_rsMail['nsecuConjoint'];
 $rib=$row_rsMail['rib'];
 $typePaiment=$row_rsMail['typePaiment'];
 $dateEffect=$row_rsMail['dateEffect'];
 $datePrelev=$row_rsMail['datePrelev'];
 $NOMBonq=$row_rsMail['NOMBonq'];
 $ADRBonq=$row_rsMail['ADRBonq'];


 } while ($row_rsMail = mysql_fetch_assoc($rsMail)); 


mysql_free_result($rsMail);


/////////////////// Mail //////////////////////////

$to = 'horizons-plus@orange.fr';

$subject = 'Fich Adhésion assursanté';

$headers = "From: contact@assursante.fr \r\n";
$headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
$headers .= "CC: amine@sinader.fr\r\n";
$headers .= "CC: zquran@gmail.com\r\n";
$headers .= "CC: sinader@orange.fr\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$message = '<html><body>';
//$message .= '<img src="http://www.assursante.fr/devis-mutuelle/images/assursante.jpg" alt="Assursante.fr" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Nom Client:</strong> </td><td>$NomProspect</td></tr>";
$message .= "<tr><td><strong>Prenom Client :</strong> </td><td>$PrenomProspet</td></tr>";
$message .= "<tr><td><strong>Email Client:</strong> </td><td>$emaill</td></tr>";
$message .= "<tr><td><strong>Telephone Client:</strong> </td><td>$tell</td></tr>";
$message .= "<tr><td><strong>Département Client:</strong> </td><td>$departement</td></tr>";
$message .= "<tr><td><strong>Genre de l'adherent principal :</strong> </td><td>$sexeProspet</td></tr>";
$message .= "<tr><td><strong>Date de Naissance  Client :</strong> </td><td>$dateNaissance</td></tr>";
$message .= "<tr><td><strong>Age Client :</strong> </td><td>$AgeProspet</td></tr>";
$message .= "<tr><td><strong>Regime :</strong> </td><td>$regime</td></tr>";
$message .= "<tr><td><strong>Enfants :</strong> </td><td>$nbrEnfant</td></tr>";
$message .= "<tr><td><strong>DateDevis :</strong> </td><td>$dateDevis</td></tr>";
$message .= "<tr><td><strong>Nom de la formule :</strong> </td><td>$formule</td></tr>";
$message .= "<tr><td><strong>Prix :</strong> </td><td>$tarifs</td></tr>";
$message .= "<tr><td><strong>Compagnie :</strong> </td><td>$compagnie</td></tr>";



$message .= "</table><br/><br/>";

///////////info COnjoint///////////////
if($coupleProspet<>"couple")
	{
	echo"0" ;
	}
	else
	{
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Nom Conjoint :</strong> </td><td>$nomConjoint</td></tr>";
$message .= "<tr><td><strong>Prénom Conjoint :</strong> </td><td>$prenomConjoint</td></tr>";

$message .= "<tr><td><strong>Date de Naissance Du Conjoint :</strong> </td><td>$dateNaissanceConj</td></tr>";
$message .= "<tr><td><strong>Age Du Conjoint :</strong> </td><td>$ageConjoint</td></tr>";
$message .= "<tr><td><strong>Regime Du Conjoint :</strong> </td><td>$regimeConjoint</td></tr>";
$message .= "<tr><td><strong>Sex Du Conjoint :</strong> </td><td>$sexeConjoint</td></tr>";
$message .= "<tr><td><strong>N° de Secu du Conjoint :</strong> </td><td>$nsecuConjoint</td></tr>";

$message .= "</table><br/><br/>";


   }





/////////////////// info Enfants  //////////////////

if($nbrEnfant = 0)
	{
	echo"0" ;
	}
	else
	{
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Nom Enfants :</strong> </td><td><strong>Prénom Enfants :</strong> </td><td><strong>Date De Naissance :</strong> </td></tr>";

 $query3 = "SELECT * FROM enfants_souscris WHERE idDevis = $idDevis";
 $rsEnfants = mysql_query($query3, $cnx) or die(mysql_error());
 $row_rsEnfants = mysql_fetch_assoc($rsEnfants);
 do {

$message .= "<tr><td>{$row_rsEnfants['nom']}</td><td> {$row_rsEnfants['prenom']}</td><td> {$row_rsEnfants['date']}</td></tr>";
   
  } while ($row_rsEnfants = mysql_fetch_assoc($rsEnfants)); 
$message .= "</table><br/><br/>";


	
	mysql_free_result($rsEnfants);
	
 }
	mysql_close($cnx);
	
	
	
/////////////////// info Rib & SC  //////////////////

$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>info Rib & SC</strong> </td><td>----------------</td></tr>";
$message .= "<tr><td><strong>Adresse :</strong> </td><td>$Adresse</td></tr>";
$message .= "<tr><td><strong>Code Postal :</strong> </td><td>$CodePostal</td></tr>";
$message .= "<tr><td><strong>ville :</strong> </td><td>$ville</td></tr>";
$message .= "<tr><td><strong>N° SC de Souscripteur :</strong> </td><td>$nsecu</td></tr>";
$message .= "<tr><td><strong>Nom de la banque  :</strong> </td><td>$NOMBonq</td></tr>";
$message .= "<tr><td><strong>Adresse de la Banque :</strong> </td><td>$ADRBonq</td></tr>";
$message .= "<tr><td><strong>Rib :</strong> </td><td>$rib</td></tr>";
$message .= "<tr><td><strong>Type de Paiment :</strong> </td><td>$typePaiment</td></tr>";
$message .= "<tr><td><strong>Date de Prelev :</strong> </td><td>$datePrelev</td></tr>";
$message .= "<tr><td><strong>Date D'Effect :</strong> </td><td>$dateEffect</td></tr>";
$message .= "</table><br/><br/>";


/////////////////// Mail //////////////////////////

	if ( mail($to, $subject, $message, $headers))     {
	echo"1";
	}else {echo"0";}

/////////////////// Mail //////////////////////////

?>


