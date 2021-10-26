<?php

$l_sql = "SELECT name, data FROM $table_ref WHERE idref = '$p_fromref'";
$c_db->query($l_sql);
$l_row = $c_db->object_result();
$l_tabtmp = get_tabdatas($l_row->data);

?>


<form method="POST" action="<?php print($g_urldyn); ?>">

 <input type=hidden name="p_za"                  value="command">
 <input type=hidden name="p_commandaction"       value="caddie_confirm">
 <input type=hidden name="p_caddiecookieaction"  value="add">
 <input type=hidden name="p_fromref"             value="<?php print($p_fromref); ?>">
 <input type=hidden name="p_fimaflag"            value="<?php print($p_fimaflag); ?>">

<b><?php // print("$gl_chooseoptions"); ?></b>
<br>

<table width="80%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">
 <tr>
  <td class="caddiecolor3" align="left" valign="center" colspan="2">
:: <?=$gl_chooseoptions?> : < <?php print(stripslashes($l_row->name)); ?> >
  </td>
 </tr>
<tr>
 <td class="caddiecolor2" align="right" width="30%">
  <?=$gl_quantity?> &nbsp;
 </td>
 <td class="caddiecolor1">
  &nbsp; <input type="text" class="caddietext" name="p_quantity" value="1" size="2">
 </td>
</tr>

<?php
$i = 0;
while ($l_tabtmp[$i])
{
  if (!ereg("^_",$l_tabtmp[$i][0]))
  {
    $i++;
    continue;
  }
  $l_tabtmp[$i][0] = ereg_replace("^_", "", $l_tabtmp[$i][0]);
  $l_taboptions = explode(',',$l_tabtmp[$i][1]);
  if (sizeof($l_taboptions) > 1)
  {
    print("<tr><td class=caddiecolor2  align=right>" . $l_tabtmp[$i][0] . "&nbsp; </td>");
    print("<td class=caddiecolor1> &nbsp; ");
    print("<select name=\"p_tabopt[]" . $i ."\" class=caddietext>\n");
    $j = 0;
    while ($l_taboptions[$j])
    {
      print("<option value=\"" . urlencode($l_tabtmp[$i][0]) . "=" . urlencode($l_taboptions[$j]) . "\"> -- " . $l_taboptions[$j]) . " -- </option>\n";
      $j++;
    }
    print("</select>");
    print("</td></tr>\n");
  }
  else
  {
    print("<input type=hidden name=p_tabopt[] value=\"" . urlencode($l_tabtmp[$i][0]) . "=" . urlencode($l_tabtmp[$i][1]) . "\">\n");
  }
  $i++;
/*
  if ($l_test[0] != "" && $l_test[1] != "" )
  {
    $l_options = explode(",",$l_test[1]);
    print("<select name=\"p_opt_" . $i ."\" class=select>");
    $j = 0;
    while ($l_options[$j])
    {
      print("<option value=\"" . $l_tabtmp[$i][0] . ":" . $l_options[$j] . "\"> -- " . $l_options[$j]) . " -- </option>";
      $j++;
    }
    print("</select>");
  }
  else
  {
    print("<input type=hidden name=\"p_opt_" . $i ."\" value=\"" . $l_tabtmp[$i][0] . ":" . $l_tabtmp[$i][1] . "\">" . $l_tabtmp[$i][1]);
  }
*/
} 
?>

</table>

<br>
<center>
<input type="submit" value="<?php print("$gl_addtocaddie"); ?>" class="caddiebutton">
<br><?php print("<br><br><a href=\"$PHP_SELF?p_idref=$p_fromref\" class=caddielink>< <b>$gl_cancel</b> ></a>"); ?>
</center>

</form>
