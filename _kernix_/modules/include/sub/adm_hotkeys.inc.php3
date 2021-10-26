<SCRIPT LANGUAGE="JavaScript">

var key = new Array();  


key['H'] = "/<?php print($g_modulespath); ?>/homesite/adm";
key['S'] = "/<?php print($g_modulespath); ?>/site/adm";
key['T'] = "#Top";
key['X'] = "toto.zip";


function getKey(keyStroke) 
{
 isNetscape=(document.layers);
 eventChooser = (isNetscape) ? keyStroke.which : event.keyCode;
 which = String.fromCharCode(eventChooser);
 for (var i in key) 
  if (which == i) 
   window.location = key[i];
}

document.onkeypress = getKey;

</script>
