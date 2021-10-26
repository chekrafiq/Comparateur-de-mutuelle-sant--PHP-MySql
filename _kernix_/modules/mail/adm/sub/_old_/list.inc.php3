<?php

$str = exec("mail_check.pl $g_accountname");
#$str = exec("mail_checkl.pl");
#$str = exec("test.pl kernix");

//$str = system(lss);
//print("---- $str ----");

$tab1 = explode("##",$str);
$nbemail = explode("||",$tab1[0]);
$msg = explode("||",$tab1[1]);

//print("$nbemail[1]");
?>

<table width=98% align=center>
<tr>
 <td class=color2 height=20 align=center>from</td>
 <td class=color2 width=50%>sujet</td>
 <td class=color2 align=right>date</td>
</tr>

<?php
$n = $nbemail[1];
$j = 0;
for ($i=0;$i<$n;$i++)
{
  if (($j++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
  $elem = explode(";;",$msg[$i]);
  print("<tr>");
  print("<td class=$l_class align=center>" . strtr(trim($elem[0]),"<> ","  ,") . "</td>");
  print("<td class=$l_class> <a href=$PHP_SELF?p_mailaction=view&p_msgid=$elem[3]&p_subject=" . urlencode($elem[1])  . " class=truelink> $elem[1] </a></td>");
  print("<td class=$l_class align=right>$elem[2]</td>");
  print("</tr>");
}

print("</table>");

print("<br>");
show_hr();
print("<br>");
include("sub/newmail.inc.php3");
print("<br>");
show_back();

?>


