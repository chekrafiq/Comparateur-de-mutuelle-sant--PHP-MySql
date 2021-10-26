<?php

$table_users  = "users";
$table_logadm = "logadm";

if (!isset($g_lang)) $g_lang = '';

$ADM = '';

if ($p_newlog == "yes")
{
  $REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);
  $l_sql = "SELECT * FROM $table_users WHERE login = '$p_login'";
  $c_db->query($l_sql);
  $l_lastsession = $c_db->result(0,'lastsessiondate');
  $l_power = $c_db->result(0,'power');
  $l_sql = "UPDATE $table_users SET lastsessiondate = '$l_date', nbconnect = nbconnect+1 WHERE login = '$p_login'";
  //error_log("l_sql = $l_sql",0);
  $c_db->query($l_sql);
  $l_sql = "INSERT INTO $table_logadm (login,remotehost,remoteaddr,date) VALUES ('$p_login','$REMOTE_HOST','$REMOTE_ADDR','$l_date')";
  $c_db->query($l_sql);
  $c_adm = new Cookie('ADM','');
  $c_adm->put("login", urlencode($p_login));
  $c_adm->put("password", urlencode($p_password));
  $c_adm->put("lastsession", urlencode($l_lastsession));
  $c_adm->put("power", $l_power);
  $c_adm->put("time", time());
  $c_adm->setttl(0);
}
elseif (isset($_COOKIE['ADM']))
{
  $c_adm = new Cookie('ADM', $_COOKIE['ADM']);
  if (isset($p_storecookie))
  {
    $tab_tmp = explode(",",$p_storecookie);
    $i = 0;
    while($tab_tmp[$i])
    {
      $c_adm->put($tab_tmp[$i],${"p_".$tab_tmp[$i]});
      $i++;
    }
  }
}


if (isset($c_adm))
{
  $ADM = $c_adm->cookieval;
  $c_adm->send();
}

?>
