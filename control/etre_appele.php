<?php
	
// Récuperation des valeurs en GET ou en POST
$try=(isset($_GET['try'])?$_GET['try']:(isset($_POST['try'])?$_POST['try']:''));
$nobotv=(isset($_GET['nobotv'])?$_GET['nobotv']:(isset($_POST['nobotv'])?$_POST['nobotv']:''));
$nobotc=(isset($_GET['nobotc'])?$_GET['nobotc']:(isset($_POST['nobotc'])?$_POST['nobotc']:''));
$nobots=(isset($_GET['nobots'])?$_GET['nobots']:(isset($_POST['nobots'])?$_POST['nobots']:''));
define('ROOT_PATH',"http://www.assursante.fr/"); //
// Variable
$nobot = time().'_'.rand(50000, 60000);
if($try=='send')
{
// Ici Le visiteur soumissione le formulaire
if(($nobotc!=md5($nobotv)) or ($nobotv=='') or ($nobots!=''))
{
echo "\n<br /> <b style='color:red'>Anti-Spam</b> : Vous n'avez pas cocher la case !";
// ICI on réafiche votre formulaire, car le test a echoué
// On réaffiche le formulaire
include '../inc_file/box_phone.php';
}
else
{
// Le test est bon... On continue
// Envoi du mail, insertion ds MySQL, ou ce que vs voulez...

$NOMPRENOM= $_POST['NOMPRENOM'];
		$TEL= $_POST['TEL'];
		$HEUR= $_POST['HEUR'];
		$to = 'zquran@gmail.com';//horizons-plus@orange.fr
		$subject = "Une nouvelle Demande de rappel";
		
		if( empty($NOMPRENOM)  || empty($TEL) || empty($HEUR) ) 
     
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

\'>Votre Demande n\'a pas pu être envoyé. <br/>Veuillez remplir tous les champs <a href="http://www.assursante.fr"><strong>Retour »</strong></a></div>'; 


	 }
      
      else 
     { 

      
	$message="Nom : <strong>".$NOMPRENOM."</strong><br/><br>Tel : <strong>".$TEL."</strong><br/><br/>L'Heur Du rappel : <strong>".$HEUR."</strong>";
	 $headers ='From: "Sinader (Demande de rappel)"<contact@assursante.fr>'."\n"; 
 	 $headers .= "Reply-To: pascal.thaye@assursante.fr\r\n";
	 $headers .= "CC: amine@sinader.fr\r\n";
	 $headers .= "CC: zquran@gmail.com\r\n";
	 $headers .= "CC: sinader@orange.fr\r\n";
	 
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

\'>Le message a bien été envoyé</div>';?>
<script type="text/javascript"> 
location.href='../';
</script>

<?php
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
} 
}
}
else
{
// Ici on affiche le formulaire, c'est l'affichage par défaut
include '../inc_file/box_phone.php';
}
?> 