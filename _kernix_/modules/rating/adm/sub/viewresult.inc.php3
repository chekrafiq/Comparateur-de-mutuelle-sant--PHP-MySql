<?php

$table_ref = "ref";

$l_sql = "SELECT * FROM $table_rating";
$c_db->query($l_sql);
for ($i=1;$i<=5;$i++)
{
     $l_tabrating[$i] = $c_db->result(0,"rate$i");
}

$l_sql = "SELECT idref, value, count(value) AS nb FROM $table_result WHERE idref = '$p_idref' GROUP BY value ORDER BY value DESC";
$c_db->query($l_sql);


?>

 <table align=center width=70%>  
   <tr>
    <td align=left class=color1 colspan=2> :: REF <?php print("$p_idref $p_pagename"); ?> </td> 
   </tr>
<?php
while ($obj = $c_db->object_result())
{
     print("<tr><td align=right class=color2 width=20%>" . $l_tabrating["$obj->value"] . "&nbsp;</td> ");
     print("<td class=color3>");
     print("&nbsp;<a href=\"$PHP_SELF?p_ratingaction=listvis&p_idref=$obj->idref&p_value=$obj->value\" class=truelink>$obj->nb</a>");
     print("</td></tr>");
}
?>
 </table> 

<br>

<?php show_back(); ?>
