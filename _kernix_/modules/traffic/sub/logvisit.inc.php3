<?php

$l_urllogger = "$g_urlroot/extern/logvisit.php3";

?>

<SCRIPT language="Javascript">

var_refer          = "::NULL::"; 

if (document.referrer) {
  var_refer=escape(document.referrer); 
}

p_idvisitor    = "p_idvisitor=<?=$g_idvisitor?>";
p_newvis       = "p_newvis=<?=$g_newvis?>";
p_page         = "p_page=<?php print(urlencode($ref->name . $g_zaname)); ?>";
p_idproperty   = "p_idproperty=<?="$ref->idproperty"?>";
p_remoteuser   = "p_remoteuser=<?=$REMOTE_USER?>";
p_refer        = "p_refer=" + var_refer;
p_numvis       = "p_numvis=<?=$g_numvis?>";
p_skin         = "p_skin=<?=$g_skin?>";
p_design       = "p_design=<?=$g_design?>";
p_idmailing    = "p_idmailing=<?=$g_idmailing?>";
p_idaffiliate  = "p_idaffiliate=<?=$g_idaffiliate?>";
p_idpub	       = "p_idpub=<?=$g_idpub?>";

url = "<?="$l_urllogger?"?>"; 

if (document.cookie)
{
  document.write("<img src=" + url + p_idvisitor + "&" + p_remoteuser  + "&" + p_refer + "&" + p_idproperty + "&" + p_page + "&" + p_numvis + "&" + p_skin + "&" + p_design + "&" + p_idmailing + "&" + p_idaffiliate + "&" + p_idpub + "&" + p_newvis + " border=<?=$g_borderflag?> >");
}
else
{
  document.write("+");
}

</SCRIPT>
