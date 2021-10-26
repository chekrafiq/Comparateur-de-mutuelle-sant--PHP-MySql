<html>
<body bgcolor="white">
<br>

<table align="center">
 <tr>
  <td>

   KerniX redirector ...<br>

<?php

include ("_kernix_/var.inc.php3");

$table_redirect = "redirect";

if ($_COOKIE["KERNIX" . $g_version])
{
  $c_cookie = new Cookie("KERNIX" . $g_version, $_COOKIE["KERNIX" . $g_version]);
  $p_id = $c_cookie->search("id");
}

if ($p_idmailing != "%%IDMAILING%%")
{
  $l_sql = "INSERT INTO $table_redirect (idmailing,url,date) VALUES ('$p_idmailing','$p_url','$l_date')";
  $c_db->query($l_sql);
}

print("Redir : <b>$p_url</b>"); 
print("<br><br> or click &nbsp;&nbsp;  <a href=$p_url class=maillink> >> h e r e << </a>");

?>

<script language=javascript>
function zero(str) {
     document.location = str; 
}
window.setTimeout("zero('<?=$p_url?>')",1500);
</script>

  </td>
 </tr>
</table>

<br>

</body>
</html>

