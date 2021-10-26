<?php

//$p_content = text2bdd($p_content);

$p_content = eregi_replace("<br>","\n",$p_content);

//echo $p_content;


$l_sql = "UPDATE $table_ref SET content = '$p_content', link = '$p_link', script = '$p_script', updatedate = '$l_date' WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("enregistrement effectué");

include("$g_modulespath/site/adm/sub/content_view.inc.php3");

?>
