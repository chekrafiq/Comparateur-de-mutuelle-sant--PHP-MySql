<?php

include("$g_modulespath/command/sub/caddie_cookie.inc.php3");

if (!isset($g_lang))
{
  $g_lang = "_fr";
}

$g_newvis = 0;

if (!$KERNIX)
{
  if (ereg("^Mozilla",$HTTP_USER_AGENT))
  {
    $l_sql = "INSERT INTO $table_visitor (nbrvis) values (0)";
    $c_db->query($l_sql);
    $g_idvisitor = $c_db->get_id();

    $c_cookie = new Cookie("KERNIX", "");
    $c_cookie->put("visit",1);
    $c_cookie->put("id",$g_idvisitor);
    $c_cookie->put("ln",$g_lang);
    $c_cookie->put("dlv",time());

    $remote_host = $REMOTE_HOST;
    $remote_addr = $REMOTE_ADDR;
    $remote_user = $REMOTE_USER;
    $http_user_agent = $HTTP_USER_AGENT;

    $l_sql = "UPDATE $table_visitor SET nbrvis='1', lang='$g_lang', remotehost='$remote_host', remoteaddr='$remote_addr', remoteuser='$remote_user', system='$http_user_agent', firstvis='$l_date', lastvis='$l_date' WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);

    $g_numvis = 1;
    $g_newvis = 1;
    $g_firstvisflag = 1;
    $g_dlv = $l_date;
  }
  else
  {
    $g_logflag = 0;
  }
}
else 
{
  $c_cookie = new Cookie("KERNIX", $KERNIX);
  if ($g_idvisitor = $c_cookie->search("id"))
  {
    $g_numvis = $c_cookie->search("visit");
    if ($c_cookie->isExpired($c_cookie->search("dlv")))
    {
      $g_numvis++;
      $c_cookie->put("visit",$g_numvis);
      $c_cookie->put("dlv",time());
      $c_cookie->rm("idaffiliate");
      $l_sql = "UPDATE $table_visitor SET nbrvis = nbrvis + 1, lastvis = '$l_date' WHERE idvisitor = '$g_idvisitor'";
      $c_db->query($l_sql);    
      if ($adm_datas->caddieflag == 0)
      {
	$c_cookie->rm("numsession");
      }
      $g_newvis = 1;
      $g_dlv = $l_date;
    }
    else
    {
      $g_dlv = date("Y-m-d G:i:s",$c_cookie->search("dlv"));
    }
    if (isset($p_caddiecookieaction))
    {
      $g_caddieflag = 0;
      $c_cookie->put("dlv",time());
      $l_caddie_error = caddie_action();
    }
    else
    {
      if (($g_numsession = $c_cookie->search("numsession")) > 0)
      { 
	$g_caddieflag = 1;
	$g_numsession = $c_cookie->search("numsession");
      }
    }
    if (isset($p_skin))
    {
      $c_cookie->put("skin",$p_newskin);
      $g_skin = $p_skin;
      $l_sql = "UPDATE $table_visitor SET skin = '$g_skin' WHERE idvisitor = '$g_idvisitor'";
      $c_db->query($l_sql);
    }
    else
    {
      if ($l_tmp = $c_cookie->search("skin"))
      {
	$g_skin = $l_tmp;
      }
    }
    if (isset($p_idaffiliate))
    {
      $c_cookie->put("idaffiliate",$p_idaffiliate);
      $g_idaffiliate = $p_idaffiliate;
      $l_sql = "UPDATE $table_affiliate SET nbvisitor = nbvisitor + 1, lastvisitordate = '$l_date' WHERE idaffiliate = '$p_idaffiliate'";
      $c_db->query($l_sql);
    }
    else
    {
      if ($l_tmp = $c_cookie->search("idaffiliate"))
      {
	$g_idaffiliate = $l_tmp;
      }
    }
    if (isset($p_idmailing))
    {
      $l_sql = "UPDATE $table_mailingarchive SET nbvisitor = nbvisitor + 1 WHERE idmailingarchive = '$p_idmailing'";
      $c_db->query($l_sql);
      $g_idmailing = $p_idmailing;
    }
    if (isset($p_lang))
    {
      $c_cookie->put("ln",$p_lang);
      $g_lang = $p_lang;
      $l_sql = "UPDATE $table_visitor SET lang = '$g_lang' WHERE idvisitor = '$g_idvisitor'";
      $c_db->query($l_sql);
    }
    else
    {
      if ($l_tmp = $c_cookie->search("ln"))
      {
	$g_lang = $l_tmp;
      }
    }
  }
}

if (isset($c_cookie))
{
  if (isset($p_storecookie))
  {
    $tab_tmp = explode(",",$p_storecookie);
    $i = 0;
    while($tab_tmp[$i])
    {
      $c_cookie->put($tab_tmp[$i],${"p_".$tab_tmp[$i]});
      $i++;
    }
  }
  $c_cookie->send();
}

if ($g_lang == "_fr")
{
  $g_lang = "";
}

?>
