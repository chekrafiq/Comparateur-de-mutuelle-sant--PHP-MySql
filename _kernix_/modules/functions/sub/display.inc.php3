<?php

function show_bench()
{
  global $g_stop_time, $g_start_time;
  
  $mtime = microtime();
  $mtime = explode( ' ' , $mtime );
  $g_stop_time = $mtime[ 1 ] + $mtime[ 0 ] ;
  $difftime = $g_stop_time - $g_start_time;
  print("<br><table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=120><tr><td>");
  print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
  printf("<tr><td bgcolor=white align=center><small><font color=black>l.o.a.d # %.3f</font></small></td></tr>",$difftime);
  print("</table>");
  print("</td></tr></table>");
}

function generate_comment($n)
{
  srand ((double) microtime() * 1000000);
  $randval = rand();
  $l_randnum = rand(1,5);
  $l_white = "                                                                                 ";
  $l_white .= $l_white;
  $l_white .= $l_white;
  $l_white .= $l_white . "\n";
  
  $i = 0;
  while ($i < $n)
  {
    $l_str .= $l_white;
    $i++;
  }
  print("\n<!-- DON'T COPY - CODE PROTECTED - KERNIX.COM -->\n");
  print($l_str);
}

?>
