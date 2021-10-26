<?php

if (empty($p_deb) || empty($p_end))
{
  show_response("des informations sont manquantes.");
  show_back();
  return 0;
}

$l_deb = date2bdd($p_deb) . " 0:0:0";
$l_end = date2bdd($p_end) . " 23:59:59";

$l_sql = "SELECT * FROM $table_command WHERE date >= '$l_deb' AND date <= '$l_end' AND status = 20";
$c_db->query($l_sql);

$i = 0;
while ($command = $c_db->object_result())
{
  $l_tab[$i] = $command->idcommand;
  $i++;
}

$n = $i;

print("$n factures entre < <i>$p_deb</i> > et < <i>$p_end</i> ><br>"); 
print("( pour imprimer < click-droit imprimer > )<br><br>"); 

show_hr();

print("<br>");

break_page();
$i = 0;
while ($g_idcommand = $l_tab[$i])
{
  include("sub/files_bill_elem.inc.php3");
  break_page();
  $i++;
}

?>

<br>

<?php show_back(); ?>
