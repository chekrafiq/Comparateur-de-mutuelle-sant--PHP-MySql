<?php

$l_file = "$l_base/$p_rep/$p_userfile_name";
$fp = fopen($l_file,"w+");
fwrite($fp,stripslashes($p_content));
fclose($fp);
show_response("enregistrement du fichier<br> < <i>$p_filename</i>  ><br> effectué.");
print("<br>");
include("sub/file_list.inc.php3");

?>
