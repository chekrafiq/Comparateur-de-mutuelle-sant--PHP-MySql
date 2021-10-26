<?php

if (isset($p_email))
{
  $l_sql = "UPDATE $table_admsite SET email = '$p_email', refreshrate = '$p_refreshrate' WHERE idadmsite = '1'";
  $c_db->query($l_sql);
  $adm->email = $p_email;
  $adm->refreshrate = $p_refreshrate;
}

?>

<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td width="60%" class="main" valign="top" align="left">
   <br>:: <?=$ln['events_since_last']?> &nbsp;<br>[<small>

<?php
    
if (isset($p_date)) $l_lastsession = date2bdd($p_date) . " 0:0:0";
print(show_datetime($l_lastsession));

?>


   </small>]<br><br>

<?php include("sub/events.inc.php3"); ?>

<br> 

<form action="<?=$PHP_SELF?>" method="POST">
&nbsp;&nbsp; <?=$ln['events_since']?> &nbsp;
<input type="text" class="text" name="p_date" value="<?php print("01/" . date("m/Y")); ?>" size="12">
&nbsp; <input type="submit" class="button" value="<?=$ln['see']?>">
</form>

  </td>
  <td class="main" valign="top" align="right">

<?php 

include("sub/tab_modules.inc.php3");

include("sub/tab_vars.inc.php3"); 

include("sub/tab_search.inc.php3"); 

?>

<br><img src="/pictures/adm/logo_right.gif">
<br><br>
  </td>
 </tr>
</table>

<br>
