<?php

$l_sql = "SELECT COUNT(idref) FROM $table_ref WHERE idproduct > 0";
$c_db->query($l_sql);
$nbpages = $c_db->result(0,0);
 
?>

<table width="99%" align="center" border="0">
 <tr>
  <td width="65%" class="main" valign="top" align="left">
   <br>
    :: &nbsp; statistiques boutique &nbsp; < <?=$nbpages?> produits >
   <br><br>

<?php

include("sub/statshome.inc.php3"); 

?>

  </td>
  <td class="main" valign="top" align="right">

<?php 

include("sub/tab_adm.inc.php3"); 

//include("sub/tab_tools.inc.php3");

//include("sub/tab_search.inc.php3"); 

?>

  </td>
 </tr>
</table>

<br><br>

