<?php

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
$ref   = $c_db->object_result();

$p_idproperty = $ref->idproperty;
$l_datas      = $ref->data;

$l_tabd = get_datasbycode($l_datas);

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);
$prop   = $c_db->object_result();

if (empty($prop->structure))
{
  $l_sql = "UPDATE $table_ref SET data = '' WHERE idref = '$p_idref'";
  $c_db->query($l_sql);
}

include("sub/onglet.inc.php3");

?>

<br>Les propriétés présentées ici dépendent du type de page sélectionné.<br>

<?php
if (empty($prop->structure))
{
  print('<br>');
  show_hr();
  print('<br>');
  show_response("Le type de cette page ne possède aucune propriété particulière.");
  return 0;
}

?>



<form method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idproperty"     value="<?=$p_idproperty?>">

<table align="center" width="100%" align="center"> 
 <tr>
  <td align="left" class="color1" colspan="2" height="20">
   :: [ <small>page#<?=$p_idref?></small> ] options : <small><?=$ref->name?></small>
  </td> 
 </tr>

<?php

$l_tabp = explode("&&",$prop->structure);
$i = 0;
while($l_tabp[$i])
{
  $l_valign = "";
  $l_prop = explode(";;",$l_tabp[$i]);
  if ($l_prop[2] == 1) $l_valign = "valign=top";
  print("<tr><td align=right class=color2 width=25% $l_valign>" . $l_prop[1]  . " &nbsp;</td>\n");
  print("<td class=color3 align=left>");
  if ($l_prop[2] == 0)
  {
//    print("<input type=text size=50 class=text name=\"" . $l_prop[0]  ."\" value=\"" . stripslashes($l_tabd[$l_prop[0]]) . "\">");
    print("<input type=text size=60 class=text name=\"" . $l_prop[0]  ."\" value=\"" . $l_tabd[$l_prop[0]] . "\">");
  }
  
  if ($l_prop[2] == 2)
  {
    $l_options = explode(",",$l_prop[3]);
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
  if ($l_prop[2] == 1)
  {
    $l_val = $l_tabd[$l_prop[0]];
//    $l_val = ereg_replace("<br>", "\n", $l_val);
//    $l_val = stripslashes($l_val);
    print("<textarea cols=60 rows=10 name=\"" . $l_prop[0]  ."\">" . $l_val . "</textarea>");
  }
  print("</td></tr>\n");
  $i++;
}
?>

 <tr>
  <td colspan="2" align="center">

   <br>
    <input type="hidden" name="p_idref" value="<?=$p_idref?>">
    <select name="p_siteadmaction" size="1">
     <option value=property_update selected> -- enregistrer les modifications -- </option>
    </select>
    <input type="submit" name="submit" value="exécuter" class="button">
    <br><br>
  </td>
 </tr>

</table>

</form>
