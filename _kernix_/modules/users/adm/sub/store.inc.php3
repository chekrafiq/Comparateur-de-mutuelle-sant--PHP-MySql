<?php

if ($p_idusers == 1)
{
  show_response("compte protégé.");
  include("sub/list.inc.php3");
  return 0;
}

if (empty($p_login) || (empty($p_password)))
{
  show_response("un champs obligatoire est manquant");
  show_back();
  return 0;
}

if ($p_usersflag == "create")
{
  $l_sql = "SELECT * FROM $table_users WHERE login = '$p_login' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_login > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_users (creationdate) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idusers = $c_db->get_id();
}
elseif ($p_login != $p_login_old)
{
  $l_sql = "SELECT * FROM $table_users WHERE login = '$p_login' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("le login < $p_login > déjà présent.");
    show_back();
    return 0;
  }
}

$l_sql = "UPDATE $table_users set lastname = '$p_nom', firstname = '$p_prenom', login = '$p_login', password = '$p_password', email = '$p_email', updatedate = '$l_date', power = '$p_power', backofficeflag = '$p_backofficeflag' WHERE idusers = '$p_idusers'";
$c_db->query($l_sql);

show_response("modification effectuée.");

include("sub/view.inc.php3");

?>
