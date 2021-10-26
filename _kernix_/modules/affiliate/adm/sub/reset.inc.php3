<?php
$p_nbpayment++;
$l_sql = "UPDATE $table_affiliate SET currentorder = '0' , currentaccount = '0' , nbpayment = '$p_nbpayment' WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);
if ($c_db->affectrows > 0)
{
     show_response("le compte a été réinitialisé");
     include("sub/list.inc.php3");
}
else
{
     show_response("problème");
}
?>
