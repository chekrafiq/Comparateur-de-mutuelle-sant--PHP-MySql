<?php

//--- INIT BENCHMARK
$mtime = microtime();
$mtime = explode( ' ' , $mtime );
$g_start_time = $mtime[ 1 ] + $mtime[ 0 ] ;
//--- END

//--- SITE DEPENDANT VARS
$g_idsite       = '32';
$g_version      = '2';
$g_accountname  = 'degallaix';
$g_sitename     = 'assursante';
$g_domainname   = 'assursante.fr';
$g_domain       = 'www.'.$g_domainname;

$g_db           = $g_accountname;
$g_server       = 'localhost';
$g_login        = $g_accountname;
$g_password     = 'SYPcs1n1';
//--- END


//--- PATH
$g_kworoot         = 'http://www.kernix.com/kwo';
$g_kernixroot      = 'http://www.kernix.com';
$g_kernixemail     = 'fmmon1.knx@kernix.com';

$g_urlfriends      = 'http://www.referencementweb.fr';
$g_urlroot         = 'http://' . $g_domain;
$g_pageroot        = "$g_urlroot/index.php3";
$g_urldyn          = "$g_urlroot/index.dyn.php3";
$g_urladm          = "$g_urlroot/admin";

$g_incpath         = '_kernix_';
$g_cachepath       = 'cache';
$g_designpath      = "$g_incpath/design";
$g_skinpath        = '/skins';
$g_skindir         = 'skins';
$g_displaypath     = "$g_incpath/display";
$g_modulespath     = "$g_incpath/modules";
$g_functionspath   = "$g_modulespath/functions/sub";
$g_classpath       = "$g_modulespath/class/sub";
$g_externpath      = '/extern';
$g_absolutepath    = "/var/web/$g_accountname/www";
$g_searchpath      = "$g_urlroot/extern/";
$g_clientadminpage = "$g_externpath/clientadmin.php3";

$g_picturepath     = "/upload/pictures";
$g_filepath        = "/upload/files";
$g_csspath         = "/upload/css";
$g_jspath          = "/upload/js";
$g_mediapath       = "/upload/media";
$g_modulespicturepath     = "/upload/modules";
//--- END PATH


$g_idusers     = 0;

$g_design      = 'default';
$g_skin        = 'default';
$g_target      = 'target=ext';
$g_kwotarget   = 'target=kwo2';

$g_softname    = 'KerniX Web Office';
$g_softversion = '1.0';
$g_softurl     = 'http://www.kernix.com';
$g_keywords    = ", $g_sitename";
$g_title       = "$g_sitename";
$g_description = "$g_sitename's web site";

$g_categoryvalue = 'category';
$g_refvalue      = 'ref';


//--- FLAGS
$g_benchflag       = 0;
$g_borderflag      = 0;
$g_caddieflag      = 0;
$g_cookieflag      = 1;
$g_cookieviewflag  = 0;
$g_copyrightflag   = 1;
$g_dateviewflag    = 0;
$g_debugflag       = 1;
$g_firstvisflag    = 0;
$g_headerflag      = 0;
$g_logflag         = 1;
$g_pubflag         = 1;
$g_pubmsg          = "\n\n\n[ envoyé via $g_softname, http://www.kernix.com ]";
$g_sendflag        = 1;
//--- END FLAGS

$table_visitor = 'visitor';
$table_log     = 'log';
$table_ref     = 'ref';
$table_product = 'product';
$table_property = 'property';

include("$g_classpath/db.php3");
include("$g_classpath/cookie.php3");

include("$g_functionspath/_site.inc.php3");

$c_db = new Db;
$c_db->open($g_db);

$l_date = date('Y-m-d G:i:s');
$l_month = date('m');
$l_year = date('Y');

$g_nodekeystart = '01';
$g_nodekeylen   = '2';
$g_nodekeystep  = '01';
