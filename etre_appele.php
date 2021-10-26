<?php


		$NOMPRENOM= $_POST['NOMPRENOM'];
		$TEL= $_POST['TEL'];
		$HEUR= $_POST['HEUR'];
		$to = 'horizons-plus@orange.fr';
		$subject = "Une nouvelle Demande de rappel";
		

	 $message="Nom : <strong>".$NOMPRENOM."</strong><br/><br>Tel : <strong>".$TEL."</strong><br/><br/>L'Heur Du rappel : <strong>".$HEUR."</strong>";
	 $headers ='From: "Sinader (Demande de rappel)"<contact@assursante.fr>'."\n"; 
 	 $headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
	 $headers .= "CC: amine@sinader.fr\r\n";
	 $headers .= "CC: zquran@gmail.com\r\n";
   	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-Type: text/html; charset=utf-8\r\n";
  if(mail($to, $subject , $message , $headers )) 
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
<script type="text/javascript"> 
location.href='../';
</script>
