<?php

// CODE ERRORS :
// 1 : aucun problem
// 2 : pb quantité ou ref
// 3 : prix nul
// 4 : pas de produits en stock

switch($g_caddie_error)
{
 case "2":
   $l_caddie_error_msg = "pb quantité ou ref";
   break;
 case "3":
   $l_caddie_error_msg = "prix nul";
   break;
 case "4":
   $l_caddie_error_msg = "pas de produits en stock";
   break;  
}

print("<br>ATTENTION - $l_caddie_error_msg<br><br>");

if ($l_back == "history") echo '<input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton"><br><br>';

return 1;

?>
