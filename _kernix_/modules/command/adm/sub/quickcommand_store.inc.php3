<?php

if ($p_idclient == 0)
{
  include("$g_classpath/validator.php3");
  $validator = new Validator();
  
  $l_login = strtoupper($p_login);
  
  $l_errorflag = 0;
  
  if (!($l_login && $p_password && $p_firstname && $p_lastname && $p_address && $p_town  && $p_zipcode && $p_idportzone))
  {
    show_response("infos manquantes");
    show_back();
    return 0;
  }
  elseif (($validator->is_allalphanum($l_login) == false) || ($validator->is_allalphanum($p_password) == false))
    {
      show_response("login/pass invalides");
      show_back();
      return 0;
    }
  elseif ((strlen($p_login) > 10) || (strlen($p_password) > 10))
    {
      show_response("pass trop long");
      show_back();
      return 0;
    }
  
  $l_sql = "SELECT * FROM $table_client WHERE login = '$l_login'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("le client existe déjà");
    show_back();
    return 0;
  }

  $l_sql = "INSERT INTO $table_client (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idclient = $c_db->get_id();
  
  $p_address = trim(ereg_replace("\r?\n"," ",$p_address));
  $p_town    = trim(strtoupper($p_town));
  $p_zipcode = trim($p_zipcode);
  
  $l_country = $p_idportzone;
  
  $l_sql = "UPDATE $table_client SET login = '$l_login', password = '$p_password', title = '$p_title', firstname = '$p_firstname', lastname = '$p_lastname', email1 = '$p_email1', company = '$p_company', phone = '$p_phone', address = '$p_address', zipcode = '$p_zipcode', town = '$p_town', idportzone = '$l_country' WHERE idclient = '$p_idclient'";
  $c_db->query($l_sql);
}
else
{
  $l_sql = "SELECT login, password FROM $table_client WHERE idclient = '$p_idclient'";
  $c_db->query($l_sql);
  $p_login    = $c_db->result(0,"login");
  $p_password = $c_db->result(0,"password");
}

$l_sql = "INSERT INTO $table_numsession (date) VALUES ('$l_date')";
$c_db->query($l_sql);
$l_numsession = $c_db->get_id();

$l_options     = "description=" . $p_description;
$l_description = $p_command;

$l_sql = "SELECT isocode FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
$c_db->query($l_sql);
$l_currency = $c_db->result(0,"isocode");

$l_sql = "INSERT INTO $table_session (numsession,status,quantity,options,description,priceht,pricettc,currency,idport,portvalue,date) VALUES ('$l_numsession','2','1','$l_options','$l_description','$p_priceht','$p_pricettc','$l_currency','3','$p_port','$l_date')";

$c_db->query($l_sql);

?>


<br><br><br>

<form action="<?=$g_urldyn?>" method="POST" target="_blank">
 <input type="hidden" name="p_za"                 value="command">
 <input type="hidden" name="p_commandaction"      value="command_view">
 <input type="hidden" name="p_caddiecookieaction" value="storenumsession">
 <input type="hidden" name="p_numsession"         value="<?=$l_numsession?>">
 <input type="hidden" name="p_fromref"            value="<?=$adm->idshop?>">
 <input type="hidden" name="p_login"              value="<?=$p_login?>">
 <input type="hidden" name="p_password"           value="<?=$p_password?>">
 <input type=submit value="&#171; valider la commande &#187;" class=button>
</form>

