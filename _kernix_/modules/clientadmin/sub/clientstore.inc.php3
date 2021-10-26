<?php

$validator = new Validator();
$l_login = strtoupper($p_login);

$l_errorflag = 0;

if (!($l_login && $p_password && $p_firstname && $p_lastname && $p_email1 && $p_phone && $p_address && $p_town  && $p_zipcode  && $p_idportzone))
{
     $l_errormsg = "certains main obligatoires n'ont pas été remplis."; $l_errorflag = 1;
}
elseif (($validator->is_allalphanum($l_login) == false) || ($validator->is_allalphanum($p_password) == false))
{
     $l_errormsg = "le login et le password ne doivent contenir <br> que des lettres ou des chiffres.<br>"; $l_errorflag = 1;
}
elseif ((strlen($p_login) > 10) || (strlen($p_password) > 10))
{
     $l_errormsg = "le login et le password ne doivent comporter <br> que 10 caractères au maximum.<br>"; $l_errorflag = 1;
}

if ($l_errorflag == 1)
{
     show_ca_response($l_errormsg);
     show_ca_back();
     return 0;
}

if ($p_clientadminflag == "create")
{
     $l_sql = "SELECT * FROM $table_client WHERE name = '$l_login'";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
          show_ca_response("< $l_login > déjà présent dans la base");
          show_ca_back();
          return 0;
     }
     $l_sql = "INSERT INTO $table_client (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idclient = $c_db->get_id();
     $l_sql = "UPDATE $table_visitor SET idclient = '$p_idclient' WHERE idvisitor = '$g_idvisitor'";
     $c_db->query($l_sql);     
}

$l_town = strtoupper($p_town);
$l_country = $p_idportzone;
$l_sql = "UPDATE $table_client SET title = '$p_title', login = '$l_login',password = '$p_password',firstname = '$p_firstname',lastname = '$p_lastname',email1 = '$p_email1',email2 = '$p_email2',phone = '$p_phone',workphone = '$p_workphone',cellphone = '$p_cellphone',fax = '$p_fax',address = '$p_address',zipcode = '$p_zipcode',town = '$l_town',idportzone = '$l_country' WHERE idclient = '$p_idclient'";
$c_db->query($l_sql);

show_ca_response("l'enregistrement de votre profil s'est bien déroulé<br> Si vous venez de la boutique,<br> vous pouvez fermer cette fenêtre<br> et continuer vos achats en saisissant<br> votre identifiant et votre mot de passe.<br>");
include("$g_modulespath/clientadmin/sub/clienthome.inc.php3");

?>




