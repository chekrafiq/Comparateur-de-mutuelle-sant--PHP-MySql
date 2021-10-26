<?php

include("_kernix_/var.inc.php3");
include("_kernix_/tables.inc.php3");

$l_sql = "SELECT * FROM $table_admsite, $table_admshop, $table_admadm";
$c_db->query($l_sql);
$adm = $c_db->object_result();

if (($p_action != "yes") && ($adm->crondailyflag == 0))
{
  $c_db->close();
  return 0;
}

print("<H1>CRON DAILY :: $g_sitename</H1> <i>$l_date</i><br><hr>");

$l_year  = date("Y");
$l_month = date("m");

if ($p_updatetype == "visibility")
{
  $l_sql = "SELECT R.idref FROM $table_ref AS R, $table_product AS P WHERE R.iproduct = P.idproduct AND ((P.startdate < '$l_date' AND P.startdate != '0000-00-00 00:00:00') OR (P.enddate < '$l_date' AND P.enddate != '0000-00-00 00:00:00'))";
  $c_db->query($l_sql);
  $i = 0;
  $l_text = "";
  if ($c_db->numrows > 0)
  {
    while ($obj = $c_db->object_result())
    {
      $l_text .= $obj->idref . " ";
      $tab_ref[$i] = $obj->idref;
      $i++;
    }
  }
  $i = 0;
  while ($p_idref = $tab_ref[$i])
  {
    $result = include("$g_modulespath/site/adm/sub/ref_changevisibility.inc.php3");
    $i++;
  }
  $l_sql = "UPDATE $table_product SET startdate = '0000-00-00 00:00:00' WHERE startdate < '$l_date' AND caddieflag = 0 AND startdate != '0000-00-00 00:00:00'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_product SET enddate = '0000-00-00 00:00:00' WHERE enddate < '$l_date' AND caddieflag = 1 AND enddate != '0000-00-00 00:00:00'";
  $c_db->query($l_sql);
  if ($i)
  {
    mail($adm->email,"cron daily"," visibility changed on [ $i ] rows \n $l_text","From: site $g_sitename <$adm->email>");
  }
  print("visibility changed on <small>[ $i ]</small> rows<br><br><hr><br>");
}
else
{
  $l_sql = "UPDATE $table_product SET caddieflag = 1, startdate = '0000-00-00 00:00:00' WHERE startdate < '$l_date' AND caddieflag = 0 AND startdate != '0000-00-00 00:00:00'";
  $c_db->query($l_sql);

  print("<br>caddie set on <small>[ $c_db->affectrows ]</small> rows<br>");

  $l_sql = "SELECT R.*, P.* FROM $table_product AS P, $table_ref AS R WHERE P.enddate < '$l_date' AND P.enddate != '0000-00-00 00:00:00' AND R.idproduct = P.idproduct";
  $c_db->query($l_sql);
  if ($c_db->numrows)
  {
    $l_text = "Produits arrivant en fin de vie : \n\n";
    while ($obj = $c_db->object_result())
    {
      $l_text .= "  #$obj->idref [$obj->productcode] $obj->name\n";
    }
  }
  if (!empty($l_text))
  {
    mail($adm->email,"cron daily",$l_text,"From: site $g_sitename <$adm->email>");
  }

  $l_sql = "UPDATE $table_product SET caddieflag = 0, enddate = '0000-00-00 00:00:00' WHERE enddate < '$l_date' AND caddieflag = 1 AND enddate != '0000-00-00 00:00:00'";
  $c_db->query($l_sql);
  print("caddie unset on <small>[ $c_db->affectrows ]</small> rows<br><br><hr><br>");
}



if ($adm->eurodispatchflag == 1)
{
  include("extern/eurodispatch.php3");
}


$c_db->close();

?>

<br>
<hr>

generated by <i><?php print($g_softname); ?></i>
