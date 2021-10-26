<?php

$KERNIX = $_COOKIE["KERNIX" . $g_version];

if ($KERNIX)
{
  $c_cookie = new Cookie("KERNIX" . $g_version, $KERNIX);

  if (!($g_idvisitor = $c_cookie->search("id"))) return 0;

  $g_numvis       = $c_cookie->search("visit");
  $g_firstvisflag = 0;
  $g_logflag      = 1;
  $g_newvis       = 0;

  if ($c_cookie->isExpired($c_cookie->search("dlv")))
  {
    $g_numvis++;
    $c_cookie->put("visit",$g_numvis);
    $c_cookie->put("dlv",time());
    $c_cookie->rm("idaffiliate");
    $l_sql = "UPDATE $table_visitor SET nbrvis = nbrvis+1, prevvis = lastvis, lastvis = '$l_date' WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);    
    if ($adm->caddieflag == 0) $c_cookie->rm("numsession");
    $g_newvis = 1;
    $g_dlv = $l_date;
  }
  else $g_dlv = date("Y-m-d G:i:s",$c_cookie->search("dlv"));

  if (isset($p_caddiecookieaction))
  {
    $g_caddieflag = 0;
    $c_cookie->put("dlv",time());
    $g_caddie_error = include("$g_modulespath/command/sub/cookie.inc.php3");
  }
  elseif (($g_numsession = $c_cookie->search("numsession")) > 0) $g_caddieflag = 1;

  if (isset($p_skin))
  {
    $c_cookie->put("skin",$p_skin);
    $g_skin = $p_skin;
    $l_sql = "UPDATE $table_visitor SET skin = '$g_skin' WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);
  }
  elseif ($l_tmp = $c_cookie->search("skin")) $g_skin = $l_tmp;

  if (isset($p_idaffiliate))
  {
    $c_cookie->put("idaffiliate",$p_idaffiliate);
    $g_idaffiliate = $p_idaffiliate;
    $l_sql = "UPDATE $table_affiliate SET nbvisitor = nbvisitor+1, lastvisitordate = '$l_date' WHERE idaffiliate = '$p_idaffiliate'";
    $c_db->query($l_sql);
  }
  elseif ($l_tmp = $c_cookie->search("idaffiliate")) $g_idaffiliate = $l_tmp;
  
  if (isset($p_idmailing))
  {
    $l_sql = "UPDATE $table_mailing SET nbvisitor = nbvisitor+1 WHERE idmailing = '$p_idmailing'";
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
  elseif ($l_tmp = $c_cookie->search("ln")) $g_lang = $l_tmp;

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

  if ($g_lang == "_fr") $g_lang = "";

}

elseif (!eregi("htdig|sitecheck",$HTTP_USER_AGENT) 
	&& ($g_robotflag = eregi("bot|slurp|crawl|arach|ferret|spid|ant|orm|fetch|jee|indy|track|stealth|s-t-o-n-e|sched|scoot",$HTTP_USER_AGENT)))
{
  if (!isset($p_idref)) $p_idref = 0;
  $l_sql = "INSERT INTO $table_logaltern (idref,remoteaddr,remotehost,remotereferer,system,page,date) VALUES ('$p_idref','$REMOTE_ADDR','$REMOTE_HOST','$HTTP_REFERER','$HTTP_USER_AGENT','$REQUEST_URI','$l_date')";
  $c_db->query($l_sql);
  $g_firstvisflag = 0;
  $g_logflag = 0;
}

else 
{
  setcookie('KERNIXSEED','1');
  $g_firstvisflag = 1;
}

?>
