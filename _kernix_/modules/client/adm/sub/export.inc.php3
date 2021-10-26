<?php
  
  echo "CSV par année <br /><br />"; 
  show_hr(); 
  echo "<br />";
  
  $l_sql = "SELECT distinct(Year(date)) From client order by Year(date)";
  
  $resQuery = mysql_query($l_sql);

 if (mysql_num_rows($resQuery) != 0) {
    while ($arrSelect = mysql_fetch_array($resQuery, MYSQL_ASSOC)) {
     foreach($arrSelect as $elem) {
      echo "<a href='/extern/export.inc.php3?annee=$elem'>".$elem."</a>";
     }
     echo "<br />";
    }
 }
 
 echo "<br />";
?>
