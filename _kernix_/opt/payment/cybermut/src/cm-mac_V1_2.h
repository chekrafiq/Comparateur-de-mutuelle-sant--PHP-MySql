/*==============================================================================
 * Fichier de definition de la librairie de paiement securise Euro-Information.
 * 
 *                               Version 1.2
 *                               -----------
 *
 * Cette librairie comprend trois fonctions a utiliser pour creer vos CGI 
 * d'interfacage avec le serveur de paiement par carte bancaire de la
 * banque :
 * 
 * 	- CreerFormulaireCM ()
 * 	- TestMAC ()
 * 	- CreerReponseCM ()
 * 
 * Vous devez developper un cgi pour la phase aller du paiement (CGI1)
 * et un cgi pour la phase retour du paiement (CGI2).
 *
 * Le CGI1 effectue la demande de paiement au serveur de paiement securise
 * de la banque.
 * Vous devez utiliser dans le CGI1 la fonction CreerFormulaireCM ().
 * 
 * Le CGI2 est charge de recevoir la confirmation du paiement, emise par le
 * serveur securise de la banque vers votre serveur. Vous devez dans le CGI2 
 * utiliser les fonctions TestMAC () et CreerReponseCM ().
 * 
 * Veuillez vous reporter a la documentation technique pour le developpement 
 * des programmes cgi CGI1 et CGI2.
 *
 =============================================================================*/


/*----------------------------------------------------------------------------*/
/* La fonction CreerFormulaireCM genere le source HTML du formulaire          */
/* dans lequel sont placees les informations du contexte de la commande       */
/* (montant, reference, etc...)                                               */
/* Entree :                                                                   */
/*                                                                            */
/*      url_CM          : URL du serveur de paiement securise de la banque    */
/*      version         : version de telepaiement (1.2)                       */
/*      TPE             : numero de TPE du commercant                         */
/*      montant         : montant de la commande                              */
/*      ref_commande    : reference de la commande                            */
/*      texte_libre     : descriptif de la commande                           */
/*      url_retour      : url de retour "Home Page" du site du commercant     */
/*      url_retour_ok   : url de retour en cas de paiement accepte            */
/*      url_retour_err  : url de retour en cas de paiement refuse             */
/*      langue          : langue d'affichage des pages sur le serveur de      */
/*                        la banque                                           */
/*      code_societe    : permet au commercant ayant plusieurs sites de       */
/*                        partager le meme TPE                                */
/*      texte_bouton    : phrase affichée sur le bouton de validation         */
/*                        (type « submit » ) du formulaire                    */
/*                                                                            */
/* Sortie :                                                                   */
/*                                                                            */
/*      formulaire : buffer contenant le source HTML du formulaire genere.    */
/*                   celui-ci doit etre ajoute a la page du site du           */
/*                   commercant contenant le bon de commande                  */
/*----------------------------------------------------------------------------*/
extern void CreerFormulaireCM (char *url_CM,
			       char *version,
			       char *TPE, 
			       char *montant, 
			       char *ref_commande, 
			       char *texte_libre,
			       char *url_retour,
			       char *url_retour_ok,
			       char *url_retour_err,
			       char *langue,
			       char *code_societe,
			       char *texte_bouton,
			       char *formulaire);


/*----------------------------------------------------------------------------*/
/* La fonction TestMAC prend en compte les aspects de securite pour la phase  */
/* retour du paiement. Elle permet d'authentifier l'emetteur du message de    */
/* confirmation (la banque) et garantit que ce message n'a pas ete            */
/* altere (integrite des donnees recues).                                     */
/* Cette fonction doit imperativement etre utilisee dans le CGI de la phase   */
/* retour du paiement.                                                        */
/* Entree :                                                                   */
/*                                                                            */
/*      code_MAC     : code d'authentification du message                     */
/*      version      : version de telepaiement (1.2)                          */
/*      TPE          : numero de TPE du commercant                            */
/*      cdate        : date du paiement                                       */
/*      montant      : montant de la commande                                 */
/*      ref_commande : reference de la commande                               */
/*      texte_libre  : descriptif de la commande                              */
/*      code_retour  : indique le resultat du paiement                        */
/*                     (paiement ou Annulation)                               */
/*                                                                            */
/* Retourne :                                                                 */
/*                                                                            */
/*      1 (TRUE)  si le message est authentifié                               */
/*      0 (FALSE) dans le cas contraire                                       */
/*----------------------------------------------------------------------------*/
extern int TestMAC (char *code_MAC, 
		    char *version, 
		    char *TPE, 
		    char *cdate, 
		    char *montant, 
		    char *ref_commande, 
		    char *texte_libre, 
		    char *code_retour);


/*----------------------------------------------------------------------------*/
/* La fonction CreerReponseCM genere le message retourne par le cgi de        */
/* confirmation de paiement (CGI2).                                           */
/* Entree :                                                                   */
/*         phrase   : "OK" si le commercant a bien pris en compte la          */
/*                         confirmation de paiement (accepte ou refuse),      */
/*                    ou                                                      */
/*                    un message d'erreur sinon.                              */
/*                                                                            */
/* Sortie :                                                                   */
/*         reponse  : buffer contenant le message complet (avec entete) que   */
/*                    le cgi CGI2 doit afficher.                              */
/*----------------------------------------------------------------------------*/
extern void CreerReponseCM (char *phrase, 
			    char *reponse);
                                                                        
         
