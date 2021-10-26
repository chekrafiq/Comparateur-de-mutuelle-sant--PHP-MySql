<?php

$mbox = imap_open ("{" . $g_popserver . ":110/pop3/notls}INBOX", $l_poplogin, $l_poppassword);

?>


<?php


if ($p_mailheaderflag == 'full')
{
  $s = imap_fetchheader ($mbox,$p_msgno);
  $s = nl2br($s);
  $c = "<a href=\"$PHP_SELF?p_mailaction=view&p_msgno=$p_msgno&p_mailheaderflag=simple\">&#171;</a>";
}
else
{
  $obj = imap_headerinfo($mbox,$p_msgno);
//  $t = imap_mime_header_decode($obj->fromaddress);
  $t = imap_mime_header_decode($obj->from[0]->personal);
  $s = "From : " . $t[0]->text . "\n";
  $s .= " - " . $obj->from[0]->mailbox . "@" . $obj->from[0]->host;
  $l_replyto = $obj->from[0]->mailbox . "@" . $obj->from[0]->host;
  if ($obj->to[0]->personal) $l_to = $obj->to[0]->personal . " - ";
  $s .= "<br>To : $l_to" . $obj->to[0]->mailbox . '@' . $obj->to[0]->host . "\n";
  $t = imap_mime_header_decode($obj->subject);
  $s .= "<br>Sujet : " . $t[0]->text . "\n";
  $s .= " - " . date("d/M/Y h:m:s",$obj->udate) . "\n";
  $c = "<a href=\"$PHP_SELF?p_mailaction=view&p_msgno=$p_msgno&p_mailheaderflag=full\">&#187;</a>";
  if (!empty($obj->reply_to[0]->mailbox)) $l_replyto = $obj->reply_to[0]->mailbox . '@' . $obj->reply_to[0]->host;

}

?>

<table width="80%" border="1" bordercolor="#CCCCCC">
<tr><td align="left" class="main">

<?php

echo $s;

?>


</td>
</tr>
<tr>
<td align=right>
<?php echo "$c"; ?>
</td>
</tr>
</table>





<br><br>

<?php

$s = imap_fetchbody ($mbox,$p_msgno,1);

$s = nl2br($s);

?>

<table width="80%" border="1" bordercolor="#CCCCCC">
<tr><td align="left" class="main">

<?php

echo $s;

imap_close($mbox);

?>


</td>
</tr>
</table>


<br>

<form action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="p_msgno" value="<?=$p_msgno?>">
<input type="hidden" name="p_replyto" value="<?=$l_replyto?>">
<select name="p_mailaction">
<option value="list">-- retour à la liste --</option>
<option value="compose">-- repondre à ce message --</option>
<option value="delete">-- supprimer ce message --</option>
</select>
<input type="submit" class="button" value="exécuter">
</form>

<br>

<?php show_back(); ?>
