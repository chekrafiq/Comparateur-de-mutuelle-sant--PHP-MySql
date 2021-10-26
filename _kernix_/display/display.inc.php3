<?php

function crosslink($str)
{
  print("<br><b><font class=h>VOIR AUSSI</font></b> : <br>");
  $l_tablinks = get_tabcrosslinks($str);
  $i = 0;
  while($l_tablinks[$i])
  {
    print(" <img src=/pictures/arrow_link.gif> <a href=" . $l_tablinks[$i]["url"]  . ">" . $l_tablinks[$i]["name"] . "</a><br>"); 
    $i++;
  }
  return 1;
}

//if ($ref->idproduct > 0)
//$l_namedisplay = "PRODUCT";
//else

$l_namedisplay = $ref->propertyname;

$tab_todefaultdisplay = array("RUBRIQUE", "PRODUIT", "DETAIL_PRODUIT");

if (in_array($l_namedisplay, $tab_todefaultdisplay)) $l_namedisplay = "DEFAULT";

include("$g_displaypath/pages/$l_namedisplay.inc.php3");

?>
