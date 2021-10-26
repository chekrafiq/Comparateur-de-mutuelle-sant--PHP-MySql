<?php

if ($p_idref <= 2) 
{
  show_response("suppression impossible");
  include("sub/ref_view.inc.php3");
  return 0;
}

$l_sql = "SELECT name, nbsubref, up, next, prev, idref, idproduct, nodekey, visibilityflag FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
if (!$c_db->numrows)
{
  show_response("suppression impossible");
  include("sub/ref_view.inc.php3");
  return 0;
}
$l_refcat = $c_db->object_result();

if ($p_delflag != 1):

?>

<br>
<font color=red>ATTENTION</font> : voulez vous réellement supprimer cette page ?
<br><b>( toute suppression est définitive ! )</b><br><br>

page à supprimer : < <?php print(strtoupper($l_refcat->name)); ?> > 
<?php if ($l_refcat->nbsubref > 0) print(" + les $l_refcat->nbsubref sous-pages"); ?>

<br><br>
<form method="post" action="<?php print($PHP_SELF)?>">
 <input type="hidden" name="p_siteadmaction" value="ref_del">
 <input type="hidden" name="p_delflag" value="1">
 <input type="hidden" name="p_idref" value="<?php print("$p_idref")?>">
 <input type="submit" name="submit" value="-- OUI --" class="button">
</form>

<form method="POST" action="<?php print($PHP_SELF)?>">
 <input type="hidden" name="p_siteadmaction" value="ref_view">
 <input type="hidden" name="p_idref" value="<?php print($p_idref)?>">
 <input type="submit" name="submit" value="-- NON --" class="button">
</form>

<?php

return 1;
endif;

$l_tabref  = array();
$l_tabprod = array();

$l_sql = "SELECT idref, idproduct FROM $table_ref WHERE nodekey >= '$l_refcat->nodekey' AND nodekey <= '".$l_refcat->nodekey."ZZ' ";
//print("->$l_sql<br>");
$c_db->query($l_sql);

while($l_curcat = $c_db->object_result())
{
  array_push($l_tabref, $l_curcat->idref);
  if ($l_curcat->idproduct) { array_push($l_tabprod, $l_curcat->idproduct); }
}

$l_delcat  = implode(",", $l_tabref);
$l_delprod = implode(",", $l_tabprod);

$l_sql = "DELETE FROM $table_ref WHERE idref IN ($l_delcat)";
//print("->$l_sql<br>");
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_gb WHERE idref IN ($l_delcat)";
//print("->$l_sql<br>");
$c_db->query($l_sql);

if (!empty($l_delprod))
{
  $l_sql = "DELETE FROM $table_product WHERE idproduct IN ($l_delprod)";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}

if ($l_refcat->up != 0)
{
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref - $l_refcat->visibilityflag WHERE idref = '$l_refcat->up'";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}

if ($l_refcat->prev != 0)
{
  $l_sql = "UPDATE $table_ref SET next = '$l_refcat->next' WHERE idref = '$l_refcat->prev'";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}

if ($l_refcat->next != 0)
{
  $l_sql = "UPDATE $table_ref SET prev = '$l_refcat->prev' WHERE idref = '$l_refcat->next'";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}

if(!$l_loopcallflag)
{
  $p_idref = $l_refcat->up;
  show_response("suppression effectuée");
  include("sub/ref_view.inc.php3");
}
?>
