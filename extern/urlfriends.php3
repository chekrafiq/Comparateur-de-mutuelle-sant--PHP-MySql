<?php

$REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);

$url_code = "http://urlfriends.kernix.com/index.php3?p_servername=" . urlencode($SERVER_NAME) . "&p_referer=" . urlencode($HTTP_REFERER) . "&p_system=" . urlencode($HTTP_USER_AGENT) . "&p_remotehost=" . urlencode($REMOTE_HOST);

include($url_code);

?>
