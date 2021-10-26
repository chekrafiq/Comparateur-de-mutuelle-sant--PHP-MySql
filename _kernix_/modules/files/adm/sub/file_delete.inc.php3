<?php

if (!file_exists("/home/web/$g_accountname/www/upload/$p_rep/$p_userfile_name"))
{
     show_response("<font color=red>-- warning --</font><br>le fichier < <i>$p_userfile_name</i> > n'existe pas.<br>");
     show_back();
     return 0;
}

unlink("/home/web/$g_accountname/www/upload/$p_rep/$p_userfile_name");
show_response("le fichier <br>< <i>$p_userfile_name</i> > <br>a bien été supprimé.");
print("<br>");
include("sub/file_list.inc.php3");

?>
