<?php
if ($g_copyrightflag == 1)
{
     include("$g_designpath/common/copyright.inc.php3");
}

if ($g_dateviewflag == 1)
{
  if ($p_idref > 0)
  {
    print("<div align=center class=copyright>dernière maj - " . show_date($ref->updatedate) . "</div>");
  }
}

if ($g_cookieviewflag == 1)
{
     print($_COOKIE["KERNIX" . $g_version] . " - " . $_COOKIE['KERNIXSEED']);
     print("<br>$g_cookiemsg");
}

if ($g_benchflag == 1)
{
     show_bench();
}

if ($g_firstvisflag == 1)
{ 
  include("$g_modulespath/traffic/sub/logvisitor.inc.php3"); 
}
elseif ($g_logflag == 1)
{ 
  include("$g_modulespath/traffic/sub/logvisit.inc.php3"); 
}

?>
