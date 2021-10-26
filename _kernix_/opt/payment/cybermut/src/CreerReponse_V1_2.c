/*=========================================================================================
 *   Exemple de programme CGI a creer pour l'interfacage avec le PHP pour la phase retour.
 *=========================================================================================
 *
 *=========================================================================================
 *
 * Ce programme d'exemple vous indique la demarche a suivre pour utiliser la
 * fonction CreerReponseCM().
 *
 * Ce CGI doit appeler la fonction :
 *
 *    CreerReponseCM("OK", buffer)                si le test du MAC est positif
 *                               OU
 *    CreerReponseCM("Document falsifie", buffer) si le MAC est erronne
 * 
 *    REMARQUE IMPORTANTE : La reponse "OK" du CGI2 ne depend pas de l'acceptation
 *                          ou du refus de paiement mais depend de l'integrite des donnees
 *
 *=========================================================================================
 *
 * La fonction CreerReponseCM() est a utiliser pour renvoyer a la banque
 * l'accuse de bonne reception du message de confirmation.
 * Cette fonction genere la totalite du message d'accuse de reception, qu'il 
 * ne vous reste plus qu'a afficher.
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
int  main(int argc, char *argv[])
{   
	int  MAC_OK;	
    char BUF [TXT_SIZE]; 

    /* --- Test si le Nombre de parametres passes est Correct      --- */
	if (argc!=2) 
	{
		erreur("<HR><B>ERREUR</B><BR>l'appel au programme CreerReponse_V1_2.cgi ne comporte pas assez d'arguments !!!!!<HR>\n l'appel doit etre de la forme suivante :<BR>\n ./CreerReponse_V1_2.cgi   MAC_OK <BR>\n  ");
	}
	else
	{
    /* --- On recupere les parametres                              --- */
		MAC_OK = atoi(argv[1]);
		
	/* --- Envoi acquittement de bonne reception --- */
		if (MAC_OK == 1)
			CreerReponseCM ("OK", BUF);
		else
			CreerReponseCM ("Document falsifie", BUF);
						 
		printf ("%s\n",BUF);
		fflush (stdout);      
	}
	return 0;
}
