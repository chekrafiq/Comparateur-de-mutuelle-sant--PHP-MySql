/*=========================================================================================
 *   Exemple de programme CGI a creer pour l'interfacage avec le PHP pour la phase retour.
 *=========================================================================================
 *
 *=========================================================================================
 *
 * Ce programme d'exemple vous indique la demarche a suivre pour utiliser la
 * fonction TestMAC() .
 *
 * Ce CGI doit realiser le test du champs MAC afin de verifier l'integrite des donnees
 *
 *=========================================================================================
 *
 * Explications :
 *
 * Lors de la phase retour, le serveur de paiement de la banque emet une
 * requete HTTP sur cette URL de confirmation. 
 * Cette requete contient un champ "code-retour" contenant le resultat du paiement, 
 * ainsi qu'un certain nombre d'informations, permettant d'identifier la commande
 * (numéro TPE, montant, reference commande, descriptif, etc).
 *
 * Lors de cette phase de retour, vous devez utiliser les fonctions TestMAC()
 * contenue dans la librairie de paiement sécurisé fournie par Euro-Information.
 *
 *                       --------------------------
 *
 * La fonction TestMAC() prend en compte les aspects de securite de la solution, en
 * garantissant l'integrite du message de confirmation recu, et en identifiant
 * l'emetteur de ce message (la banque).
 *
 *                       --------------------------
 * 
 * Rappel :
 *
 * Ce programme vous est fourni a titre d'exemple pour traiter la confirmation
 * des paiements emise par la banque.
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
	char	MAC           [REF_SIZE];
	char	VERSION	      [REF_SIZE];
	char	TPE	      [REF_SIZE];
	char	DATE_COMMANDE [TXT_SIZE];
	char	MONTANT	      [REF_SIZE];
	char	REFERENCE     [REF_SIZE];
	char	TEXTE_LIBRE   [TXT_SIZE];
	char	CODE_RETOUR   [REF_SIZE];
	int 	MAC_OK;	

	MAC_OK = 0;

    /* --- Test si le Nombre de parametres passes est Correct      --- */
	if (argc!=9) 
	{
		erreur("<HR><B>ERREUR</B><BR>l'appel au programme ne comporte pas assez d'arguments !!!!!<BR> \n les arguments à passer sont les suivants : <BR>\n ./Test_Mac_V1_2.cgi <BR>\n MAC <BR>\n VERSION<BR>\n TPE <BR>\n DATE_COMMANDE <BR>\n MONTANT <BR>\n REFERENCE <BR>\n TEXTE_LIBRE <BR>\n CODE_RETOUR <BR>\n ");
	}
	else
	{
    /* --- On recupere les parametres                              --- */
		strcpy(MAC		, argv[1]);
		strcpy(VERSION		, argv[2]);
		strcpy(TPE	        , argv[3]);
		strcpy(DATE_COMMANDE    , argv[4]);
		strcpy(MONTANT		, argv[5]);
		strcpy(REFERENCE	, argv[6]);
		strcpy(TEXTE_LIBRE	, argv[7]);
		strcpy(CODE_RETOUR	, argv[8]);
		 
	/* --- Controle du message recu (integrite et authentification) --- */
		MAC_OK = TestMAC (MAC, VERSION, TPE, DATE_COMMANDE, MONTANT, REFERENCE, TEXTE_LIBRE, CODE_RETOUR);
	}
	return MAC_OK;
}



