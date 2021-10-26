<?php

$p_keywords    = keywords2bdd($p_keywords);

$l_sql = "UPDATE $table_ref SET title_ref = '$p_title_ref', description = '$p_description', keywords = '$p_keywords', updatedate = '$l_date' WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/referencement_view.inc.php3");

?>
