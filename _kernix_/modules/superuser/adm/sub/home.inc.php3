<?php

if (isset($p_email))
{
  $l_sql = "UPDATE $table_adm SET email = '$p_email' WHERE idadm = 1";
  $c_db->query($l_sql);
}

?>

<table width=95% align=center border=0>
 <tr>
  <td width=70% class=main valign=top align=left>
<br><br>
ATTENTION !! Cette zone n'est utilisable que par les créateurs de ce site. 
  </td>
  <td class=main valign=top align=right>

<?php 

include("sub/tab_tools.inc.php3");

?>

  </td>
 </tr>
</table>

<br><br>

