<?php

if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}

$p_keywords = keywords2bdd($p_keywords);
if ($p_insertplace == "beginning")
{
  $l_str = "CONCAT('$p_keywords,',keywords)";
}
else
{
  $l_str = "CONCAT(keywords,',$p_keywords')";
}
$l_sql = "UPDATE $table_ref SET keywords = " . $l_str;


$c_db->query($l_sql);

show_response("maj OK");

include("sub/home.inc.php3");

?>
