<?php

if ($p_name == "")
{
  show_response("ATTENTION : le champ nom est vide");
  show_back();
  return 0;
}

if ($p_idproperty == 2) $l_index = ", indexflag = '0'";

$l_sql = "UPDATE $table_ref SET name = '$p_name', design = '$p_design', updatedate = '$l_date', idproperty = '$p_idproperty', link = '$p_link' $l_index WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/ref_view.inc.php3");

?>
