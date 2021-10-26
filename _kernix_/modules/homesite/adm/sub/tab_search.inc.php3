<br>
<form action="/<?=$g_modulespath?>/site/adm/index.php3" <?=$l_target?>>
<input type="hidden" name="p_siteadmaction" value="ref_search">

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" width="80%"><tr><td>

<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>
  <td align="center" class="color3">.:: <?=$ln['search']?> ::.</td>
 </tr>
 <tr>
  <td class="list" align="center">
   <br>&nbsp;<input name="p_searchitem" type="text" class="text">
   <input type="image" value="submit" src="/pictures/adm/search.png" align="absmiddle"><br><br></td>
 </tr>
<!-- 
 <tr>
  <td align="center" class="list">
   <input type="submit" value="<?=$ln['execute']?>" class="button">
  </td>
 </tr>
-->
</table>
</td></tr></table>

</form>
