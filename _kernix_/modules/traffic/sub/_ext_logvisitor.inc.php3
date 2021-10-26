<?php

//error_log ("indic 1 !", 0);

if (isset($_COOKIE["KERNIX" . $g_version])) return 0;

$table_lognocookie = 'lognocookie';

if (!$_COOKIE['KERNIXSEED'])
{
  $l_sql = "UPDATE $table_lognocookie SET num=num+1";
  $c_db->query($l_sql);
  header("Content-type: image/gif");
  printf("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c",71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);
  return 0;
}

if (!isset($p_lang))
{
  if (eregi("fr",$_SERVER['HTTP_ACCEPT_LANGUAGE'])) $l_lang = '_fr';
  else $l_lang = '_en';
}

$REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);

if (!empty($REMOTE_HOST)) $remote_country = strtolower(end(explode('.',$REMOTE_HOST)));
if (ereg("[[:digit:]]$",$remote_country)) $remote_country = '';

$l_os = 'WIN';
if (eregi("mac|ppc|apple|powerpc",$HTTP_USER_AGENT)) $l_os = 'MAC';
elseif (eregi("x11|unix|linux|sun|hp|bsd|konq",$HTTP_USER_AGENT)) $l_os = 'UNX';

$l_browser = '';
if (eregi("MSIE 6",$HTTP_USER_AGENT)) $l_browser = 'IE60';
elseif (eregi("MSIE 5\.5",$HTTP_USER_AGENT)) $l_browser = 'IE55';
elseif (eregi("MSIE 5",$HTTP_USER_AGENT)) $l_browser = 'IE50';
elseif (eregi("MSIE 4",$HTTP_USER_AGENT)) $l_browser = 'IE40';
elseif (eregi("Gecko",$HTTP_USER_AGENT)) $l_browser = 'NS60';
elseif (eregi("Mozilla/4\.5|Mozilla/4\.7",$HTTP_USER_AGENT)) $l_browser = 'NS4+';
elseif (eregi("Mozilla/4",$HTTP_USER_AGENT)) $l_browser = 'NS40';

$p_refer = trim($p_refer,'/');

if (!($l_refer = $p_refer)) $l_refer = $p_remoteuser;

if (eregi("mail|courrier|message|mbox",$l_refer)) $l_refer = '::MAIL::';

$l_tabtmp = parse_url($p_refer);

$l_sql = "INSERT INTO $table_visitor (nbrvis, lang, remotehost, remoteaddr, remotereferer, browser, os, screen, flash, country, firstvis, lastvis, urlfromfirstvis, urlfromlastvis) VALUES ('1', '$l_lang', '$REMOTE_HOST', '$REMOTE_ADDR', '{$l_tabtmp["host"]}', '$l_browser', '$l_os', '$p_screen', '$p_flash', '$remote_country', '$l_date', '$l_date', '$l_refer', '$l_refer')";
$c_db->query($l_sql);
$g_idvisitor = $c_db->get_id();

$c_cookie = new Cookie('KERNIX' . $g_version, '');
$c_cookie->put('visit',1);
$c_cookie->put('id',$g_idvisitor);
$c_cookie->put('ln',$l_lang);
$c_cookie->put('dlv',time());

if (isset($p_storecookie))
{
  $tab_tmp = explode(',',$p_storecookie);
  $i = 0;
  while($tab_tmp[$i])
  {
    $c_cookie->put($tab_tmp[$i],${'p_'.$tab_tmp[$i]});
    $i++;
  }
}
$c_cookie->send();

if ($p_idmailing > 0)
{
  $l_idbringer = $p_idmailing;
  $l_bringer   = '2';
}

if ($p_idaffiliate > 0)
{
  $l_idbringer = $p_idaffiliate;
  $l_bringer   = '1';
}

if ($p_page == $p_refer) $p_page = '::RELOAD::';

$l_sql = "INSERT INTO $table_log (idsession,idvisitor,idproperty,page,date,numvis,skin,design,bringer,idbringer,newvis,idpub) values ('$g_idvisitor-1','$g_idvisitor','$p_idproperty','$p_page','$l_date','1','$p_skin','$p_design','$l_bringer','$l_idbringer','1','$p_idpub')";
$c_db->query($l_sql);

$c_db->close();

Header("Content-type:  image/gif"); 
//Header("Expires: Wed, 11 Nov 1998 11:11:11 GMT"); 
//Header("Cache-Control: no-cache"); 
//Header("Cache-Control: must-revalidate"); 
printf("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c",71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);

?>
