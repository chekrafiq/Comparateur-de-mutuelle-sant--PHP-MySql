<?php

if (in_array('ecommerce',$p_tables))
{
  $l_sql = "DELETE FROM client";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM command";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM numsession";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM session";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM showcase";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM showcaseproduct";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM supplier WHERE idsupplier >= 3";
  $c_db->query($l_sql);
  $l_sql = "UPDATE supplier set date = '$l_date'";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM affiliate WHERE idaffiliate > 1";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM company";
  $c_db->query($l_sql);
  $l_sql = "INSERT INTO company (companyname) VALUES ('NONE')";
  $c_db->query($l_sql);
  $l_sql = "UPDATE adm_shop set sellers='aucun'";
  $c_db->query($l_sql);
  $l_sql = "OPTIMIZE TABLE affiliate, supplier";
  $c_db->query($l_sql);
}

if (in_array('modules',$p_tables))
{
  $l_sql = "DELETE FROM board WHERE idboard > 1";
  $c_db->query($l_sql);
  $l_sql = "UPDATE board set title = 'TEST', description = 'module de test', idegroup=1, nbtopic=0, nbpost=0, interactiveflag=0, backendflag=0, moderatoremail='contact@kernix.com', lastpostdate='', date = '$l_date'";
  $c_db->query($l_sql);

  $l_sql = "DELETE FROM pub WHERE idpub > 3";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM poll WHERE idpoll > 1";
  $c_db->query($l_sql);
  $l_sql = "UPDATE poll set nbclick=0, date = '$l_date', nbclick1=0, nbclick2=0, nbclick3=0, nbclick4=0, nbclick5=0, nbclick6=0, nbclick7=0, nbclick8=0, nbclick9=0, nbclick10=0";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM egroup WHERE idegroup > 4";
  $c_db->query($l_sql);
  $l_sql = "UPDATE egroup set nbmailing=0, lastmsgdate = '', lastregisterdate='', date = '$l_date'";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM theme WHERE idtheme > 3";
  $c_db->query($l_sql);
  $l_sql = "UPDATE theme set type='NEWS', date = '$l_date'";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM addressbook";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM boardpost";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM alert";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM email";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM form";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM formpost";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM gbpost";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM keywords";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM mailing";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM pollpost";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM pub";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM publog";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM ratingresult";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM redirect";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM owner";
  $c_db->query($l_sql);
  $l_sql = "OPTIMIZE TABLE board, egroup, poll, pub, theme";
  $c_db->query($l_sql);
}

if (in_array('searchenginedb',$p_tables))
{
  system("kexec rm $g_absolutepath/_kernix_/opt/htdig/db/*");
}

if (in_array('site',$p_tables))
{
  $l_sql = "DELETE FROM property WHERE idproperty > 3";
  $c_db->query($l_sql);
  $l_sql = "UPDATE property set date='$l_date'";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM ref WHERE idref > 2";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM product";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM hash";
  $c_db->query($l_sql);
  $l_sql = "UPDATE users set creationdate='$l_date', updatedate='', lastsessiondate='', nbconnect=0";
  $c_db->query($l_sql);
  $l_sql = "OPTIMIZE TABLE property, ref";
  $c_db->query($l_sql);
}

if (in_array('traffic',$p_tables))
{
  $l_sql = "DELETE FROM log";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM logaltern";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM logcron";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM logerror";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM lognocookie";
  $c_db->query($l_sql);
  $l_sql = "DELETE FROM visitor";
  $c_db->query($l_sql);
}

if (in_array('upload',$p_tables))
{
  system("kexec rm $g_absolutepath/upload/files/*");
  system("kexec rm $g_absolutepath/upload/pictures/*");
}

if (in_array('cache',$p_tables))
{
  system("kexec rm $g_absolutepath/cache/*");
}

include("sub/home.inc.php3");

?>
