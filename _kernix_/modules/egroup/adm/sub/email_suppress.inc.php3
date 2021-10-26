<?php

if (isset($p_idemail))
{
  $l_cond = " idemail = '$p_idemail' ";
  $l_sql = "UPDATE $table_email SET status = '2', unsubdate = '$l_date' WHERE $l_cond and status <> 2";
  $c_db->query($l_sql);
  $l_ar = $c_db->affectrows;
  show_response("email supprimé.");
  print("<br>");
  include("sub/email_list.inc.php3");
  return 1;
}

if (empty($p_email)) print("Erreur de saisie, aucun email supprimé.<br>");
else{
  $tab = explode("\n",$p_email);
  foreach ($tab as $e){
    $e = trim($e);
    $l_sql = "UPDATE $table_email SET status = '2', unsubdate = '$l_date' WHERE email = '$e' and status <> 2";
    $c_db->query($l_sql);
    //echo "SQL : ".$l_sql."<br/>";
    $l_ar = $c_db->affectrows;
    $l_sql = "UPDATE $table_client SET optinflag = 2 WHERE email1 = '$e'";
    $c_db->query($l_sql);
    //echo "SQL : ".$l_sql."<br/>";
    $l_ar = $c_db->affectrows;
    if ($l_ar == 0) $l_ar = "<font color=red>$l_ar</font>";
    print("< $e > supprimé dans $l_ar mailing-list<br>");
  }
}
?>

<br>
<center><a href=>retour</a></center>
<br><br>
