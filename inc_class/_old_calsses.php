<?php
class Client
{
	var $nom;
	var $prenom;
	var $sexe="les deux";
	var $couple="les deux";
	var $dateNaiss;
	var $regime;
	var $nbrEnfant;
	var $cp;
	var $conj;
	var $email;
	var $tel;
	//mes ajouts
	var $ncmp;
	var $nfrml;
	var $nzone;
	var $tarifs;
	var $dateDevis;
	var $ndepartement;
	

	//var $enfMajeurs; // tableau $enfMajeurs["sexe"] et $enfMajeurs["anneeNaiss"]
	function diff_date($jour , $mois , $an , $jour2 , $mois2 , $an2){  
	
	$today = date("d,m,Y");
	//echo $today; 
	
	
	$date = mktime(0, 0, 0, $mois, $jour, $an);  
	$date2 = mktime(0, 0, 0, $mois2, $jour2, $an2);  
	$diff = floor(($date - $date2) / (3600 * 24));  
	return $diff;
	}
	
	function getAge()
	{
		
		/*$d = new DateTime($this->dateNaiss);
		$result = $d->diff(new DateTime()); // DateTime sans option revient   "now"
	// $result est un objet DateInterval
		return $result->y;*/
		
		$nbjours = round((strtotime(date("d-m-Y")) - strtotime($this->dateNaiss))/(60*60*24)-1); 

		$annee = floor($nbjours / 365) ;
		$dateN = $this->dateNaiss;
		 $h = explode('-', $dateN); 
		 $y = $h[2];
		 $m = $h[1];
		 $d = $h[0];

		$annee = $this->diff_date($d,$m,$y,date("d"),date("m"),date("Y")) * -1;

		$annee  = floor($annee / 365);

		return $annee;
	}
	
	function Client($nom, $prenom, $dateNaiss, $nbrEnfant, $sexe, $couple, $regime, $cp, $email, $telephone,$ncmp, $nfrml,$nzone, $tarifs,$dateDevis,$ndepartement)
	{
		$this->nom=$nom;
		$this->prenom= $prenom;
		$this->dateNaiss= $dateNaiss;
		$this->nbrEnfant= $nbrEnfant;
		$this->sexe= $sexe;
		$this->couple= $couple;
		$this->regime= $regime;
		$this->cp=$cp;
		$this->email= $email;
		$this->tel=$telephone;
		$this->nfrml=$nfrml;
		$this->ncmp=$ncmp;
		$this->nzone= $nzone;
		$this->tarifs=$tarifs;
		$this->dateDevis=$dateDevis;
		$this->ndepartement=$ndepartement;
		
	}
	function getReduction($compagnie,$gamme)
	{
		$percent=0;
		switch ($compagnie)
		{
			case "SWISSLIFE":
				if ($this->couple=="couple")
				{
					if($gamme!=7)//on n'applique la reduction pour astucieuse
					{
				
						if($this->nbrEnfant>0)
							$percent=0.10;
						else
							$percent=0.05;
					}
					
				}
				else
				{
					if($this->nbrEnfant>0)
						$percent=0.07;
				}
						
				if($this->regime==2)//TNS
					$percent+=0.15;
					
					
				break;
				
				
			case "AMIS":
			//on est pas en senior
			
			if($gamme==4)
			{
				if($this->couple=="seul")//seul
				{
					if($this->sexe=="homme" && $this->getAge()<=40)
					{
						if($this->nbrEnfant==0)
							$percent=0.20;
						else
							$percent=0.15;
					}
				}
				else//couple
				{

					if($this->nbrEnfant==0)
					{
						if($this->getAge()<40 && $this->conj->getAge()<40)
						{
							$percent=0.15;
							}
					}
					elseif($this->nbrEnfant==1)
						$percent=0.15;
					elseif($this->nbrEnfant>=2)
						$percent=0.25;
					
				}
				
			}
			else if($gamme==5)// pour la senior
			{
				if($this->couple=="couple")//couple
				{
					$percent=0.05;
				}
			}
				break;
			
			case "APRIL":
				if ($this->couple=="seul")
					if ($this->nbrEnfant==1)
						$percent=0.05;
					elseif($this->nbrEnfant>1)
						$percent=0.10;
				if($this->couple=="couple")
					if ($this->nbrEnfant==0)
						$percent=0.05;
					elseif($this->nbrEnfant>0)
						$percent=0.10;
				break;
				
				
			
			case "ALPTIS":
			if ($this->couple!="seul")
						$percent=0.10;
						
			
						
				break;
			/*case "SMAM":
			
				break;*/
				//AJOUT AHMED
			
			
		}

/*		$k=15*0.01;
		var_dump($percent);
*/
		return 1-$percent;
	}
	
