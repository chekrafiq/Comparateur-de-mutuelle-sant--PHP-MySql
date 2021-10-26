<?php

$l_file = "$l_base/$p_rep/$p_filename";

if ($p_type == "file")
{
  $fp = fopen($l_file,"w");
  fwrite($fp,"");
  fclose($fp);
  show_response("fichier < <i>$p_filename</i>  > créé.");
}
else
{
  if (mkdir($l_file, 0777))
  {
    show_response("répertoire < <i>$p_filename</i>  > créé.");
//    chown($l_file,"root");
//    chgrp($l_file,"root");
    chmod($l_file,0777);
    system("chg_owner $l_file");
    $p_rep .= "/$p_filename"; 
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>problème lors de la création du répertoire.<br>");
  }
}

include("sub/file_list.inc.php3");

?>
