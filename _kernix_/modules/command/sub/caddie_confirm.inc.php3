<br>

<?=$gl_confirm?>

<br><br><br>

<table border="0">
 <tr>
  <td class="caddiecolor1" align="left">

<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_idref"       value="<?=$p_fromref?>">
 <input type="submit" value="&#171; <?=$gl_buymore?> &#187;"  class="caddiebutton">
</form>

  </td>
  <td  class="caddiecolor1" align="right">

<form method="POST" action="<?=$g_urldyn?>">
 <input type="hidden" name="p_fromref"       value="<?=$p_fromref?>">
 <input type="hidden" name="p_commandaction" value="caddie_view">
 <input type="hidden" name="p_za"            value="command">
 <input type="submit" value="&#171; <?=$gl_validatecommand?> &#187;"  class="caddiebutton">
</form>

  </td>
 </tr>
</table>









