<?php
$formule= $_GET['f'];
$compagnie= $_GET['c'];
$tarif= $_GET['t'];
$telephone= $_GET['tel'];
$email= $_GET['em'];
$message = "Votre formule est : ". $formule." de ".$compagnie .".";
$finfo = urldecode($_GET['finfo']);
$arr_finfo = explode("-",$finfo);
if (count($arr_finfo)>0){
  $garanties = "\n\nVos garanties sont :";
  if (strlen($arr_finfo[0])>0) $garanties .= "\n- D�lai d'attente : ".$arr_finfo[0];
  if (strlen($arr_finfo[1])>0 && $arr_finfo[1]==1000) $garanties .= "\n- Hospitalisation : frais r&eacute;els";
  else if (strlen($arr_finfo[2])>0) $garanties .= "\n- Hospitalisation : ".$arr_finfo[2]."%";
  if (strlen($arr_finfo[3])>0) $garanties .= "\n- Optique : ".$arr_finfo[3]."%";
  if (strlen($arr_finfo[4])>0) $garanties .= " (".$arr_finfo[4]."&euro;/an)";
  if (strlen($arr_finfo[5])>0) $garanties .= "\n- Dentaire : ".$arr_finfo[5]."%";
  if (strlen($arr_finfo[6])>0) $garanties .= "\n\n Retrouvez tous les d�tails sur le site Assursante : www.assursante.fr/".$arr_finfo[6]."\n";
}
$message.= "\n\nLe tarif est : ". $tarif." EUR";
$message.= $garanties;
$info = urldecode($_GET['info']);
$headers ='From: "ASSURSANTE"<contact@assursante.fr>'."\n";
$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';


if ($info!=""){

  if (mail($email, 'Votre souscription sur Assursante.fr', "Bonjour,\n\nSuite � votre demande de souscription sur Assursante.fr, Nous vous remercions de votre confiance.\n\n".$message."\n\nNous allons rapidement vous contacter et restons � votre disposition au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr\n\nCordialement,\nL'�quipe d'Assursante" , $headers )){
    echo "Votre demande de souscription a bien �t� enregistr�.<br /><br />L'�quipe d'Assursante va prendre contact avec vous tr�s rapidement.<br /><br />Nous vous remercions de votre confiance et restons � votre disposition au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr";
    $message.= "\n\n".$info;
    mail("contact@assursante.fr", 'Demande de souscription sur le site assursante.fr', $message , $headers );
  }
  else echo "Votre souscription n'a pu �tre envoy�e suite � une erreur de traitement.<br />Veuillez nous contacter au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr";

}else{

  if (mail($email, 'Votre devis sur Assursante.fr', "Bonjour,\n\nSuite � votre demande de devis sur Assursante.fr, voici les informations que vous avez demand�es.\n\n".$message."\n\nNous vous remercions de votre confiance et restons � votre disposition au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr\n\nCordialement,\nL'�quipe d'Assursante" , $headers )){
    echo "Votre devis vous a bien �t� adress� par mail.<br /><br /> Nous vous remercions de votre confiance et restons � votre disposition au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr";
    $message.= "Informations pour Assursant� uniquement\nLe t�l�phone du demandeur est : ". $telephone;
    $message.= "\nLe mail du demandeur est : ". $email;
    mail("contact@assursante.fr", 'Demande de devis sur le site assursante.fr', $message , $headers );
  }
  else echo "Votre devis n'a pu �tre envoy� suite � une erreur de traitement.<br />Veuillez nous contacter au 03 44 48 21 21 ou par mail � l'adresse contact@assursante.fr";
}