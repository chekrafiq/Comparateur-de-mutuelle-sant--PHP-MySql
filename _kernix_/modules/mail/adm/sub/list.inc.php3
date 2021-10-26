<?php

$mbox = imap_open ("{" . $g_popserver . ":110/pop3/notls}INBOX", $l_poplogin, $l_poppassword);

$tmp = imap_check($mbox);
$nbmsg = $tmp->Nmsgs;
$tab_headers = imap_fetch_overview($mbox,"1:$nbmsg",0);
$tab_headers = array_reverse($tab_headers);

?>

<table width="98%" align="center">

 <tr>
  <td class="color2" align="center" width="3%" height="20">id</td>
  <td class="color2" align="center" width="28%">origine</td>
  <td class="color2" align="center" width="49%">sujet</td>
  <td class="color2" align="center" wdith="20%">date</td>
 </tr>

<?php

foreach ($tab_headers AS $obj) 
{
  if (($i++ % 2) == 0): $l_class = "listdarksmall"; else : $l_class = "listlightsmall"; endif;
//  if ($obj->seen == 0) $l_class = 'warning';
  print("<tr>\n");
  print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_mailaction=view&p_msgno=$obj->msgno\" class=truelink>$obj->msgno</a></td>\n");
  $t = imap_mime_header_decode($obj->from);
//  $l_from = $t[0]->text;
//  $l_from = $obj->from;
//  $l_from = ereg_replace("<",'&lt;',$l_from);
//  $l_from = ereg_replace(">",'&gt;',$l_from);
  print("<td class=$l_class> &nbsp; " . $t[0]->text . " </td>\n");
  $t = imap_mime_header_decode($obj->subject);
  print("<td class=$l_class> &nbsp; " . $t[0]->text . " - <i>" . $obj->size . "b</i></td>\n");
  print("<td class=$l_class align=center>" . date("d/m/y G:i", strtotime($obj->date)) . "</td>\n");
  print("</tr>\n");
}


imap_close($mbox);

?>

</table>

<br><br>

