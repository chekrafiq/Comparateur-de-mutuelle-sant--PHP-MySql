<?php

if (!isset($p_za))
{
//  print("<a href=/>retour</a>");
  print('&nbsp;');
  return 0;
}

switch ($p_za)
{
 case "command":
   $g_zaname = " ::COMMAND:: $p_commandaction";
   include("$g_modulespath/command/sub/_top.inc.php3");
   include("$g_modulespath/command/sub/index.inc.php3");
   include("$g_modulespath/command/sub/_bottom.inc.php3");
   break;
 case "poll":
   $g_zaname = "::POLL:: graph";
   include("$g_modulespath/poll/sub/graph.inc.php3");
   break;
 case "search":
   $g_zaname = "::SEARCH:: $words - $page";
   include("$g_modulespath/searchengine/sub/index.inc.php3");
   break; 
 case "affiliate_text":
   $g_zaname = "::AFFILIATE:: txt";
   include("$g_modulespath/affiliate/sub/affiliate_text.inc.php3");
   break; 
 case "sale_text":
   $g_zaname = "::SALE:: txt";
   include("$g_modulespath/command/sub/command_sale_text.inc.php3");
   break; 
 default:
   $g_zaname = "::ZA:: empty";
   include("code/$p_za.php");
   break; 
}

?>
