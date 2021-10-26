<h1>
<?php
$r=NAN;
var_dump($r);
?>
</h1>

<h1>
<?php
$r=round(12.99999999999998,2);
var_dump($r);
?>
</h1>
<?php



$d = new DateTime("12-07-1981");
$result = $d->diff(new DateTime()); // DateTime sans option revient à "now"
// $result est un objet DateInterval
echo $result->y;
/*
object(DateInterval)#5 (8) {
  ["y"]=>
  int(2)
  ["m"]=>
  int(0)
  ["d"]=>
  int(23)
  ["h"]=>
  int(23)
  ["i"]=>
  int(44)
  ["s"]=>
  int(49)
  ["invert"]=>
  int(0)
  ["days"]=>
  int(753)
}*/
$date1 = "12-07-1981"; 
$date2 = date("d-m-Y");
 
//Extraction des données
list($jour1, $mois1, $annee1) = explode('-', $date1); 
list($jour2, $mois2, $annee2) = explode('-', $date2);

//Calcul des timestamp
$timestamp1 = mktime(0,0,0,$mois1,$jour1,$annee1); 
$timestamp2 = mktime(0,0,0,$mois2,$jour2,$annee2); 
echo "<br />";
echo (abs($timestamp2 - $timestamp1)/86400)."<br />"; //Affichage du nombre de jour : 27
echo (abs($timestamp2 - $timestamp1)/(86400*365))."<br />"; //Affichage du nombre de semaine : 3.85


?>