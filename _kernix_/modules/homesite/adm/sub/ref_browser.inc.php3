<script language="Javascript">
function browserrefwindow(str)
 {
	w = window.open("","","toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=540,height=500");
	w.location = str;
 }
</script>

<input type="button" value="Ref Browser" class=buttonleft OnClick="browserrefwindow('<?php print("$g_urlroot"); ?>/_kernix_/modules/site/adm/index.php3?p_siteadmaction=ref_browser');" title="Browser de références" alt="Browser de références">

