<?php

$l_urllogger = "$g_urlroot/extern/logvisitor.php3";

?>

<SCRIPT language="Javascript"  src="/extern/detectflash.js"></SCRIPT>

<SCRIPT language="Javascript">

var_idvisitor = "<?=$g_idvisitor?>";
var_refer     = "::NULL::"; 
var_screen    = "NULL";
var_cookie    = "0";
var_flash     = "0";

if (top.screen) {
  if (screen.width && screen.height) { 
    var_screen = screen.width+"x"+screen.height;
  } 
}

if (document.referrer) {
  var_refer = escape(document.referrer); 
}

if (document.cookie)
{
  var_cookie = "1";
}

if (WM_easyDetect('flash'))
{
  var_flash = "1";
}

p_remoteuser   = "p_remoteuser=<?=$REMOTE_USER?>";
p_refer        = "p_refer=" + var_refer;
p_screen       = "p_screen=" + var_screen;
p_cookie       = "p_cookie=" + var_cookie;
p_flash        = "p_flash=" + var_flash;

p_page         = "p_page=<?php print(urlencode($ref->name . $g_zaname)); ?>";
p_idproperty   = "p_idproperty=<?="$ref->idproperty"?>";
p_skin         = "p_skin=<?=$g_skin?>";
p_design       = "p_design=<?=$g_design?>";
p_idmailing    = "p_idmailing=<?=$g_idmailing?>";
p_idaffiliate  = "p_idaffiliate=<?=$g_idaffiliate?>";
p_idpub	       = "p_idpub=<?=$g_idpub?>";

url = "<?="$l_urllogger?"?>";

document.write("<img src=" + url + p_screen + "&" + p_remoteuser + "&" + p_refer + "&" + p_cookie + "&" + p_flash + "&" + p_page + "&" + p_idproperty + "&" + p_skin + "&" + p_design + "&" + p_idmailing + "&" + p_idaffiliate + "&" + p_idpub + "   border=<?=$g_borderflag?> >");

</SCRIPT>

