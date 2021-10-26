<?php
	session_start();
// Récuperation des valeurs en GET ou en POST

define('ROOT_PATH',"http://www.assursante.fr/"); //




	$NOM= $_POST['NOM'];
	$EMAIL= $_POST['EMAIL'];
	$TEL= $_POST['TEL'];
	$SUJET= $_POST['SUJET'];
	$Address= $_SERVER['REMOTE_ADDR'];        
    $Browser= $_SERVER['HTTP_USER_AGENT'];
	$to = 'horizons-plus@orange.fr';
	//$to = 'zquran@gmail.com';
	$subject = "Une nouvelle demande (assursante.fr)";

		if( $_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='' && $NOM =='' ) :
     
    
      
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

			\'>Votre Demande n\'a pas pu être envoyé. <br/>Veuillez remplir tous les champs <a href="http://www.assursante.fr/contact.php"><strong>Retour »</strong></a></div>'; 


	 
      
      else :
	  
     
	

	 $message="Address: <strong>".$Address."</strong><br/><br/>Browser: <strong>".$Browser."</strong><br/><br/><br/><br/><br/><br/><br/><br/>Nom & Prénom :  <strong>".$NOM."</strong><br/><br/>Email :<strong>".$EMAIL."</strong><br/><br/>Tel : <strong>".$TEL."</strong><br/><br/>Sujet : <strong>".$SUJET."</strong><br/><br/>";
     $headers ='From: "Sinader"<contact@assursante.fr>'."\n"; 
     $headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
	 $headers .= "CC: amine@sinader.fr\r\n";
	 $headers .= "CC: zquran@gmail.com\r\n";
   	 $headers .= "MIME-Version: 1.0\r\n";
	 $headers .= "Content-Type: text/html; charset=utf-8\r\n";

 
  if(mail($to, $subject , $message , $headers )) :
      
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
     
	 
     else :
	 
    
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
     endif;



		endif;


?>