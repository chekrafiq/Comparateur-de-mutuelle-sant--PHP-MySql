<?php

$str = exec("mail_view.pl $g_accountname $p_msgid");

?>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=80%>
<tr><td>

<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=left class=color3>
   sujet : <?php print($p_subject); ?>
  </td>
 </tr>
 <tr>
  <td align=center class=list>
  <table border=0 width=95% align=center><tr><td align=left class=list>
  <?php print($str); ?>
  <br>
  </td></tr></table>
 </td>
 </tr>
</table>

</td></tr></table>



<br><br>


<?php
show_back();

?>


