<?php

if ($p_userfile_name == "")
{
     show_response("choisissez un fichier.");
     show_back();
     return 0;
}

if (file_exists("/home/web/$g_accountname/www/upload/$p_rep/$p_userfile_name"))
{
     show_response("<font color=red>-- warning --</font><br>le fichier < <i>$p_userfile_name</i> > existe déjà.<br>");
     show_back();
     return 0;
}

copy("/home/web/$g_accountname/www/upload/$p_rep/$p_oldfile_name","/home/web/$g_accountname/www/upload/$p_rep/$p_userfile_name");
show_response("le fichier <br>< <i>$p_oldfile_name</i> > <br>a bien été copié <br>< <i>$p_userfile_name</i> >.");
print("<br>");
include("sub/file_list.inc.php3");

?>
