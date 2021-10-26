all:
	gcc -o cm_creerreponse CreerReponse_V1_2.c -L. -lcm-mac
	gcc -o cm_testmac Test_Mac_V1_2.c -L. -lcm-mac
	gcc -o cm_creerformulaire CreerFormulaire_V1_2.c -L. -lcm-mac
	strip cm_creerformulaire cm_creerreponse cm_testmac

clean:	
	rm cm_creerreponse cm_testmac cm_creerformulaire
