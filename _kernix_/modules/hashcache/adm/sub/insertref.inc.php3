<?php

$table_hash = "hash";

if (!isset($p_idref))
{
  show_response("aucune ref n'a été précisée.");
  return 0;
}

$c_db2 = new Db;
$c_db2->open($g_db);

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db2->query($l_sql);
$obj = $c_db2->object_result();

if ($g_rehashflag != 1)
{
  $l_sql = "DELETE FROM $table_hash WHERE idref = '$obj->idref'";
  $c_db->query($l_sql);
}

$l_tab = get_tabdatas($obj->data);

$i = 0;
while ($l_tab[$i])
{   
  $name = $l_tab[$i][0];
  $value = $l_tab[$i][1];
  $uname = get_text_link(strtoupper($name));
  $uvalue = get_text_link(strtoupper($value));
  $l_sql = "INSERT INTO $table_hash (idref,name,value,uname,uvalue,idproperty,refname,up,nodekey,date) VALUES ('$obj->idref','$name','$value','$uname','$uvalue','$obj->idproperty','$obj->name','$obj->up','$obj->nodekey','$obj->creationdate')";
  $c_db2->query($l_sql);
  $i++;
}

$c_db2->close();

?>
