<?php

//$tmpdir = "/home/web/$g_accountname/tmp";
//$tmpdir = "/tmp";

if ($p_userfile_name == "")
{
  show_response("choisissez un fichier.");
  include("sub/select_localfile.inc.php3");
  show_hr();
  include("sub/select_remotedir.inc.php3");
  return 0;
}

if (file_exists("/var/web/$g_accountname/www/".$p_rep."/$p_userfile_name") && !isset($p_uploadflag))
{
  show_response("<font color=red>-- warning --</font><br>le fichier < <i>$p_userfile_name</i> > existe déjà.<br>");
  include("sub/select_localfile.inc.php3");
  show_hr();
  include("sub/select_remotedir.inc.php3");
  return 0;
}

if (is_uploaded_file("$p_userfile"))
{
  if (move_uploaded_file("$p_userfile","/var/web/$g_accountname/www/".$p_rep."/$p_userfile_name"))
  {
    
    show_response("le fichier < <i>$p_userfile_name</i> > <br>a bien été transmis. [$p_userfile_size]");
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>problème lors de la copie.<br>");
  }
}
else
{
  show_response("<font color=red>-- warning --</font><br>le fichier < <i>$p_userfile_name</i> > n'a pas été uploadé.<br>");
}
include("sub/select_localfile.inc.php3");
show_hr();
include("sub/select_remotedir.inc.php3");

?>
