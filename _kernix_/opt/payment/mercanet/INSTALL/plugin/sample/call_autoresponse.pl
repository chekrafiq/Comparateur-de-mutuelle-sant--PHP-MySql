#!perl

#---------------------------------------------------------------
# Topic	  : Exemple PERL traitement de l'autoréponse de paiement
# Version : 500
#
# 	Dans cet exemple, les données de la transaction	sont
#	décryptées et sauvegardées dans un fichier log.
#
#---------------------------------------------------------------

payment_autoresponse();



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


sub payment_autoresponse
{

  # récupération de la variable cryptée postée
  # Initialisation de la variable message pour le binaire
  
  get_data_field();
  $message="message=$data";

  # Initialisation du chemin du fichier pathfile (à modifier)
  #   ex :
  #    -> Windows : $pathfile="pathfile=c:\\repertoire\\pathfile"
  #    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile"
  #
  # Cette variable est facultative. Si elle n'est pas renseignée,
  # l'API positionne la valeur à "./pathfile".
 
  #	$pathfile="pathfile=chemin_du_fichier_pathfile";

 # Initialisation du chemin de l'executable response (à modifier)
 # ex :
 #    -> Windows : $path_bin = "c:\\repertoire\\bin\\response"
 #    -> Unix    : $path_bin = "/home/repertoire/bin/response"
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

  # Initialisation du chemin du fichier log (à modifier)
  # ex :
  #    -> Windows : $logfile="c:\\repertoire\\log\\log.txt";
  #    -> Unix    : $logfile="/home/repertoire/log/log.txt";
  #

$logfile="chemin_du_fichier_de_log";

# Ouverture du fichier de log en append

open(LOG, ">>$logfile");

# analyse du code retour

 if (( $code eq "" ) && ( $error eq "" ) )
	{
 	print LOG "fichier response non trouve\n";
 	close(LOG);
    	return;
	};

 if ( $code != 0 )
 	{
 	print LOG "message erreur : $error\n";
 	close(LOG);
    	return;
	};

 # sauvegarde des champs de la reponse

 print LOG "merchant_id : $merchant_id\n";
 print LOG "merchant_country : $merchant_country\n";
 print LOG "amount : $amount\n";
 print LOG "transaction_id : $transaction_id\n";
 print LOG "transmission_date: $transmission_date\n";
 print LOG "payment_means: $payment_means\n";
 print LOG "payment_time : $payment_time\n";
 print LOG "payment_date : $payment_date\n";
 print LOG "response_code : $response_code\n";
 print LOG "payment_certificate : $payment_certificate\n";
 print LOG "authorisation_id : $authorisation_id\n";
 print LOG "currency_code : $currency_code\n";
 print LOG "card_number : $card_number\n";
 print LOG "cvv_flag: $cvv_flag\n";
 print LOG "cvv_response_code: $cvv_response_code\n";
 print LOG "bank_response_code: $bank_response_code\n";
 print LOG "complementary_code: $complementary_code\n";
 print LOG "return_context: $return_context\n";
 print LOG "caddie : $caddie\n";
 print LOG "receipt_complement: $receipt_complement\n";
 print LOG "merchant_language: $merchant_language\n";
 print LOG "language: $language\n";
 print LOG "customer_id: $customer_id\n";
 print LOG "order_id: $order_id\n";
 print LOG "customer_email: $customer_email\n";
 print LOG "customer_ip_address: $customer_ip_address\n";
 print LOG "capture_day: $capture_day\n";
 print LOG "capture_mode: $capture_mode\n";
 print LOG "data: $data";

 # Fermeture du fichier log

 close(LOG);

}


