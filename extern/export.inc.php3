<?php
  include("_kernix_/var.inc.php3");
  header("Content-Type: application/csv-tab-delimited-table");
  header("Content-disposition: filename=Client_".$_GET['annee'].".csv");
  
  $l_sql = "SELECT distinct(c.idclient),c.title as titre,c.firstname as prenom,c.lastname as nom,c.address as adresse ,c.zipcode as code_postal,c.town as ville ,c.phone as telephone ,c.workphone as telephone_travail ,c.cellphone as mobile ,c.fax as fax,c.email1 as email1,c.email2 as email2,c.job as metier ,c.company as entreprise,Year(c.date)as date,s.description as Description 
  FROM client c, command cmd, session s 
  WHERE year(c.date) = ".$_GET['annee']." and c.idclient = cmd.idclient and s.numsession = cmd.numsession";
  
  $resQuery = mysql_query($l_sql);


  
 if (mysql_num_rows($resQuery) != 0) {
    $fields = mysql_num_fields($resQuery);
    $i = 0;
    while ($i < ($fields-1)) {
      echo mysql_field_name($resQuery, $i).";";
      $i++;
    }
    echo "Regime Sociale ; Departement ; Enfant ; Adulte 1 ; Adulte 2";
    echo "\n";
  
    while ($arrSelect = mysql_fetch_array($resQuery, MYSQL_ASSOC)) {
     foreach($arrSelect as $k=>$elem) {
      if($k == "Description") {

        preg_match_all ( '/\ social : ([A-Z\.]+)/', $elem, $ret3);
        echo str_replace('Regime','',$ret3[0][0].";");
        
        preg_match_all ( '/\partement : (\d+)/', $elem, $ret4);
        echo $ret4[1][0].";";
        
        preg_match_all ( '/(\d) enfant\(s\)/', $elem, $ret2);
        echo str_replace("enfant(s)","",$ret2[0][0]).";";
        
        preg_match_all ( '/\- age : (\d+)/', $elem, $ret);
        $age = array();
        if(count($ret[0])==1){
          echo $ret[1][0].";";
        }else{
          echo $ret[1][0].";";
          echo $ret[1][1].";";
        }
         
      }else {
        $patterns =array('/^\+/','/^\-/','/^\=/','/\;/');
        $replacements= array(' ',' ',' ',' ');
        $elem =  preg_replace($patterns, $replacements, $elem);
        echo addslashes($elem).";";
      }
     }
     echo "\n";
    }
  }
 
?>