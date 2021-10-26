/*=========================================================================================
 *   Exemple de programme CGI a creer pour l'interfacage avec le PHP pour la phase aller.
 *=========================================================================================
 *
 * Ce programme genere un formulaire HTML, dans lequel sont placees (en champ
 * cache) les informations de la commande (montant, reference, URL de retour
 * etc ...).
 *
 *                       ----------------------------
 *
 * Ce programme d'exemple vous indique la demarche a suivre pour utiliser
 * la fonction CreerFormulaireCM().
 *
 * Dans cet exemple, certaines informations dynamiques, relatives a la  
 * commande, sont passees au programme dans la Query String. 
 *
 * Notez que, pour des raisons evidentes de securite (falsification possible),
 * le montant n'est pas a transmettre au cgi par la Query String. 
  * 
 * La Query String peut etre de la forme suivante :
 * "TPE=<numero_TPE>&societe=<code_societe>&langue=<langue>&
 * reference=<reference_commande>&texte_libre=<texte_libre>"
 * 
 * Par ex : 
 * "TPE=1234567&societe=test&langue=francais&reference=0000234&texte_libre=test"
 * 
 *                      ----------------------------
 *
 * Le CGI1 doit realiser quatre traitements principaux :
 *
 * 1/ Extraire de la QUERY_STRING les informations de la commande afin de pouvoir
 *    rechercher les elements de la commande.
 *
 * 2/ Accéder aux bases commerçant pour rechercher ou recalculer le montant total à payer
 *    Dans le cadre de cet exemple de test, le montant a une valeur fixe.
 *    Notez qu'à ce stade, la commande client doit exister dans une base permanente du site
 *    commercant. Cette base fournira les données de détermination du montant et permettra 
 *    de tracer l'historique du paiement depuis le début de la phase de paiement
 *    (avant le CGI1), jusqu'au dénouement (après le CGI2).
 *
 * 3/ Appeler la fonction CreerFormulaireCM.
 *
 *   Sur la base des informations relatives au contexte de la commande, la 
 *   fonction CreerFormulaireCM() genere alors le source du formulaire HTML 
 *   permettant d'initier la demande de paiement.
 *
 * 4/ Afficher le formulaire
 *
 *   Il suffit ensuite d'afficher ce formulaire HTML pour présenter le bouton 
 *   "paiement par carte bancaire" au client. 
 *
 *                      ----------------------------
 *
 * Pour executer ce programme, il est impératif d'indiquer l'endroit ou se 
 * trouve la cle commerçant correspondant au TPE virtuel indique dans la 
 * Query String.
 * 
 * Cette cle commercant est un fichier texte, non modifiable (4 lignes),
 * dont le nom est "<numero_TPE>.key" (par exemple "1234567.key").
 * 
 *                     ----------------------------
 *
 * Ce programme vous est fourni a titre d'exemple des traitements a effectuer
 * pour initier une demande de paiement.
 * 
 * Lors du developpement de votre propre CGI de demande de paiement "CGI1", 
 * veuillez vous reporter a la documentation technique qui vous a ete fournie.
 *
 *=========================================================================================*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

/* --- Fichier de definition de la librairie de paiement --- */ 
#include "cm-mac_V1_2.h"

/* --- Taille des chaines de caracteres                  --- */
#define REF_SIZE 80
#define TXT_SIZE 5000


/* --------------------------------------------------------- */
/* ---               Gestion des Erreurs                 --- */
/* --------------------------------------------------------- */
void erreur(char *msg)
{
    /* --- Affichage d'un message d'erreur               --- */
    printf ("<CENTER>");
    printf (" %s\n",msg);
    printf ("</CENTER>");
    printf ("</BODY>\n");
	exit(1);

}


/* --------------------------------------------------------- */
/* ---               Programme Principal                 --- */
/* --------------------------------------------------------- */
int main(int argc, char *argv[])
{     
	char   URL_SERVEUR     [TXT_SIZE];
	char   VERSION         [REF_SIZE];
	char   TPE             [REF_SIZE];
	char   URL_HOMEPAGE    [TXT_SIZE];
	char   URL_OK          [TXT_SIZE];
	char   URL_ERR         [TXT_SIZE];
   	char   SOCIETE         [REF_SIZE];
   	char   LANGUE          [REF_SIZE];
        char   MONTANT         [REF_SIZE];
	char   REFERENCE       [REF_SIZE];
        char   TEXTE_LIBRE     [TXT_SIZE];
        char   BOUTON_PAIEMENT [TXT_SIZE];
        char   FORMULAIRE      [10000]; 
	int    i;

    /* --- Test si le Nombre de parametres passes est Correct --- */
	if (argc!=13) 
	{
		erreur("<HR><B>Erreur</B><BR>l'appel au programme ne comporte le bon nombre d'arguments !!!!!<HR><BR> \n les arguments à passer sont les suivants : <BR>\n URL_SERVEUR <BR>\n VERSION<BR>\n TPE <BR>\n MONTANT <BR>\n REFERENCE <BR>\n TEXTE_LIBRE <BR>\n URL_HOMEPAGE <BR>\n URL_OK <BR>\n URL_ERR <BR>\n LANGUE <BR>\n SOCIETE <BR>\n BOUTON_PAIEMENT<BR>\n");
	}
	else
	{
    /* --- On recupere les parametres                         --- */
		strcpy(URL_SERVEUR 	, argv[1]);
		strcpy(VERSION 		, argv[2]);
		strcpy(TPE 		, argv[3]);
		strcpy(MONTANT 		, argv[4]);
		strcpy(REFERENCE 	, argv[5]);
		strcpy(TEXTE_LIBRE 	, argv[6]);
		strcpy(URL_HOMEPAGE     , argv[7]);
		strcpy(URL_OK 		, argv[8]);
		strcpy(URL_ERR 		, argv[9]);
		strcpy(LANGUE 		, argv[10]);
		strcpy(SOCIETE 		, argv[11]);
		strcpy(BOUTON_PAIEMENT 	, argv[12]);
			
	/* --- Generation du formulaire de demande de paiement    --- */
		CreerFormulaireCM (URL_SERVEUR,     /* URL du serveur de la banque                 */
                           VERSION,                 /* Version du CGI                              */
                           TPE,	                    /* N° de TPE du commercant                     */
                           MONTANT,	            /* Montant total calcule de la commande        */
                           REFERENCE,	            /* Reference de la commande                    */
                           TEXTE_LIBRE,             /* Texte libre                                 */
                           URL_HOMEPAGE,            /* URL de retour chez le commercant            */
                           URL_OK,                  /* URL de retour si paiement OK                */
                           URL_ERR,	    	    /* URL de retour si non paiement               */
                           LANGUE,	    	    /* Langue (ex: francais)                       */
                           SOCIETE,	            /* Societe ou code DNS                         */
                           BOUTON_PAIEMENT,         /* Libelle du bouton paiement                  */
                           FORMULAIRE);             /* Recuperation du formulaire champs cachés    */


    /* --- Affichage du formulaire de demande de paiement     --- */
    printf ("%s\n", FORMULAIRE);
	}
    return 0;
}
