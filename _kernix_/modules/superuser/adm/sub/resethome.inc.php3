<?php

$t_tables = array ("client","log","logadm","logaltern","numsession","visitor","command","session","keywords","ratingresult","pollpost","publog","email","hash","alert","logerror","formpost","gbpost");

sort($t_tables);

?>

<form method="POST" action="<?php print("$PHP_SELF");?>">
<input type="hidden" name="p_idusers" value="<?php print("$p_idusers"); ?>">
<input type="hidden" name="p_superuseraction" value="resetexec">

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=60%>
<tr><td class=main>

<table bgcolor=w border=0 cellspacing=1 cellpadding=1 width=100%>

  <tr>
   <td class=color2 align=center>
     &#187; tables &#171;
   </td>
  </tr>

  <tr>
   <td class=list align=left>
    <br>
<?php

$i = 0;
while ($t_tables[$i])
{
  print("&nbsp;&nbsp; <input type=checkbox name=p_tables[] value=" . $t_tables[$i] . " CHECKED>&nbsp; " . $t_tables[$i] . "<br>");
  $i++;
}

?>
    <br>
   </td>
  </tr>

  <tr>
   <td class=list align=center>
    <input type=submit class=button value="reset tables">
   </td>
  </tr>
 </table>

</td></tr></table>

<br><br>

</form>
