#!perl

#-------------------------------------------------------------
# Topic	  : Exemple PERL traitement de la requête de paiement
# Version : 500
#
# 	Dans cet exemple, on affiche un formulaire HTML
#	de connection à l'internaute.
#
#-------------------------------------------------------------

payment_request();

sub payment_request
{

# affichage du debut de la page

 print "Content-Type: text/html\n\n";
 print "";
 print "<HTML><HEAD><TITLE>MERCANET - Paiement Securise sur Internet</TITLE></HEAD>";
 print "<BODY bgcolor=#ffffff>";
 print "<Font color=#000000>";
 print "<center><H1>Test de l'API plug-in MERCANET</H1></center><br><br>";

 # Affectation des paramètres obligatoires
 
 $parm="merchant_id=082584341411111";
 $parm=$parm . " merchant_country=fr";
 $parm=$parm . " amount=100";
 $parm=$parm . " currency_code=978";
 
 # Initialisation du chemin du fichier pathfile (à modifier)
 #   ex :
 #    -> Windows : $parm=$parm . " pathfile=c:\\repertoire\\pathfile";
 #    -> Unix    : $parm=$parm . " pathfile=/home/repertoire/pathfile";
 #
 # Cette variable est facultative. Si elle n'est pas renseignée,
 # l'API positionne la valeur à "./pathfile".
 
 #	$parm=$parm . " pathfile=chemin_du_fichier_pathfile";
 
 #	Si aucun transaction_id n'est affecté, request en génère
 #	un automatiquement à partir de heure/minutes/secondes
 #	Référez vous au Guide du Programmeur pour
 #	les réserves émises sur cette fonctionnalité
 #
 #	$transaction_id="transaction_id=123456"
 
 
 #	Affectation dynamique des autres paramètres
 #	Les valeurs proposées ne sont que des exemples
 #	Les champs et leur utilisation sont expliqués dans le Dictionnaire des données
 #	
 #	$parm=$parm . " normal_return_url=http://www.maboutique.fr/cgi-bin/call_response.pl";
 #	$parm=$parm . " cancel_return_url=http://www.maboutique.fr/cgi-bin/call_response.pl";
 #	$parm=$parm . " automatic_response_url=http://www.maboutique.fr/cgi-bin/call_autoresponse.pl";
 #	$parm=$parm . " language=fr";
 #	$parm=$parm . " payment_means=CB,2,VISA,2,MASTERCARD,2";
 #	$parm=$parm . " header_flag=no";
 #	$parm=$parm . " capture_day=";
 #	$parm=$parm . " capture_mode=";
 #	$parm=$parm . " bgcolor=";
 #	$parm=$parm . " block_align=";
 #	$parm=$parm . " block_order=";
 #	$parm=$parm . " textcolor=";
 #	$parm=$parm . " receipt_complement=";
 #	$parm=$parm . " caddie=mon_caddie";
 #	$parm=$parm . " customer_id=";
 #	$parm=$parm . " customer_email=";
 #	$parm=$parm . " customer_ip_address=";
 #	$parm=$parm . " data=";
 #	$parm=$parm . " return_context=";
 #	$parm=$parm . " target=";
 #	$parm=$parm . " order_id=";
 
 
 #	Les valeurs suivantes ne sont utilisables qu'en pré-production
 #	Elles nécessitent l'installation de vos fichiers sur le serveur de paiement
 #	
 #	$parm=$parm . " normal_return_logo=";
 #	$parm=$parm . " cancel_return_logo=";
 #	$parm=$parm . " submit_logo=";
 #	$parm=$parm . " logo_id=";
 #	$parm=$parm . " logo_id2=";
 #	$parm=$parm . " advert=";
 #	$parm=$parm . " background_id=";
 #	$parm=$parm . " templatefile=";
 
 
 #	insertion de la commande en base de données (optionnel)
 #	A développer en fonction de votre système d'information

 # Initialisation du chemin de l'executable request (à modifier)
 # ex :
 #    -> Windows : $path_bin = "c:\\repertoire\\bin\\request";
 #    -> Unix    : $path_bin = "/home/repertoire/bin/request";
 #

 $path_bin = "chemin_de_l'executable_request";

 #  Appel du binaire request
 
 open(INFO, $path_bin . " " . $parm . "|");
  for ($result = 0, $i = 0; <INFO>; $i++)
  {
      $result = $result . $_;
  }
 close(INFO);
 
 #	Sortie de la fonction : !code!error!buffer!
 #		- code=0	: la fonction génère une page html contenue dans la variable buffer
 #		- code=-1 	: La fonction retourne un message d'erreur dans la variable error

 # On sépare les différents champs et on les met dans une variable tableau

 @tableau = split("!",$result);

 # recuperation des parametres
 
 $code = $tableau[1];
 $error = $tableau[2];
 $message = $tableau[3];


 # analyse du code retour
 
  if (( $code eq "" ) && ( $error eq "" ) )
 	{
  	print "<BR><CENTER>erreur appel request</CENTER><BR>";
  	print "fichier request non trouve : $path_bin";
     	print "</body></html>";
 	return;
 	};
 
 # Erreur, affiche le message d'erreur 
 
  if ( $code != 0 )
  	{
  	print "<BR><CENTER>erreur apel API de paiement</CENTER><BR>";
  	print "message erreur : $error";
     	print "</body></html>";
 	return;
	};

 # OK, affiche le message html

 print "<br><br>";
 print "$message";
 print "<br>";

 print "</BODY>";
 print "</HTML>";

}
