<?php
function get_url($link, $idref)
{
  global $g_urldyn;
  
  if (!empty($link))
  {
    if (is_numeric($link))
    {
      $l = "$g_urldyn?p_idref=".$link;
    }
    else
    {
      $l = $link;
    }
  }
  else
  {
    $l = "$g_urldyn?p_idref=".$idref;
  }
  return $l;
}

function get_tabpath($key)
{
  global $c_db, $table_ref, $g_urldyn;
  
  $n = strlen($key) / 2;
// pour remonter au top : 0
  $i = 0; 
  while ($i < $n)
  {
    $len = ($i+1) * 2;
    $tab[$i] = "nodekey = '" . substr($key,0,$len)  . "'";
    $i++;
  }
  $l_sql = " " . implode(" OR ",$tab)  . " ";
  $l_sql = "SELECT idref, up, name, description, icon, nbsubref, link FROM $table_ref WHERE " . $l_sql;
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]		= $obj->idref;
    $l_tab[$i]["url"]		= get_url($obj->link, $obj->idref);
    $l_tab[$i]["name"]		= $obj->name;
    $l_tab[$i]["description"]	= bdd2html($obj->description);
    $l_tab[$i]["icon"]		= $obj->icon;
    $l_tab[$i]["nbsubref"]	= $obj->nbsubref;
    $i++;
  }
  return $l_tab;
}

function get_tabsubref($idref,$order,$select)
{
  global $c_db, $table_ref, $g_urldyn;

  if(empty($order))
  {
    $order= "idorder";
  }
  $l_sql = "SELECT accroche, title, idref, name, description, icon, picture, link, nbsubref, visibilityflag, data FROM $table_ref WHERE visibilityflag = 1 AND up = '$idref' $select ORDER BY $order";
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]		= $obj->idref;
    $l_tab[$i]["url"]		= get_url($obj->link, $obj->idref);
    $l_tab[$i]["name"]		= $obj->name;
    $l_tab[$i]["description"]	= bdd2html($obj->description);
    $l_tab[$i]["titre"]		= $obj->title;
    $l_tab[$i]["accroche"]	= bdd2html($obj->accroche);
    $l_tab[$i]["icon"]		= $obj->icon;
    $l_tab[$i]["picture"]       = $obj->picture;
    $l_tab[$i]["nbsubref"]	= $obj->nbsubref;
    $l_tab[$i]["data"]		= $obj->data;
    $i++;
  }
  return $l_tab;
}

function get_tabsubproduct($idref,$order,$select)
{
  global $c_db, $table_ref, $table_product, $g_urldyn;
 
  if(empty($order))
  {
    $order= "idorder";
  }
  $l_sql = "SELECT R.idref, R.name, R.description, R.icon, R.visibilityflag, P.price, P.oldprice FROM $table_ref AS R, $table_product AS P WHERE R.visibilityflag = 1 AND  R.up = $idref AND R.idproduct >= 1 AND R.idproduct = P.idproduct $select ORDER BY R." . $order;  
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]		= $obj->idref;
    $l_tab[$i]["url"]		= get_url($obj->link, $obj->idref);
    $l_tab[$i]["name"]		= $obj->name;
    $l_tab[$i]["description"]	= bdd2html($obj->description);
    $l_tab[$i]["icon"]		= $obj->icon;
    $l_tab[$i]["price"]		= $obj->price;
    $l_tab[$i]["oldprice"]	= $obj->oldprice;
    $i++;
  }
  return $l_tab;
}

function get_tabcrosslinks($pages)
{
  global $c_db, $table_ref, $g_urldyn;

  $l_sql = "SELECT idref, name, icon, link FROM $table_ref WHERE idref IN ($pages)";
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $l_tab[$i]["idref"]	= $obj->idref;
    $l_tab[$i]["url"] 	= get_url($obj->link, $obj->idref);
    $l_tab[$i]["name"]  = $obj->name;
    $l_tab[$i]["icon"]  = $obj->icon;
    $i++;
  }
  return $l_tab;
}

?>
