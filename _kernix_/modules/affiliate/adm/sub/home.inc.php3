<br>
<table width="98%" align="center" border="0">
 <tr>
  <td width="72%" class="main" valign="top" align="left">
<?php

include("sub/list.inc.php3");

?>
  </td>
  <td class="main" valign="top" align="right">
<?php

include("sub/adminvalues.inc.php3");

?>
  </td>
 </tr>
</table>

<br><br>

<?php

show_hr();

?>

<br>

<form action"<?php print("$PHP_SELF")?>" method=post>
 <select name="p_affiliateaction">
  <option value="add">-- ajouter un affilié --</option>
  <option value="mail">-- faire un mailing à vos affiliés --</option>
 </select>
 &nbsp; <input type=submit value="exécuter" class=button>
</form>
