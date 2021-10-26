<script language="Javascript">
function formHandler(form1)
{
	var myindex = zonetogo.zone.selectedIndex;
	var url = zonetogo.zone.options[myindex].value;
	this.location.href= url;
}
</script>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=95%><tr><td>

<table bgcolor=black border=0 cellspacing=1 cellpadding=0 width=100%>
 <tr>
  <td align="center" class="color3" height="20">
.:: zone ::.
  </td>
 </tr>

<form action="<?php print($PHP_SELF); ?>" method="POST" name="zonetogo">
 <input type="hidden" name="p_portaction" value="pays">
 <tr><td class="list" align="center" height="40"><select name="zone" size="1" onChange="formHandler(this.form)">
       <option>- - - - - - - - P A Y S - - - - - - - -</option>
<?php
$l_sql = "SELECT id_portzone, zone_name FROM $table_portzone ORDER BY zone_name";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("<option value=\"?p_portaction=pays&p_idportzone=$obj->id_portzone\">$obj->zone_name</option>");
}
?>
</select>
  </td>
 </tr> 
</form>

</table>
</td></tr></table>
