<?php


$tab_email = explode("\n",$p_email);

$l_pb = "";

$i = 0;
$n = 0;

while ($tab_email[$i])
{
  $l_email = trim($tab_email[$i]);
  $i++;
  if (!is_valid_email($l_email))
  {
    if (!empty($l_email)) $l_pb .= "$l_email<br>";
    continue;
  }
  $l_sql = "REPLACE INTO $table_email (idegroup,emailkey,email,date) VALUES ('$p_idegroup','$p_idegroup-$l_email','$l_email','$l_date')";
  $c_db->query($l_sql);
  $n++;
}

$l_response = " $n < email(s) >  enregistré(s) à l'egroup [ $p_idegroup ]";

if ($n != $i) $l_response .= "<span align=left><br><br><u>problèmes avec </u>:<br><font color=red> $l_pb</font></span>";

show_response($l_response);
include("sub/egroup_view.inc.php3");

?>
