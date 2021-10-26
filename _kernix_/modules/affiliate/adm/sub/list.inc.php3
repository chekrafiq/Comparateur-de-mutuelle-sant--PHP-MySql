<?php

$l_sql = "SELECT affiliatemax FROM $table_affiliateadm";
$c_db->query($l_sql);
$l_max =  $c_db->result(0,"affiliatemax");

if ($p_type == "all")
{
     $l_sql = "SELECT * FROM $table_affiliate ORDER BY idaffiliate DESC";
}
elseif ($p_type == "topay")
{
     $l_sql = "SELECT * FROM $table_affiliate WHERE currentaccount >= '$l_max' ORDER BY currentaccount DESC";
}
else
{
     $l_sql = "SELECT * FROM $table_affiliate ORDER BY idaffiliate DESC LIMIT 0,20";
}
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun affilié"); 
     return 0;
}

?>

<table align=center valign=top width=98%>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center width=40%>
   ordre
  </td>
  <td class=color2 align=center>
   compte
  </td>
  <td class=color2 width=15% align=center>
   commandes
  </td>
  <td class=color2 width=15% align=center>
   visiteurs
  </td>
 </tr>

<?php
$i = 0;
while ($affiliate = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     if ($affiliate->currentaccount >= $l_max)
     {
	  $l_class = "warning";
     }
     print("<tr>");
     print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_affiliateaction=view&p_idaffiliate=$affiliate->idaffiliate\" class=truelink>$affiliate->idaffiliate</a></td>");
     print("<td class=$l_class align=center>");
     print("$affiliate->payableto");
     print("</td>");
     print("<td class=$l_class align=center>$affiliate->currentaccount</td>");
     print("<td class=$l_class align=center>$affiliate->currentorder</td>");
     print("<td class=$l_class align=center>$affiliate->nbvisitor</td>");
     print("</tr>");
}
?>
</table>

<center>

<form action"<?php print("$PHP_SELF")?>" method=post>
<input type=hidden name="p_affiliateaction" value="home">
 <select name=p_type>
  <option value="topay">-- lister les affiliés devant être payés --</option>
  <option value="all">-- lister tous les affiliés --</option>
 </select>
 &nbsp; <input type=submit value="exécuter" class=button>
</form>

</center>
