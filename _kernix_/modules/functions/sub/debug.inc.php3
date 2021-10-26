<?php
function debug($str, $flag)
{
  global $g_debugflag;

  if ($g_debugflag)
  {
    print($str);     
  }
}
?>
