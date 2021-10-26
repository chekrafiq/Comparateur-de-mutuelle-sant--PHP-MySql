<?php

$mbox = imap_open ("{" . $g_popserver . ":110/pop3/notls}INBOX", $l_poplogin, $l_poppassword);

imap_delete ($mbox, $p_msgno);
imap_expunge ($mbox);

imap_close($mbox);

include("sub/list.inc.php3");

?>
