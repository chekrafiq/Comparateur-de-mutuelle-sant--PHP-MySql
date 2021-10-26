<?php

$validator = new Validator();
$l_login = strtoupper($p_login);

$l_errorflag = 0;

if (!($l_login && $p_password && $p_firstname && $p_lastname && $p_email && $p_address && $p_payableto))
{
  $l_errormsg = "certains main obligatoires n'ont pas été remplis."; $l_errorflag = 1;
}
elseif (($validator->is_allalphanum($l_login) == false) || ($validator->is_allalphanum($p_password) == false))
{
  $l_errormsg = "le login et le password ne doivent contenir que des lettres ou des chiffres.<br>"; $l_errorflag = 1;
}

if ($l_errorflag == 1)
{
  show_ca_response($l_errormsg);
  show_ca_back();
  return 0;
}

if ($p_clientadminflag == "create")
{
  $l_sql = "SELECT * FROM $table_affiliate WHERE name = '$l_login'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_ca_response("< $l_login > déjà présent dans la base des affiliés");
    show_ca_back();
    return 0;
  }
  $l_sql = "INSERT INTO $table_affiliate (idvisitor,date) VALUES ('$g_idvisitor','$l_date')";
  $c_db->query($l_sql);
  $p_idaffiliate = $c_db->get_id();
  if ($g_idvisitor > 0)
  {
    $l_sql = "SELECT idclient FROM $table_visitor WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);
    if (($l_idclient = $c_db->result(0,"idclient")) == 0)
    {
      $l_sql = "INSERT INTO $table_client (date) VALUES ('$l_date')";
      $c_db->query($l_sql);
      $l_idclient = $c_db->get_id();
      $l_sql = "UPDATE $table_visitor SET idclient = '$l_idclient' WHERE idvisitor = '$g_idvisitor'";
      $c_db->query($l_sql);
      $l_sql = "UPDATE $table_client SET firstname = '$p_firstname', lastname = '$p_lastname', email = '$p_email', url = '$p_url', address = '$p_address' WHERE idclient = '$l_idclient'";
      $c_db->query($l_sql);
    }
    else
    {
      $l_sql = "UPDATE $table_client SET email2 = '$p_email' WHERE idclient = '$l_idclient'";
      $c_db->query($l_sql);
    }    
  }
}

$l_sql = "UPDATE $table_affiliate SET login = '$l_login' , password = '$p_password' , firstname = '$p_firstname' , lastname = '$p_lastname' , email = '$p_email' , url = '$p_url' , address = '$p_address', payableto = '$p_payableto' WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);
show_ca_response("l'enregistrement de votre profil s'est bien déroulé<br><br><code> $g_pageroot?p_idaffiliate=$p_idaffiliate </code><br><br>");
include("$g_modulespath/clientadmin/sub/affiliatehome.inc.php3");
?>





