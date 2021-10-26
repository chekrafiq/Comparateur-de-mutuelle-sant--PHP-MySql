<?php
session_start();




$NOM= $_POST['NOM'];
$EMAIL= $_POST['EMAIL'];
$TEL= $_POST['TEL'];
$NAISSANCE= $_POST['NAISSANCE'];
$PROFESSION= $_POST['PROFESSION'];
$ADRESSE= $_POST['ADRESSE'];
$ADRESSE2= $_POST['ADRESSE2'];
$CODEPOSTAL= $_POST['CODEPOSTAL'];
$VILLE= $_POST['VILLE'];
$MONTANT= $_POST['MONTANT'];

$to = 'horizons-plus@orange.fr';
$subject = "Une nouvelle demande Devis SwissLife retraite (assursante.fr)";


	 $message="Nom & Prénom :  <strong> $NOM </strong><br/><br/>Email :<strong> $EMAIL </strong><br/><br/>Tel : <strong> $TEL </strong>
	 <br/><br/>Date de naissane : <strong> $NAISSANCE </strong><br/><br/>Profession : <strong> $PROFESSION  </strong><br/><br/>Adresse : <strong> $ADRESSE</strong><br/><br/>Complement d adresse : <strong> $ADRESSE2</strong><br/><br/>Code Postal : <strong> $CODEPOSTAL</strong><br/><br/>Ville : <strong> $VILLE</strong><br/><br/>Montant : <strong> $MONTANT</strong>";
     $headers ='From: "Sinader"<contact@assursante.fr>'."\n"; 
     $headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
	 $headers .= "CC: amine@sinader.fr\r\n";
	 $headers .= "CC: zquran@gmail.com\r\n";
   	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-Type: text/html; charset=utf-8\r\n";

 
  if(mail($to, $subject , $message , $headers )) 
     { 
          //echo 'Le message a bien été envoyer'; 
          
          echo '<div style=\'padding: 7px;
	background: #E6EFC2;
	color: #264409;
	border-bottom: 1px solid #C6D880;
	text-align: center;
	font-family: "times New Roman", Times, serif;
	font-size: 24px;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;

\'> Le message a bien été envoyé</div>'; 
     } 
     else 
     { 
          echo '<div style=\'padding: 7px;
	border-style: solid;
	border-color: #FBC2C4 #FBC2C4 #ee9b9e #FBC2C4;
	border-width: 1px 1px 2px 1px;
	background: #FBE3E4;
	color: #8A1F11;
	text-align: center;
	font-family: "times New Roman", Times, serif;
	font-size: 24px;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	margin-bottom: 15px;

\'>Ce message n\'a pas pu être envoyé. <br/>Réessayez d\'envoyer le message ultérieurement</div>'; 
     } 

?>
<script type="text/javascript"> 
location.href='../confirmation-contact.php';
</script>
