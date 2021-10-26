<?php
function get_tabref($idref)
{
  global $c_db, $table_ref, $g_urldyn;
  
  $l_sql = "SELECT idref, name, description, icon, picture, link, nbsubref, visibilityflag, title FROM $table_ref WHERE idref = $idref";
  $c_db->query($l_sql);
  while ($obj = $c_db->object_result())
  {
    $l_tab["idref"]		= $obj->idref;
    $l_tab["url"]		= get_url($obj->link, $obj->idref);
    $l_tab["name"]		= $obj->name;
    $l_tab["description"]	= bdd2html($obj->description);
    $l_tab["icon"]		= $obj->icon;
    $l_tab["picture"]		= $obj->picture;
    $l_tab["nbsubref"]		= $obj->nbsubref;
    $l_tab["title"]		= $obj->title;
  }
  return $l_tab;
}

function get_tabsubnodekey($nodekey,$order,$select)
{
  global $c_db, $table_ref, $g_urldyn, $g_nodekeylen;

  if(empty($order))
  {
    $order= "nodekey";
  }
  $l_nodekey = substr($nodekey, 0, (2 * $g_nodekeylen));
  $l_sql = "SELECT nodekey, idref, name, description, icon, picture, link, nbsubref, visibilityflag FROM $table_ref WHERE visibilityflag = 1 AND nodekey >= '$l_nodekey' AND nodekey <= '$l_nodekey"."ZZ' $select ORDER BY $order";
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]		= $obj->idref;
    $l_tab[$i]["url"]		= get_url($obj->link, $obj->idref);
    $l_tab[$i]["name"]		= $obj->name;
    $l_tab[$i]["description"]	= bdd2html($obj->description);
    $l_tab[$i]["icon"]		= $obj->icon;
    $l_tab[$i]["picture"]       = $obj->picture;
    $l_tab[$i]["nbsubref"]	= $obj->nbsubref;
    $l_tab[$i]["nodekey"]	= $obj->nodekey;
    $l_tab[$i]["proof"]		= (strlen($obj->nodekey) / $g_nodekeylen) - 1;
    $i++;
  }
  return $l_tab;
}

function get_aref($id)
{
  global $c_db, $table_ref;
  
  $l_sql = "SELECT * FROM $table_ref WHERE idref = $id";
  $c_db->query($l_sql);
  return $c_db->object_result();
}
?>
