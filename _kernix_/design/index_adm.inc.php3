<?php

include("$g_functionspath/_adm.inc.php3");
include("_kernix_/tables.inc.php3");

// -- ADM VARS
$g_hashflag  = 1;
$g_design    = "adm";
$g_skin      = "adm";

$g_cookieflag = 0;

$l_day   = date("d");
$l_month = date("m");
$l_year  = date("Y");
// -- END

$l_sql = "SELECT * FROM $table_admshop, $table_admsite, $table_admadm";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$g_kwotarget = '';
if ($adm->doubleframeflag == 1) $g_kwotarget   = 'target=kwo2';

$l_sql = "SELECT * FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
$c_db->query($l_sql);
$g_currencyname    = $c_db->result(0,"acronymtxt");
$g_currencyhtml    = $c_db->result(0,"acronymhtml");
$g_currencytxt     = $c_db->result(0,"acronymtxt");
$g_currencyisocode = $c_db->result(0,"isocode");

//header("Expires: " . date("r", time()+3600)); 
//header("Cache-Control: max-age=3600, must-revalidate");

//header("Pragma: no-cache");
//header("Cache-Control: no-cache, must-revalidate");
header("Expires: " . gmdate("D, d M Y H:i:s", time() - 2) . " GMT");
//header("Expires: " . gmdate("D, d M Y H:i:s", time() + 300) . " GMT");

include("$g_modulespath/cookie/sub/adm.inc.php3");

//error_log("l_lastsession = $l_lastsession",0);

include("$g_modulespath/header/sub/index.inc.php3");

include("$g_incpath/lang/admin/global_" . $adm->ln . ".inc.php3");

if (file_exists("../lang/local_" . $adm->ln . ".inc.php3"))
include("../lang/local_" . $adm->ln . ".inc.php3");
elseif (file_exists("../lang/local_fr.inc.php3"))
include("../lang/local_" . $adm->ln . ".inc.php3");

include("$g_designpath/$g_design/index.inc.php3");

?>
