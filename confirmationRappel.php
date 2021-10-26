<?php
session_start();




$NOM= $_POST['NOM'];
$PRENOM= $_POST['PRENOM'];
$SEXE= $_POST['SEXE'];
$TEL= $_POST['TEL'];
$datepicker= $_POST['datepicker'];
$heureRappel= $_POST['Select1'];
$Email=$_POST['EMAIL'];


$message="Nom : <strong>".$NOM."</strong><br/><br/> Prénom : <strong>".$PRENOM."</strong><br/><br>Sex : <strong>".$SEXE."</strong><br/><br/>Tel : <strong>".$TEL."</strong><br/><br/>Date du Rapelle : <strong>".$datepicker."</strong><br/><br/>L'Heur Du rappel : <strong>".$heureRappel."</strong>";
	 $headers ='From: "Sinader"<assuresante@gmail.com>'."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
 
  if(mail('contact@assursante.fr', 'Une nouvelle demande', $message , $headers )) 
     { 
         // echo 'Le message a bien été envoyer'; 
          
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

\'>Le message a bien été envoyé</div>'; 
          
          
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