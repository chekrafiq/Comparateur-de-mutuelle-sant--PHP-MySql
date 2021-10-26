<?php

$l_name = strtoupper($p_name);

if ($p_pubflag == "create")
{
     $l_sql = "SELECT * FROM $table_pub WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
          show_response("< $p_name > déjà présent.");
          include("sub/list.inc.php3");
          return 0;
     }
     $l_sql = "INSERT INTO $table_pub (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idpub = $c_db->get_id();
}

$l_sql = "UPDATE $table_pub SET name = '$l_name', image = '$p_image', url ='$p_url', media ='$p_media', description ='$p_description', type = '$p_type', nbmax = '$p_nbmax', infos = '$p_infos'  WHERE idpub =  '$p_idpub'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>
