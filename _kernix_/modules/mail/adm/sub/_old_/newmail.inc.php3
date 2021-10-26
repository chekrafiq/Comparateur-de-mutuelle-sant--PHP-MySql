<?php

$l_email = $adm->email;

?>

<br>

<form action="<?php print("$PHP_SELF"); ?>" method="POST">
<input type=hidden name=p_mailaction value=sendmail>
<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=middle width=70%><tr><td>

<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center class=color3>
  <table border=0 align=center>
   <tr>
    <td align=right class=color3>from</td>
    <td align=left class=color3>
     <input name=p_from type=text class=text size=30 value="<?php print("$l_email"); ?>">
    </td>
   </tr>
   <tr>
    <td align=right class=color3>to</td>
    <td align=left class=color3>
     <input name=p_to type=text class=text size=30>
    </td>
   </tr>
   <tr>
    <td align=right class=color3>sujet</td>
    <td align=left class=color3>
     <input name=p_subject type=text class=text size=50>
    </td>
   </tr>
   <tr>
    <td align=right valign=top class=color3>body</td>
    <td align=left class=color3>
     <textarea name=p_body class=text cols=50 rows=8></textarea>
    </td>
   </tr>
   <tr>
    <td align=middle class=color3 colspan=2>
     <input type=submit class=button value="envoyer"></td>
   </tr>   
  </table>
  </td>
 </tr>
</table>
</td></tr></table>
</form>

<br>






