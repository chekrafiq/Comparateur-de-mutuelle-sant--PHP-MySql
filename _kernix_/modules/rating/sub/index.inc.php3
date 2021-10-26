<?php

// $g_ratinginfos = 1   => on peutvoir les résultats

$table_rating = "rating";
$table_ratingresult = "ratingresult";
$table_ref = "ref";

if ($p_ratinginputflag == "yes")
{
     if ($p_rateid != 0)
     {
	  $l_sql = "INSERT INTO $table_ratingresult (idref,idvisitor,value,date) VALUES ('$g_idref','$g_idvisitor','$p_rateid','$l_date')";
	  $c_db->query($l_sql);
     }
     return 1;
}
?>

<table width=100% align=center border=0 cellpadding=0 cellspacing=0>
<form name="formrating" method="post" action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name=p_ratinginputflag value=yes>
<input type=hidden name=p_idref value=<?php print("$g_idref"); ?>>
<tr><td class=right align=center colspan=2>

<select name="p_rateid" size="1" onChange="javascript:this.document.formrating.submit();" class="topselect">
<option value=0 class=topselect>je donne mon avis ...</option>
<?php
$l_sql = "SELECT * FROM $table_rating";
$c_db->query($l_sql);
for ($i=1;$i<=5;$i++)
{
     $l_val = $c_db->result(0,"rate$i");
     print("$l_val --");
     if ($l_val)
     print("<option value=$i>-- $l_val --</option>");
}
?>
</select>
<?php

if ($g_ratinginfos == 1)
{
     print("<br><br>");
     print("<a href=$PHP_SELF?p_idref=$g_idref&p_rateaction=view>voir les resultats</a");
     print("( $l_total avis )");
     print("<br><br>");
}

?>
</td>
</tr>
</form>
</table>
