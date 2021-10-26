<?php

if (!is_null($ref->idpub)) 
{ 
  $g_idpub = $ref->idpub;
  include("$g_modulespath/pub/sub/index.inc.php3"); 
  print("<br><br>");
}

?>
