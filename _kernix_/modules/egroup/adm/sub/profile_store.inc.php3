<?php

if ($p_indic == "update")
{
     $l_sql = "UPDATE $table_profile SET name = '$p_name', emailfrom = '$p_emailfrom', emailreply = '$p_emailreply', emailrequest = '$p_emailrequest', signature = '$p_signature' WHERE idprofile = '1'";
}
else
{
     $l_sql = "INSERT INTO $table_profile (name,emailfrom,emailreply,emailrequest,signature) VALUES ('$p_name','$p_emailfrom','$p_emailreply','$p_emailrequest','$p_signature')";
}
$c_db->query($l_sql);

show_response("modification éffectuée.");

include("sub/profile_view.inc.php3");

?>
