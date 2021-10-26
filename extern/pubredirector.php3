<?php

include ("_kernix_/var.inc.php3");

$table_pub    = "pub";
$table_publog = "publog";

$REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);

if ($_COOKIE["KERNIX" . $g_version])
{
  $c_cookie = new Cookie("KERNIX" . $g_version, $_COOKIE["KERNIX" . $g_version]);
  $p_id = $c_cookie->search("id");
}
?>

<html>
<body bgcolor=white>
<br>

<table align=center>
 <tr>
  <td>

   KerniX redirector ...<br>
   
<?php

$l_sql = "UPDATE $table_pub SET nbclick = nbclick + 1 WHERE idpub = '$p_idpub'";
$c_db->query($l_sql);
//print("->$l_sql<br>");

$l_sql = "INSERT INTO $table_publog (idvisitor,idpub,remotehost,date) VALUES ('$p_id','$p_idpub','$REMOTE_HOST','$l_date')";
$c_db->query($l_sql); 

$c_db->close();

?>

<Script language=javascript>
 document.location = "<?php print("$p_url"); ?>";
</Script>

  </td>
 </tr>
</table>

<br>

</body>
</html>
