<html>
<head><title><?php print($ref->name); ?></title></head>
<body bgcolor=white color=black>

<br>

<table align=center width=90%>
 <tr>
  <td align=left>

<?php

print("<p><b>" . $ref->name . "</b></p><br>\n");
print(bdd2html($ref->content) . "\n");

?>

<br><br><br><small>generated with KerniX WEB OFFICE, <a href=<?php print($g_softurl); ?>>kernix.com</a></small>
  </td>
 </tr>
</table>

<br><br>

</body>
</html>
