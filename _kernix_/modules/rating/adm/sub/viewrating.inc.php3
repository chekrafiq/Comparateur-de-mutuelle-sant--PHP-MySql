<?php

$l_sql = "SELECT * FROM $table_rating WHERE idrating = 1";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">

<table align=center width=60%> 
 <tr>
  <td align=left class=color1 colspan=3>
   :: Rating
  </td> 
 </tr>

<?php
for ($i=1;$i<=$l_nboptions;$i++)
{
     print("<tr><td align=right valign=top class=color2>choix $i&nbsp;</td>\n");
     print("<td class=color3>\n");
     print("&nbsp;<input type=text name=p_rate$i size=35 class=text value=\"" . $c_db->result(0,"rate$i") . "\">\n");
     print("</td></tr>\n");
}
?>

</table> 

<br>

 <select name=p_ratingaction>
  <option value=updaterating>enregistrer les modifications</option>
  <option value=listresult>voir les résultats</option>
 </select>&nbsp;
 <input type=submit value="éxecuter" class=button>
</form>

<?php show_back(); ?>
