<Script Language="JavaScript">
<!--

function do_refresh()
{
  document.location = "<?php print($REQUEST_URI); ?>";
}

setTimeout('do_refresh()',<?php print($adm->refreshrate * 60 * 1000); ?>);
//-->
</Script>
