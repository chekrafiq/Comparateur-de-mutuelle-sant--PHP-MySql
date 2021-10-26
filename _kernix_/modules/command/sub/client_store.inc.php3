<?php

function genpass($n=8)
{
  $out = '';
  for ($i=1;$i<=$n;$i++)
    $out .= seedchar();
  return $out;
}

function seedchar()
{
  $str  = 'abcdefghijkmnpqrstuvwxyz';
  $str .= '123456789';
  $n = strlen($str) - 1;
  return $str[mt_rand(0,$n)];
}

function sp_genpass($f,$l)
{
  $out = strtoupper(veaccents(substr($f,0,2)));
  $out .= sp_seedchar();
  $out .= strtoupper(veaccents(substr($l,0,2)));
  return $out;
}

function sp_seedchar()
{
  $str = '123456789';
  $n = strlen($str) - 1;
  return $str[mt_rand(0,$n)];
}

$table_email = "email";

include("$g_classpath/validator.php3");
$validator = new Validator();

$l_errorflag = 0;

if (!($_POST['p_lastname'] && $p_firstname && $p_email1 && $p_phone && $p_address && $p_town && $p_zipcode && $p_idportzone))
{
  $l_caddie_error_msg = $gl_error_lackcells; 
  $l_errorflag = 1;
}

/*elseif (($validator->is_allalphanum($l_login) == false) || ($validator->is_allalphanum($p_password) == false))
{
  $l_caddie_error_msg = $gl_error_logincar; $l_errorflag = 1;
}*/

if ($l_errorflag == 1)
{
  $l_back = "history";
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

if ($p_clientflag == "create")
{
  $l_sql = "SELECT * FROM $table_client WHERE email1 = '$p_email1'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    $l_back = "history";
    $l_caddie_error_msg = $gl_error_loginexists;
    include("$g_modulespath/command/sub/_error.inc.php3");
    return 0;
  }

  mt_srand((double)microtime()*1000000);
  $p_password = sp_genpass($p_firstname,$_POST['p_lastname']);

  $l_sql = "INSERT INTO $table_client (password, date) VALUES ('$p_password', '$l_date')";
  $c_db->query($l_sql);
  $p_idclient = $c_db->get_id();
  $l_sql = "UPDATE $table_visitor SET idclient = '$p_idclient' WHERE idvisitor = '$g_idvisitor'";
  $c_db->query($l_sql);     
}

$l_sql = "SELECT password FROM $table_client WHERE idclient = '$p_idclient'";
$c_db->query($l_sql); 
$p_password = $c_db->result(0,0);

$p_address = trim(ereg_replace("\r?\n"," ",$p_address));
$p_town    = trim(strtoupper($p_town));
$p_zipcode = trim($p_zipcode);

$l_country = $p_idportzone;

$l_sql = "UPDATE $table_client SET title = '$p_title', firstname = '$p_firstname', lastname = '$p_lastname', email1 = '$p_email1', company = '$p_company', phone = '$p_phone', cellphone = '$p_cellphone', address = '$p_address', zipcode = '$p_zipcode', town = '$p_town', idportzone = '$l_country' WHERE idclient = '$p_idclient'";
$c_db->query($l_sql);

$table_msg = "msg";
$l_sql = "SELECT description FROM $table_msg WHERE code = 'MAIL_NEW_CLIENT'";
$c_db->query($l_sql);
$l_msg   = $c_db->result(0,"description");

if (($g_sendflag == 1) && is_valid_email($p_email1))
{
  $l_body  =  ($p_title == "Mr") ? "Cher" : "Chère";
  $l_body .= " $p_title $p_lastname,\n\n";
  $l_body .= "Votre inscription sur resaplace.com a bien été enregistrée!\n\n";
  $l_body  .= "Votre identifiant et votre mot de passe sont :\n\n";
  $l_body .= "  - E-mail     : $p_email1\n";
  $l_body .= "  - Mot de passe : $p_password\n\n";
  $l_body .= $l_msg;

  if ($g_pubflag == 1) $l_body .= $g_pubmsg;
  mail($p_email1, "Mail d'inscription sur resaplace.com", $l_body, "From: resaplace.com <$adm->email>\nErrors-to: $adm->email\n");
}

if (is_valid_email($p_email1))
{
  $l_sql = "REPLACE INTO $table_email (idegroup,idvisitor,emailkey,email,opt,source,date) VALUES ('3','$g_idvisitor','3-$p_email1','$p_email1','IN','CLIENT','$l_date')";
  $c_db->query($l_sql);
}

include("$g_modulespath/command/sub/command_view.inc.php3");

?>
