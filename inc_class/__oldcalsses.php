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
		$result = $d->diff(new DateTime()); // DateTime sans option revient à "now"
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
	
	function getTarif($company_id, $gamme_id, $formule_id, $sexe, $nbr_enfant, $letarif, $tarifEnf, $regime_id, $age, $age_conj)
	{
	    $var = $nbr_enfant >= 1 ? 1 : 0;
		$sql = "SELECT * FROM remis WHERE company_id = $company_id AND regime_id = $regime_id AND gamme_id = $gamme_id 
		AND formule_id = $formule_id AND sexe = '$sexe' AND nbr_enfant = $var LIMIT 1";
		//if($company_id == 1 and  $gamme_id == 1 and $formule_id == 1 and $regime_id == 1);
		
		$res = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_row($res);
		//13 ==> gratuite_enfant
		//14 ==> remis_2_eme_enfant
		//7  ==> remis
		//8  ==> taux
		//12 ==> remis_responsable
		//10 ==> frais_dossier
		//9  ==> augmentation
		if ( $row ) {
		//echo 'Age_prospect: '.$age.'<br>';
		//echo 'Age_Conjoint: '.$age_conj.'<br>';
		//echo 'ID_remis: '.$row[0].'<br>';
       // echo 'remis: '.$row[7].'<br>';
		 //echo 'taux: '.$row[8].'<br>';
		 //echo 'gratuite_enfant: '.$row[13].'<br>';
		// echo 'remis_2_eme_enfant: '.$row[14].'<br>';
		// echo $sql.'<br>';
		 //echo 'remis_responsable: '.$row[12].'<br>';
		 //echo 'frais_dossier: '.$row[10].'<br>';
		 //Si la formule n'accepte pas les enfants ou un des deux est hors de l'intervale

		 if (($age > $row[15] && $age < $row[16]) == false) return 0;
		 if ($age_conj > 0){
			if (($age_conj > $row[15] && $age_conj < $row[16]) == false) return 0;
		 }
		 if (($nbr_enfant > 0 && $row[17] == 0)) return 0;

			
			$letarif = $letarif + ($nbr_enfant > $row[13] ?  $tarifEnf * $row[13] : $tarifEnf * $nbr_enfant);
			if ($nbr_enfant > 1) $letarif = $letarif - $row[14];
			$letarif = $letarif * $row[9];
			$letarif = $letarif * $row[7];
			$letarif = $letarif * $row[8];
			$letarif = $letarif * $row[12];
			
			return $letarif + $row[10];
		}
		else {
			return $letarif + ($nbr_enfant * $tarifEnf);
		}
	}
	
	function getTarifEnf($formule,$compagnie)
	{
		
		if($this->nbrEnfant==0) return 0;
		
		$cp=substr($this->cp,0,2);
		$result=mysql_query("select TARIF from tarifs_enfants t join zones z on z.n_zone=t.nzone
										and departements 	like 	'%$cp%'
										and regime		  	in 		(0,$this->regime)
										and NFRML		=		$formule
								") or die(mysql_error());
				
				if($rs=mysql_fetch_array($result))
				{
					return $rs["TARIF"];
				}
				else 
					return 0;
	}
			
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
					return 0;
	}
	
}


?>