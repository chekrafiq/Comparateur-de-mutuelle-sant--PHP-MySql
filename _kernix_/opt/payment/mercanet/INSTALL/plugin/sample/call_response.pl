#!perl

#----------------------------------------------------------------------------
#
# Topic	  : Exemple PERL de traitement de la réponse de paiement
# Version : 500
#						   
# 	traitement de la reponse "manuelle" du serveur de paiement quand
# 	l'acheteur retourne a la boutique apres le paiement 
#
#----------------------------------------------------------------------------


payment_response();



sub get_data_field {

# Accès au STDIN à l'aide de la fonction read

read(STDIN, $save_string, $ENV{CONTENT_LENGTH});

# Dissocie la chaîne de caractères en une liste

@prompts = split(/&/, $save_string);

# parcours de la liste

foreach (@prompts) {
	# dissocie la paire nom=valeur
	($name, $value) = split (/=/, $_);
	# decode les valeurs
	$name=~	s/\%(..)/pack("c",hex($1))/ge;
	$value=~	s/\%(..)/pack("c",hex($1))/ge;
	# cree une liste associative
	$fields{$name} = $value;
	}
$data=$fields{'DATA'};
}




sub payment_response
{

 

# affichage du debut de la page de resultat

 print "Content-Type: text/html\n\n";
 print "";
 print "<HTML><HEAD><TITLE>MERCANET - Paiement Securise sur Internet</TITLE></HEAD>";
 print "<BODY bgcolor=#ffffff>";
 print "<Font color=#000000>";
 print "<center><H1>Test de l'API plug-in MERCANET</H1></center><br><br>";

  # récupération de la variable cryptée postée
  # Initialisation de la variable message pour le binaire
  
  get_data_field();
  $message="message=$data";

  # Initialisation du chemin du fichier pathfile (à modifier)
  #   ex :
  #    -> Windows : $pathfile="pathfile=c:\\repertoire\\pathfile";
  #    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile";
  #
  # Cette variable est facultative. Si elle n'est pas renseignée,
  # l'API positionne la valeur à "./pathfile".
 
  #	$pathfile="pathfile=chemin du fichier pathfile";

 # Initialisation du chemin de l'executable response (à modifier)
 # ex :
 #    -> Windows : $path_bin = "c:\\repertoire\\bin\\response";
 #    -> Unix    : $path_bin = "/home/repertoire/bin/response";
 #
 	
	$path_bin = "chemin_de_l'executable_response";


 #	Tous les paramètres initialisés précédemment doivent être passés
 #	en paramètre à la fonction pesponse pour être pris en compte
 # 	L'ordre n'a pas d'importance
 #	Exemple : $parm = $message . " " . $pathfile;

 $parm = $message;
 
  # Appel du binaire response

 open(INFO, $path_bin . " " . $parm . "|");
   for ($result = 0, $i = 0; <INFO>; $i++)
   {
       $result = $result . $_;
   }
 close(INFO);

   #	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
   #		- code=0	: la fonction retourne les données de la transaction dans les variables v1, v2, ...
   #				: Ces variables sont décrites dans le GUIDE DU PROGRAMMEUR
   #		- code=-1 	: La fonction retourne un message d'erreur dans la variable error
   
   # on separe les differents champs et on les met dans une variable tableau
   
 @tableau = split("!",$result);

# recuperation des donnees de la reponse

	$code = $tableau[1];
	$error = $tableau[2];
	$merchant_id = $tableau[3];
	$merchant_country = $tableau[4];
	$amount = $tableau[5];
	$transaction_id = $tableau[6];
	$payment_means = $tableau[7];
	$transmission_date= $tableau[8];
	$payment_time = $tableau[9];
	$payment_date = $tableau[10];
	$response_code = $tableau[11];
	$payment_certificate = $tableau[12];
	$authorisation_id = $tableau[13];
	$currency_code = $tableau[14];
	$card_number = $tableau[15];
	$cvv_flag = $tableau[16];
	$cvv_response_code = $tableau[17];
	$bank_response_code = $tableau[18];
	$complementary_code = $tableau[19];
	$return_context = $tableau[20];
	$caddie = $tableau[21];
	$receipt_complement = $tableau[22];
	$merchant_language = $tableau[23];
	$language = $tableau[24];
	$customer_id = $tableau[25];
	$order_id = $tableau[26];
	$customer_email = $tableau[27];
	$customer_ip_address = $tableau[28];
	$capture_day = $tableau[29];
	$capture_mode = $tableau[30];
	$data = $tableau[31];

# analyse du code retour

 if (( $code eq "" ) && ( $error eq "" ) )
	{
 	print "<BR><CENTER>erreur appel response</CENTER><BR>";
 	print "executable response non trouve : $path_bin";
    	print "</body></html>";
	return;
	};

 if ( $code != 0 )
 	{
 	print "<BR><CENTER>erreur appel API de paiement</CENTER><BR>";
 	print "message erreur : $error";
    	print "</body></html>";
	return;
	};

 # Affichage des champs de la reponse

 print "<center>";
 print "<H3>R&eacute;ponse manuelle du serveur MERCANET</H3>";
 print "</center>";
 print "<b><h4>";
 print "<br><hr>";
 print "<br>merchant_id : $merchant_id " ;
 print "<br>merchant_country : $merchant_country " ;
 print "<br>amount : $amount " ;
 print "<br>transaction_id : $transaction_id " ;
 print "<br>transmission_date: $transmission_date " ; 
 print "<br>payment_means: $payment_means " ;
 print "<br>payment_time : $payment_time " ;
 print "<br>payment_date : $payment_date " ;
 print "<br>response_code : $response_code " ;
 print "<br>payment_certificate : $payment_certificate " ;
 print "<br>authorisation_id : $authorisation_id " ;
 print "<br>currency_code : $currency_code " ;
 print "<br>card_number : $card_number " ;
 print "<br>cvv_flag: $cvv_flag " ;
 print "<br>cvv_response_code: $cvv_response_code " ;
 print "<br>bank_response_code: $bank_response_code " ;
 print "<br>complementary_code: $complementary_code " ;
 print "<br>return_context: $return_context " ;
 print "<br>caddie : $caddie " ;
 print "<br>receipt_complement: $receipt_complement " ;
 print "<br>merchant_language: $merchant_language " ;
 print "<br>language: $language " ;
 print "<br>customer_id: $customer_id " ;
 print "<br>order_id: $order_id " ;
 print "<br>customer_email: $customer_email " ;
 print "<br>customer_ip_address: $customer_ip_address " ;
 print "<br>capture_day: $capture_day " ;
 print "<br>capture_mode: $capture_mode " ;
 print "<br>data: $data " ; 
 print "<br><br><hr>";
 print "</h4></b>";
 print "<br><br>";

 print "</body></html>";

}

