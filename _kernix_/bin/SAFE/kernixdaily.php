<?php

// v1.0 (09/01/02) : version intiale

$version   = '1.0';
$server    = 's1';

$now       = time();
$warning   = 0;
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));

$year  = date("Y",$yesterday);
$month = date("m",$yesterday);
$day   = date("d",$yesterday);

$wday = date("w") + 0;
$mday = date("j") + 0;
$yday = date("z") + 0;

$freq = 'day';

if ($wday == 0) $freq .= 'week';
if ($mday == 1) $freq .= 'month';
if ($yday == 1) $freq .= 'year';

$dir = opendir('/var/web');
while ($account = readdir($dir)) 
{
  if (($account[0] != '.') && (file_exists("/var/web/$account/kernix.conf")))
  {
    $tab_accounts[] = $account;
    $tab_datas[$account] = parse_ini_file("/var/web/$account/kernix.conf");
    if ($tab_datas[$account]['KWO'] == 1)
      $tab_kwo[] = $account;
  }
}
closedir ($dir); 

//print_r($tab_datas);
//exit;

ob_start();

echo "&#187; <b>MISC</b><br>\n";

$df = disk_free_space("/backup") / 1073741824 ; 
$df = number_format($df,1);
if ($df <= 0.5)
{
  $df = "<font class=warning>$df</font>";
  $warning++;
}

echo "- free space on [ /backup ] : $df G<br>\n";


$df = disk_free_space("/nfs") / 1073741824; 
$df = number_format($df,1);
if ($df <= 1.5)
{
  $df = "<font class=warning>$df</font>";
  $warning++;
}

echo "- free space on [ /nfs ] : $df G<br>\n";

echo "- sync hd<br>\n";
`sync`;

echo "- restart httpd<br>\n";
`service httpd restart`;
sleep(1);

echo "- refresh db<br>\n";
`mysqladmin refresh flush-tables`;

if ($mday == 1) 
{
  echo "- delete backup [ month ]<br>\n";
  system('rm /backup/accounts/month/*');
}

if ($wday == 0) 
{
  echo "- sync time<br>\n";
  `rdate -s ntp-p1.obspm.fr; hwclock --systohc`;
  
  echo "- move backup [ week ]<br>\n";
  system('mv /backup/accounts/week/* /backup/accounts/month');

  echo "- backup etc<br>\n";
  $cmd = "tar -zcvf /nfs/week/etc$server-$day-$month-$year.tgz /etc";
  system($cmd);
}



echo "<hr>\n\n";

foreach ($tab_accounts as $account)
{
  $wwwdir = "/var/web/$account/www";
  $homedir = "/var/web/$account";
  chdir($homedir);
  echo "&#187; <b>ACCOUNT</b> : $account<br>\n";
  if ($tab_datas[$account]['DATECREATION'])
  {
    list ($d,$m,$y) = explode('/',$tab_datas[$account]['DATECREATION']);
    $timexp = mktime(0,0,0,$m,$d,$y);
    if ((($timexp - $now) < 2592000))
    {
      echo '- <font class=warning>DNS WARNING</font> : domain ' . $tab_datas[$account]['DATECREATION'] . ' will soon expire < ' . $tab_datas[$account]['DNSEXPIRATION'] . ' > ' . $tab_datas[$account]['DNSREGISTRAR'] . "<br>\n";
      $warning++;
    }
  }
  if ($tab_datas[$account]['BACKUPFREQUENCY'] && eregi($freq,$tab_datas[$account]['BACKUPFREQUENCY']))
  {
    echo "- backup local<br>\n";
    $cmd = "tar -zcvf /backup/accounts/day/$account-$day-$month-$year.tgz www *.conf " . $tab_datas[$account]['BACKUPEXCEPTION'];
//    system($cmd);
    if (($tab_datas[$account]['BACKUPLOCATION'] == "remote") && file_exists('/nfs/day'))
    {
      echo "- backup remote<br>\n";
      copy("/backup/accounts/day/$account-$day-$month-$year.tgz",'/nfs/day');
    }
  }
  if (eregi($freq,$tab_datas[$account]['HTDIGFREQUENCY']) && file_exists("$homedir/htdig"))
  {
    echo "- htdig<br>\n";
    system("$homedir/dig");
  }
  if (eregi($freq,$tab_datas[$account]['STATFREQUENCY']) && file_exists("www/private/report")) 
  {
    if ($mday == 1)
    {
      echo "- archive stats<br>\n";
      system("tar -zcvf www/private/stats_$year-$month.tgz www/private/report");
    }
    echo "- webstat<br>\n";
    chdir("$wwwdir/private/report");
//    `/usr/local/bin/webstats.pl -f'hvut"r"sb"R""A"' -l../../../logs/access_log -l../../../logs/error_log >& /dev/null`;
    chdir($homedir);
  }
  if ($mday == 1)
  {
    echo "- suppress log<br>\n";
    unlink('logs/error_log');
    if (file_exists('logs/access_log')) unlink('logs/access_log');
  }
  echo "<hr>\n\n";
}

echo "&#187; <b>KWO CRON</b><br>\n";
foreach ($tab_kwo as $account)
{
  $wwwdir = "/var/web/$account/www";
  if (file_exists("$wwwdir/_kernix_/bin/CRON/cron.php"))
  {
    chdir("$wwwdir/_kernix_/bin/CRON");
    echo "- $account<br>\n";
    system("php -c /etc/kernix -q cron.php &");
  }
}

echo "<hr><br>\n\n";

$report = ob_get_contents();
ob_end_clean();


$header  = "From: $server <admin@kernix.com>\n";
if ($warning > 0) $header .= "X-Priority: 1\n";
$header .= "Cc: fabrice@kernix.com\n";
$header .= "MIME-Version: 1.0\n";
$header .= "Content-Type: multipart/alternative; boundary=B97C1230\n";

$body  = "\nThis is a multi-part message in MIME format.";
$body .= "\n--B97C1230\nContent-Type: text/html; charset=\"iso-8859-1\"\n\n";
$body .= "<html>
<head>
<style type=\"text/css\" media=\"screen\">
<!--
body      { background: white; color: black; font-family: verdana; font-size: 10px; }
.warning  { background: white; color: red; font-family: verdana; font-size: 10px; }
-->
</style>
</head>
<body>";
$body .= $report;
$body .= "</body></html>";
$body .= "\n--B97C1230--\n end of the multi-part";

$elapsetime = (time() - $now) / 60;
$elapsetime = number_format($elapsetime,2);

mail ("admin@kernix.com", "$server : kernix cron [v$version] report [ $elapsetime mn ]", $body, $header, "-fadmin@kernix.com");

?>