	function getSupplement($compagnie,$niv=1)
	{
		$sup=0;
		switch ($compagnie)
		{
			case "SWISSLIFE":
				$coef=($niv==1?2:3);  //option confort niv 1
				$sup=$this->couple=="seul"?$coef:2*$coef;  //option confort niv 2
				
				break;
				
				
			case "AMIS":
				//$sup1=$this->nbrEnfant*2+($this->couple=="seul"?4:8); //pod1
				//$sup2=$this->nbrEnfant*3+($this->couple=="seul"?7:14); //pod2
				//$sup=($niv==1?$sup1:$sup2);
				
				break;
			
			case "APRIL":
				
				break;
				
				

			case "SMAM":
				
				//Ajouter 0.80   par mois et par adh sion au titre des frais accessoires 
				#$sup=($this->nbrEnfant+($this->couple=="seul"?1:2))*0.8; 
				$sup=0.8; 
				break;

		
		}
		return $sup;
	}
	
	function getTarifEnf($formule,$compagnie)
	{
		$reductionAstucieuse=0.814;
		if($this->nbrEnfant==0) return 0;
		if($compagnie!=2)
		{
		$coef=($this->nbrEnfant>2)?2:$this->nbrEnfant;
		}
		else
		{
		$coef=$this->nbrEnfant;
		}
		
		$cp=substr($this->cp,0,2);
		$result=mysql_query("select TARIF from tarifs_enfants t join zones z on z.n_zone=t.nzone
										and departements 	like 	'%$cp%'
										and regime		  	in 		(0,$this->regime)
										and NFRML		=		$formule
								") or die(mysql_error());
				
				if($rs=mysql_fetch_array($result))
				{
					//ajout ahmed
					if($formule==23)//SI FORMULE ASTUCIEUSE : gratuit  a partir du 3eme enfant
					{					
						if($this->nbrEnfant>=2)
						{
							return $rs["TARIF"]*$coef*$reductionAstucieuse;
						}
					}
				
					return $rs["TARIF"]*$coef;
				}
				else 
					return -1;
				
	}
	/*
	function ajouterEnfMajeur($anneeNaisse, $sexe)
	{
		$this->enfMajeurs[]["sexe"]=$sexe;
		$this->enfMajeurs[]["anneeNaiss"]=$anneeNaisse;
	}
	*/
		
		
}

class Conjoint
{
	var $nom;
	var $prenom;
	var $sexe="les deux";
	var $couple="couple";
	var $naiss;
	var $regime;
	function Conjoint($nom, $prenom,$naiss,$sexe, $regime)
	{
		$this->nom=$nom;
		$this->prenom= $prenom;
		$this->naiss=$naiss;
		$this->sexe= $sexe;
		$this->regime=$regime;
		
	}
	//var $enfMajeurs; // tableau $enfMajeurs["sexe"] et $enfMajeurs["anneeNaiss"]
	function diff_date($jour , $mois , $an , $jour2 , $mois2 , $an2){  
	
	$today = date("d,m,Y");
	//echo $today; 
	
	
	$date = mktime(0, 0, 0, $mois, $jour, $an);  
	$date2 = mktime(0, 0, 0, $mois2, $jour2, $an2);  
	$diff = floor(($date - $date2) / (3600 * 24));  
	return $diff;
	}
	function getAge()
	{
		/*$d = new DateTime("01-01-".$this->naiss);
		$result = $d->diff(new DateTime()); 
		return $result->y;*/
		
		$nbjours = round((strtotime(date("d-m-Y")) - strtotime($this->naiss))/(60*60*24)-1); 
		$annee = floor($nbjours / 365) ;
		$dateN = $this->naiss;
		 $h = explode('-', $dateN); 
		 $y = $h[2];
		 $m = $h[1];
		 $d = $h[0];

		$annee = $this->diff_date($d,$m,$y,date("d"),date("m"),date("Y")) * -1;

		$annee  = floor($annee / 365);

		return $annee;
	}
	function getTarif($formule,$cp)
	{
		$age=$this->getAge();
		$cp=substr($cp,0,2);
				$result=mysql_query("select TARIF from vw_tarifscomplet 
										where $age 			between age_min and age_max
										and departements 	like 	'%$cp%'
										and nregime		  	in 		(0,$this->regime)
										and nforumle		=		$formule
										and sexe 			in		('les deux','$this->sexe')
										and couple 			in		('les deux','couple')
								") or die(mysql_error());
				

				if($rs=mysql_fetch_array($result))
					return $rs["TARIF"];
				else 
					return -1;
	}
	
}


?>