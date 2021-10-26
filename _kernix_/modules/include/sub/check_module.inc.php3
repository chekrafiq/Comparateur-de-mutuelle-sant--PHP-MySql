<?php

if ((($module->superuserflag == 1) && ($g_power != 1)) || (($module->subscribeflag == 0) && ($g_power != 1))):
?>

<table width=60%>
 <tr>
  <td>
   <p class=main><br><?php print(nl2br($module->description)); ?></p>
  </td>
 </tr>
 <tr>
  <td class=main align=center>
   <br><br><a href="mailto:modules@kernix.com">- infos -</a>
  </td>
 </tr>
</table>

<br><br>

<?php

return 0;
endif;

return 1;

?>
