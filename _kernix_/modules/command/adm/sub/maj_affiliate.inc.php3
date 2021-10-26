<?php

$l_sql = "SELECT * FROM $table_affiliate WHERE idaffiliate = '$l_row->idaffiliate'";
$c_db->query($l_sql);
$affiliate = $c_db->object_result();

$l_affilmode = $adm->affiliatemode;
$l_affilvalue = $adm->affiliatevalue;

if ($affiliate->affiliatemode != 0)
{
  $l_affilmode = $affiliate->affiliatemode;
  $l_affilvalue = $affiliate->affiliatevalue;
}

if ($l_affilmode == 2)
{
// pourcentage
  $l_affilmaj = $command->priceht * $l_affilvalue / 100;
}
else
{
// Fixe  
  $l_affilmaj = $l_affilvalue;
}


$l_sql = "UPDATE $table_affiliate SET currentaccount = currentaccount + $l_affilmaj, currentorder = currentorder + 1 WHERE idaffiliate = '$l_row->idaffiliate'";
$c_db->query($l_sql);

?>
