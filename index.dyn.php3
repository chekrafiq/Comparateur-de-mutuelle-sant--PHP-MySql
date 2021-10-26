<?php
	$p_idref=$_GET['p_idref'];
	$domain="http://www.assursante.fr/";		
		
		// Permanent redirection
		   header("HTTP/1.1 301 Moved Permanently");

			if($p_idref==18)
			$lien=''.$domain.'compagnie-assurances/swisslife/swiss-sante.php';
			else if ( $p_idref==22 )
			$lien=''.$domain.'compagnie-assurances/swisslife/confort-hospi.php';
			elseif ( $p_idref==32 )
			$lien=''.$domain.'compagnie-assurances/swisslife/swiss-protection.php';
			elseif ($p_idref==56 )
			$lien=''.$domain.'compagnie-assurances/swisslife/garantie-accidents-vie.php';
			elseif ( $p_idref==169 )
			$lien=''.$domain.'compagnie-assurances/swisslife/mutuelle-swissLife.php';
			elseif ( $p_idref==171 )
			$lien=''.$domain.'parrainage.php';
			elseif ( $p_idref==23 )
			$lien=''.$domain.'compagnie-assurances/swisslife/habitation-assurance.php';
			elseif ( $p_idref==24 )
			$lien=''.$domain.'compagnie-assurances/swisslife/suisse-avenir.php';
			elseif ( $p_idref==85 )
			$lien=''.$domain.'compagnie-assurances/swisslife/swissLife-retraite.php';
			elseif ( $p_idref==91 )
			$lien=''.$domain.'compagnie-assurances/swisslife/retraite-independant.php';
			elseif ( $p_idref==97 )
			$lien=''.$domain.'compagnie-assurances/swisslife/swissLife-liberte.php';
			elseif ( $p_idref==103 )
			$lien=''.$domain.'compagnie-assurances/swisslife/suisse-obseques.php';
			elseif ( $p_idref==172 )
			$lien=''.$domain.'complementaire-sante.html';
			elseif ( $p_idref==9 )
			$lien=''.$domain.'actualites.php';
			elseif ( $p_idref==10 )
			$lien=''.$domain.'newsletter.php';
			elseif ( $p_idref==11 )
			$lien=''.$domain.'plan.php';
			elseif ( $p_idref==12 )
			$lien=''.$domain.'contact.php';
			elseif ( $p_idref==157 )
			$lien=''.$domain.'telephone.php';
			elseif ( $p_idref==13 )
			$lien=''.$domain.'propos.php';
			elseif ( $p_idref==152 )
			$lien=''.$domain.'glossaire.php';
			elseif ( $p_idref==14 )
			$lien=''.$domain.'mention-legale.php';
			elseif ( $p_idref==15 )
			$lien=''.$domain.'charte_de_confidentialite.php';
			elseif ( $p_idref==168 )
			$lien=''.$domain.'guide_mutuelle.php';
			elseif ( $p_idref==170 )
			$lien='http://www.assursante.fr/';
			
			/////////////////////////////// astucieuses		
			
			elseif ( $p_idref==158 )
			$lien=''.$domain.'compagnie-assurances/swisslife/swiss-sante-les-astucieuses.php';

			elseif ( $p_idref==159 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-astucieuses.php';
			
			elseif ( $p_idref==161 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/astucieuses-condition.php';
			
			////////////////////////////// Confort Hospi

			elseif ( $p_idref==27 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-confort-hospitalisation.php';

			elseif ( $p_idref==29 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/confort-hospitalisation-condition.php';

			elseif ( $p_idref==31 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
		
			///////////////////////////// Accident vie
			
			elseif ( $p_idref==57 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-garantie-accidents-vie.php';

			elseif ( $p_idref==59 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/accidents-vie-condition.php';

			elseif ( $p_idref==61 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
			
			/////////////////////////////	Habitation assurance
			
			elseif ( $p_idref==75 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-habitation-assurance.php';
			
			elseif ( $p_idref==76 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/avantages-habitation-assurance.php';

			elseif ( $p_idref==79 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/information-habitation-assurance.php';

			
			/////////////////////////////	Suiss Avenir   				
		
			elseif ( $p_idref==80 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-suisse-avenir.php';

			elseif ( $p_idref==81 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/montants-suisse-avenir.php';

			elseif ( $p_idref==82 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/suisse-avenir-condition.php';

			elseif ( $p_idref==84 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
			

		
			/////////////////////////////	Suiss retraite
			
			elseif ( $p_idref==86 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-swissLife-retraite.php';

			elseif ( $p_idref==87 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/montants-swissLife-retraite.php';

			elseif ( $p_idref==88 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/swissLife-retraite-condition.php';
			

			elseif ( $p_idref==90 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/devis-swissLife-retraite.php';

			///////////////////////////// retraite independant
			
			elseif ( $p_idref==92 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-retraite-independant.php';
			
			elseif ( $p_idref==93 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/montants-retraite-independant.php';

			elseif ( $p_idref==94 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/retraite-independant-condition.php';
			

			elseif ( $p_idref==96 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
			
			
			///////////////////////////// suiss liberte
			
			elseif ( $p_idref==98 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-swissLife-liberte.php';

			elseif ( $p_idref==99 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/montants-swissLife-liberte.php';

			elseif ( $p_idref==100 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/swissLife-liberte-condition.php';

			elseif ( $p_idref==102 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
			
			/////////////////////////////	

			elseif ( $p_idref==104 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/garantie-suisse-obseques.php';

			elseif ( $p_idref==105 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/garantie/tarifs-suisse-obseques.php';

			elseif ( $p_idref==106 )
			$lien=''.$domain.'compagnie-assurances/swisslife/gamme/condition/suisse-obseques-condition.php';

			elseif ( $p_idref==108 )
			$lien=''.$domain.'compagnie-assurances/swisslife/souscrire-info.php';
									
			/////////////////////////////
			
			else
			$lien=''.$domain.''.'pages_404.php';

 
		
		header("Location: $lien");

 			


?>