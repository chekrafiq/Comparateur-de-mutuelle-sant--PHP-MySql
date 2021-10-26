<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

if (isset($p_aboutaction))
{
     include("$g_modulespath/about/adm/sub/$p_aboutaction.inc.php3");
}
else
{
     include("$g_modulespath/about/adm/sub/infos.inc.php3");
     show_hr();
     include("$g_modulespath/about/adm/sub/comments.inc.php3");
}

show_hr();

?>

<table width=90% align=middle>
 <tr>
  <td align=center>
   <br><img src=/pictures/adm/logo_right.gif vspace=10><br><br>
  </td>
 </tr>
</table>

