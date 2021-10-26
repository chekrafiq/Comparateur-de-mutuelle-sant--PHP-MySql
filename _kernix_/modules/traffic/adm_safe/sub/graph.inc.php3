<br>

<?php

show_hr();

//$l_sql = "SELECT date_format(date,'%m') AS month, count(idlog) AS nb FROM $table_log WHERE newvis = '1' GROUP BY month";
//$c_db->query($l_sql);
//$l_nbmonth = $c_db->numrows;
//
//for ($i=0;$i<$l_nbmonth;$i++)
//{
//     $l_datas[$i][0] = $c_db->result($i,"month");
//     $l_datas[$i][1] = $c_db->result($i,"nb");
//}

?>

<br>

<?php if ($l_nbvisitor != 0): ?>

<center><img src="/extern/getgraph.php3?p_title=visiteurs+par+mois+(<?php print($p_year); ?>)&p_y=150&p_x=550&p_code=traffic/adm/sub/graph_visitor.inc.php3&p_ordtitle=visiteurs&p_year=<?php print($p_year); ?>"></center><br>

<?php 
show_hr(); 
endif;
?>

<br>

<center><img src="/extern/getgraph.php3?p_title=visites+par+semaine+(<?php print($p_year); ?>)&p_y=150&p_x=550&p_code=traffic/adm/sub/graph_visit.inc.php3&p_ordtitle=visites&p_year=<?php print($p_year); ?>"></center>
