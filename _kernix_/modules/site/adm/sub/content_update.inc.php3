<?php

if ($p_richeditflag == 1) $p_content = eregi_replace("<br>", "\n", $p_content);

$l_sql = "UPDATE $table_ref SET title = '$p_title', content = '$p_content', updatedate = '$l_date', content_typeflag = $p_content_typeflag, picture = '$p_picture', icon = '$p_icon', template = '$p_template', accroche = '$p_accroche' WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/content_view.inc.php3");

?>
