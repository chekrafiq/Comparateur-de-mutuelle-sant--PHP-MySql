<?php

$username = $g_login;
$password = $g_password;
$server = "{". $g_ip . "/POP3:110}";

$mbox = imap_open ("$server", "$username", "$password");

echo "<p><h1>Liste des Messages</h1>\n";
$headers = imap_headers ($mbox);

if ($headers == false) 
{
     echo "Call failed<br>\n";
} 
else 
{
     while (list ($key,$val) = each ($headers)) 
     {
          echo " $key | $val <br>\n";
     }
}

imap_close($mbox);
print("<br>");
?>




