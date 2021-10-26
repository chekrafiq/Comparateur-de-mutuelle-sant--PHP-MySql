<?php

$formule= $_GET['f'];
$compagnie= $_GET['c'];
$tarif= $_GET['t'];
$telephone= $_GET['tel'];
$email= $_GET['em'];
$message='Votre formule est : '. $formule .' Le tarif est : '. $tarif;

	$headers ='From: "nom"<assuresante@gmail.com>'."\n"; 
     $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 
 
  if(mail($email, 'Votre Devis', $message , $headers )) 
     { 
          echo 'Le message a bien été envoyé'; 
     } 
     else 
     { 
          echo 'Le message n\'a pu être envoyé'; 
     } 

?>
<script type="text/javascript"> 
location.href='VotreDevis.html';
</script>