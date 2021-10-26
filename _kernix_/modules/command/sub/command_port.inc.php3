<?php

//----- INPUT
// $g_quantity
// $g_pricettc
// $g_portval
// $g_tabportval
// $g_tabportid

$table_portsupplier = "port_supplier";

foreach ($g_tabportid as $k => $v)
  {
//    print("->$v:".$g_tabportval[$k]."<br>");
    if ($v == 2)
      {
	$g_portval += $g_tabportval[$k];	
      }
    else
    {
      $l_sql = "SELECT S.name FROM $table_port AS P, $table_portsupplier AS S WHERE P.value = S.idport_supplier AND P.idport = $v";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      $l_portsupplier = $c_db->object_result();
      
      $table_portwz = "port_wz_$l_portsupplier->name"; 
      $portzone_field = "zoneid_$l_portsupplier->name";
      
      $l_sql = "SELECT W.price FROM $table_portwz AS W, $table_zone AS Z WHERE Z.id_portzone = $client->idportzone AND Z.$portzone_field = W.zoneid AND W.weight >= ".$g_tabportval[$k]." ORDER BY W.weight LIMIT 0,1";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      $l_portwz = $c_db->object_result();
      $g_portval += $l_portwz->price;
    }
  }

if ($adm->portlimit)
{
  if ($g_portval > $adm->portlimit)
  {
    $g_portval = $adm->portlimit;
  }
}

$g_pricettcport = $g_portval + $g_pricettc;

return $g_pricettcport;

?>
