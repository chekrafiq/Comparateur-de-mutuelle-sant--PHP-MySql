<?php
//--- SESSION
function getmysession()
{
  session_start();
  
  $GLOBALS["MYSESSION"] = &$_SESSION;
}

function putmysession()
{
}
//--- END SESSION
?>
