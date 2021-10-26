<?php

//--- INIT BENCHMARK
$mtime = microtime();
$mtime = explode( ' ' , $mtime );
$g_start_time = $mtime[ 1 ] + $mtime[ 0 ] ;
//--- END

//--- SITE DEPENDANT VARS
$g_idsite       = "6";
$g_accountname  = "kernix";
$g_sitename     = "$g_accountname";
$g_ip           = "195.219.40.79";
//$g_ip           = "192.168.0.50";
$g_domainname   = $g_accountname . ".com";
//$g_domainname   = $g_accountname . ".inerd";
$g_domain       = "www." . $g_domainname;
//$g_domain       = $g_domainname;

$g_db           = "$g_accountname";
$g_server       = "localhost";
$g_login        = "$g_accountname" ;
$g_password     = "azerty";
//--- END


//--- PATH
$g_kworoot         = "http://www.kernix.com/kwo";
$g_kernixroot      = "http://www.kernix.com";
$g_kernixemail     = "shop@kernix.com";

$g_urlfriends      = "/extern/urlfriends.php3";
$g_urlroot         = "http://".$g_domain;
$g_pageroot        = "$g_urlroot/index.php3";
$g_urldyn          = "$g_urlroot/index.dyn.php3";
$g_urladm          = "$g_urlroot/admin";

$g_incpath         = "_kernix_";
$g_cachepath       = "cache";
$g_designpath      = "$g_incpath/design";
$g_skinpath        = "/skins";
$g_skindir         = "skins";
$g_displaypath     = "$g_incpath/display";
$g_modulespath     = "$g_incpath/modules";
$g_functionspath   = "$g_modulespath/functions/sub";
$g_classpath       = "$g_modulespath/class/sub";
$g_externpath      = "/extern";
$g_absolutepath    = "/home/web/$g_accountname/www";
$g_searchpath      = "$g_urlroot/extern/";
$g_cgipath         = "/cgi-bin";
$g_binpath         = "/home/web/bin";
$g_clientadminpage = "$g_externpath/clientadmin.php3";
//--- END PATH


$g_idusers     = 0;

$g_design      = "default";
$g_skin        = "default";
$g_target      = "target=ext";
$g_kwotarget   = "target=kwo2";

$g_softname    = "KerniX Web Office";
$g_softurl     = "http://www.kernix.com";
$g_keywords    = "$g_sitename,kernix,kwo,$g_softname";
$g_title       = "$g_sitename";
$g_description = "$g_sitename's web site";

$g_categoryvalue = "category";
$g_refvalue      = "ref";


//--- FLAGS
$g_benchflag       = 0;
$g_borderflag      = 0;
$g_caddieflag      = 0;
$g_cookieflag      = 1;
$g_cookieviewflag  = 0;
$g_copyrightflag   = 1;
$g_dateviewflag    = 1;
$g_debugflag       = 1;
$g_firstvisflag    = 0;
$g_headerflag      = 0;
$g_logflag         = 1;
$g_pubflag         = 1;
$g_pubmsg          = "\n\n\n[ sent by $g_softname, kernix.com. ]";
$g_sendflag        = 1;
//--- END FLAGS

$table_visitor = "visitor";
$table_log     = "log";
$table_ref     = "ref";
$table_product = "product";

include("$g_classpath/db.php3");
include("$g_classpath/cookie.php3");

include("$g_functionspath/_site.inc.php3");

$c_db = new Db;
$c_db->open($g_db);

$l_date = date("Y-m-d G:i:s");
$l_year = date("Y");

$g_nodekeystart = "01";
$g_nodekeylen   = "2";
$g_nodekeystep  = "01";

