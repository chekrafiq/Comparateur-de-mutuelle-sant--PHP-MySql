<?php

//$url = parse_url($REQUEST_URI);
//ereg("(.)*__([0-9]*).html",$url[path],$regs);

if (!isset($p_idref))
{
  ereg("(.)*__([0-9]*).html",$REQUEST_URI,$regs);
  $p_idref = $regs[2];
  include("index.dyn.php3");
}

?>
