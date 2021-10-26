<?php

$l_sql = "UPDATE $table_admsite set email = '$p_email', refreshrate = '$p_refreshrate', startyear = '$p_startyear', template = '$p_template', openflag = '$p_openflag', charset = '$p_charset', ln = '$p_ln', val1 = '$p_val1', val2 = '$p_val2', val3 = '$p_val3', val4 = '$p_val4', val5 = '$p_val5' WHERE idadmsite = '1'";
$c_db->query($l_sql);

show_response("modification effectuée");

include("sub/view.inc.php3");

?>
