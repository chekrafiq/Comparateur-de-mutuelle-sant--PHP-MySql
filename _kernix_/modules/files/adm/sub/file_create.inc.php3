<?php

$l_file = "$l_base/$p_rep/$p_filename";

if ($p_type == "file")
{
  $fp = fopen($l_file,"w");
  fwrite($fp,"");
  fclose($fp);
  show_response("fichier < <i>$p_filename</i>  > cr��.");
}
else
{
  if (mkdir($l_file, 0777))
  {
    show_response("r�pertoire < <i>$p_filename</i>  > cr��.");
//    chown($l_file,"root");
//    chgrp($l_file,"root");
    chmod($l_file,0777);
    system("chg_owner $l_file");
    $p_rep .= "/$p_filename"; 
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>probl�me lors de la cr�ation du r�pertoire.<br>");
  }
}

include("sub/file_list.inc.php3");

?>
