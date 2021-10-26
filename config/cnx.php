<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnx = "localhost";
$database_cnx = "degallaix-tarificateur";
$username_cnx = "degallaix";
$password_cnx = "SYPcs1n1";
//$cnx = mysql_pconnect($hostname_cnx, $username_cnx, $password_cnx) or trigger_error(mysql_error(),E_USER_ERROR); 
$cnx = mysql_connect("localhost", 
        "degallaix", 
        "SYPcs1n1");
?>