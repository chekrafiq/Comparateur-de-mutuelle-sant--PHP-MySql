<?php

echo"test";

$NOMPRENOMPARRAIN= $_POST['NOMPRENOMPARRAIN'];
$ADRESSEPARRAIN= $_POST['ADRESSEPARRAIN'];

$NOMPRENOM_FILLEUL1= $_POST['NOMPRENOM_FILLEUL1'];
$ADRESSE_FILLEUL1= $_POST['ADRESSE_FILLEUL1'];
$TEL_FILLEUL1= $_POST['TEL_FILLEUL1'];
$NAISSANCE_FILLEUL1= $_POST['NAISSANCE_FILLEUL1'];

$NOMPRENOM_FILLEUL2= $_POST['NOMPRENOM_FILLEUL2'];
$ADRESSE_FILLEUL2= $_POST['ADRESSE_FILLEUL2'];
$TEL_FILLEUL2= $_POST['TEL_FILLEUL2'];
$NAISSANCE_FILLEUL2= $_POST['NAISSANCE_FILLEUL2'];

$NOMPRENOM_FILLEUL3= $_POST['NOMPRENOM_FILLEUL3'];
$ADRESSE_FILLEUL3= $_POST['ADRESSE_FILLEUL3'];
$TEL_FILLEUL3= $_POST['TEL_FILLEUL3'];
$NAISSANCE_FILLEUL3= $_POST['NAISSANCE_FILLEUL3'];



$to = 'horizons-plus@orange.fr';
$subject = "Une nouvelle demande de parrainage (assursante.fr)";


	 $message="Nom et Prénom du Parrain :  <strong> $NOMPRENOMPARRAIN</strong>
	 <br/><br/>Adresse du Parrain :<strong> $ADRESSEPARRAIN</strong>
	
     <br/><br/>Filleul 1 : Nom et Prénom  <strong> $NOMPRENOM_FILLEUL1 </strong>
	 <br/><br/>Filleul 1 : Adresse  <strong> $ADRESSE_FILLEUL1 </strong>
	 <br/><br/>Filleul 1 : N° de Téléphone   : <strong> $TEL_FILLEUL1  </strong>
	 <br/><br/>Filleul 1 : Date de naissance  : <strong> $NAISSANCE_FILLEUL1</strong>
	 
     <br/><br/>Filleul 2 : Nom et Prénom  <strong> $NOMPRENOM_FILLEUL2 </strong>
	 <br/><br/>Filleul 2 : Adresse  <strong> $ADRESSE_FILLEUL2 </strong>
	 <br/><br/>Filleul 2 : N° de Téléphone   : <strong> $TEL_FILLEUL2  </strong>
	 <br/><br/>Filleul 2 : Date de naissance  : <strong> $NAISSANCE_FILLEUL2</strong>
    
     <br/><br/>Filleul 3 : Nom et Prénom  <strong> $NOMPRENOM_FILLEUL3 </strong>
	 <br/><br/>Filleul 3 : Adresse  <strong> $ADRESSE_FILLEUL3 </strong>
	 <br/><br/>Filleul 3 : N° de Téléphone   : <strong> $TEL_FILLEUL3  </strong>
	 <br/><br/>Filleul 3 : Date de naissance  : <strong> $NAISSANCE_FILLEUL3</strong>";
     
     
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
