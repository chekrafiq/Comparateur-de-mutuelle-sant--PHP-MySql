<?php

$p_email = strtolower($p_email);

$l_sql = "SELECT E.subject AS subject, E.idegroup AS idegroup FROM $table_email AS EE, $table_egroup AS E WHERE EE.status = '1' AND EE.email = '$p_email' AND E.idegroup = EE.idegroup";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_ca_response("vous n'êtes inscrit à aucune newsletter");
     show_ca_back();
     return 0;
}

?>

<form method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_clientadminaction" value="emailsuppress">	
<input type="hidden" name="p_email"             value="<?=$p_email?>">	

<table align="center" width="90%"> 

<?php
while ($obj = $c_db->object_result())
{
     print("<tr><td align=right class=main><input type=checkbox name=p_tabegroup[] value=$obj->idegroup></td>\n");
     print("<td class=main>&nbsp; $obj->subject</td></tr>\n");
     $l_tabegroup[] = $obj->idegroup;
}
?>

 <tr>
  <td class="main" align="center" colspan="2">
   <br><br><br><input type="submit" value="supprimer mon email de ces newsletters" class="button">
  </td>
 </tr>
</table>

