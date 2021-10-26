<?php
if (!isset($p_devisaction))
{
  if ($p_idref == 6) $p_devisaction = "tempdevis";
  if ($p_idref == 17) $p_devisaction = "tempsous";
  if ($p_za == "command")
  {
    $p_devisaction = "retoursous";
    $l_sql = "SELECT * FROM $table_ref as R, $table_property as P WHERE R.idref = '17' AND R.idproperty = P.idproperty AND R.visibilityflag = 1";
    $c_db->query($l_sql);
    $ref = $c_db->object_result();
  }
}
include("DEFAULT.inc.php3");
?>
