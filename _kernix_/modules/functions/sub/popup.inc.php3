<?php
function popup($title,$url)
{
  print("<a href='javascript:popup(\"$url\")' class=link>$title</a>");
}
?>
