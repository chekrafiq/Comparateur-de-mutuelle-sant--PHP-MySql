<?php
system("/home/web/degallaix/www/_kernix_/bin/kexec /home/web/degallaix/www/writeAccess/changePerm.sh enableFTP");
sleep(5);
header("Location: http://www.assursante.fr/writeAccess/index.php");
?>
