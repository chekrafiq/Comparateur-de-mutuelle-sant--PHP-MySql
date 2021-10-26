<?php

//function myurldecode(&$item,$key)
//{
//     $tmp = explode("=",$item);
//     $item[] 
//     $key = urldecode($key);
//     echo "[$key $item]";
//}

//$l_datas = "p_propertyaction=result&nom=bois&pays=bleu&adresse=47+rue+brancion&prenom=fxb";
$l_tabtmp = explode("&",$l_datas);
array_shift($l_tabtmp);
//array_walk($l_tabd,'myurldecode');


$n = count($l_tabtmp);
$i = 0;
while ($l_tabtmp[$i])
{
     $l_tabtmp2 = explode("=",$l_tabtmp[$i]);
     $l_toto = urldecode($l_tabtmp2[0]);
     $l_tabd["$l_toto"] = urldecode($l_tabtmp2[1]);
     $i++;
} 

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);
$obj = $c_db->object_result();
$l_tabp = explode("&&",$obj->structure);
?>

<form method=get action="<?php echo "$PHP_SELF"; ?>">
<input type=hidden name=p_propertyaction value=result>
<input type=hidden name=p_shopadmaction value=result>
<input type=hidden name=p_idref value="<?php echo "$p_idref"; ?>">
<table align=center width=90% align=center> 
   <tr>
    <td align=left class=color1 width=90% colspan=2> :: les options
    </td> 
   </tr>

<?php

$i = 0;
while($l_tabp[$i])
{
$l_prop = explode(";;",$l_tabp[$i]);
print("<tr><td align=right class=color2 width=30%  valign=top>" . $l_prop[0]  . "</td>");
print("<td class=color3 align=left>");
if ($l_prop[1] == 0)
 {
      print("<input type=text size=50 class=text name=\"" . $l_prop[0]  ."\" value=\"" . $l_tabd[$l_prop[0]] . "\">");
 }

if ($l_prop[1] == 2)
 {
      $l_options = explode(",",$l_prop[2]);
      print("<select name=\"" . $l_prop[0]  ."\">");
      $j = 0;
      while ($l_options[$j])
      {
	   if ($l_options[$j] == $l_tabd[$l_prop[0]])
	   {
		print("<option value=\"" . $l_options[$j] . "\" SELECTED> --- " . $l_options[$j]) . " --- </option>";
	   }
	   else
	   {
		print("<option value=\"" . $l_options[$j] . "\"> --- " . $l_options[$j]) . " --- </option>";
	   }
      $j++;
      }
      print("</select>");
 }
if ($l_prop[1] == 1)
 {
      print("<textarea cols=50 rows=10 name=\"" . $l_prop[0]  ."\">" . $l_tabd[$l_prop[0]] . "</textarea>");
 }
print("</td></tr>");
$i++;

}
?>

</table>
<br>
<input type=submit class=button value="validez">
</form>

<br>

<?php show_back(); ?>
