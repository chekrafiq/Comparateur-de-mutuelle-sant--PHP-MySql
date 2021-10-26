<?php





$NOM= $_POST['NOM'];
$PRENOM= $_POST['PRENOM'];
$EMAIL= $_POST['EMAIL'];
$TEL= $_POST['TEL'];
$SUJEET= $_POST['SUJEET'];

$message="Nom :  <strong>".$NOM."</strong><br/><br/>PrÃ©nom : <strong>".$PRENOM."</strong><br/><br/>Email :<strong>".$EMAIL."<strong><br/><br/>Tel : <strong>".$TEL."</strong><br/><br/>Sujet : <strong>".$SUJEET."</strong>";
     $headers ='From: "Sinader"<contact@assursante.fr>'."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
 
  if(mail('contact@assursante.fr', 'Une nouvelle demande', $message , $headers )) 
     { 
          //echo 'Le message a bien Ã©tÃ© envoyer'; 
          
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

\'> Le message a bien Ã©tÃ© envoyÃ©</div>'; 
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

\'>Ce message n\'a pas pu Ãªtre envoyÃ©. <br/>RÃ©essayez d\'envoyer le message ultÃ©rieurement</div>'; 
     } 

?>