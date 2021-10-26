<?php

if (!is_null($ref->idpub)) 
{ 
  $g_idpub = $ref->idpub;
  include("$g_modulespath/pub/sub/index.inc.php3"); 
}

if ($ref->idboard)
{
     $p_idboard = $ref->idboard;
     include("$g_modulespath/board/sub/index.inc.php3");
}

if ($ref->idform)
{
//     print("<br><br>");
     $g_idform = $ref->idform;
     include("$g_modulespath/form/sub/index.inc.php3");
}


if (!is_null($ref->idpoll))
{
//     print("<br><br>");
     $g_idpoll = $ref->idpoll;
     include("$g_modulespath/poll/sub/index.inc.php3");
}

if ($ref->idegroup)
{
//     print("<br><br>");
     $g_idegroup = $ref->idegroup;
     include("$g_modulespath/egroup/sub/index.inc.php3");
}

if ($ref->alertflag)
{
//     print("<br><br>");
     include("$g_modulespath/alert/sub/index.inc.php3");
}

?>

<?php

if (isset($p_za))
{
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
//    include("code/$p_za.php");
    break; 
  }
}

?>
