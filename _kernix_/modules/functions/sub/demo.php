<html>
<head>
<title>PHP TreeMenu Demo (c)1999 Bjorge Dijkstra (bjorge@gmx.net)</title>
<style>
  BODY { font-family : Verdana,Arial; }
  TD   { font-family : Verdana,Arial; font-size : 8pt; }
  A    { text-decoration : none; background-color : #EEFFEE; }
</style>
</head>
<body bgcolor=#eeffee link=#339933>
<table border=1 cellspacing=0 width=100%>
<tr><td bgcolor=#eeeeff align=center><font size=2><b>
PHP TreeMenu 1.1
</b></font></td></tr>
</table>
<?php  
  /*********************************************/
  /*  PHP TreeMenu Demo                        */
  /*                                           */
  /*  Demonstration Web page for               */
  /*  PHP TreeMenu 1.1                         */
  /*                                           */
  /*  (c)2001 Bjorge Dijkstra                  */
  /*  email : bjorge@gmx.net                   */
  /*                                           */  
  /*********************************************/

  /*********************************************/
  /*  Set file with menu structure             */
  /*********************************************/
  
  $treefile = "demomenu.txt";
  
  /*********************************************/
  /*  Include tree code                        */
  /*********************************************/
  
  require "treemenu.inc";
?>

</body>
</html>