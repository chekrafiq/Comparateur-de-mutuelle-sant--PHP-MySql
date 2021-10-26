<?php

$table_pub = "pub";

if ($g_idpub == 0)
{
  $l_sql = "SELECT * FROM $table_pub order by RAND() LIMIT 0,1";
}
else
{
  $l_sql = "SELECT * FROM $table_pub WHERE idpub = '$g_idpub'";
}
$c_db->query($l_sql); 
$obj = $c_db->object_result();

$g_idpub = $obj->idpub;

$l_sql = "UPDATE $table_pub SET nbview = nbview + 1 WHERE idpub = '$g_idpub'";
$c_db->query($l_sql);


$l_graph = $obj->image;

if ($obj->media == "PICT"):
$l_tmp1 = strtoupper(substr($l_graph,0,5));
$l_tmp2 = strtoupper(substr($l_graph,0,1));
if (($l_tmp1 == "HTTP:") || ($l_tmp2 == "/"))
{
  $l_graphpath = $obj->image;
}
else
{
   $l_graphpath = "/upload/pictures/$obj->image";
}

?>

<div align='center'><br>
<a href="<?php print("$g_externpath/pubredirector.php3?p_url=$obj->url&p_idpub=$g_idpub&p_id=$g_idvisitor"); ?>" title=" [pubredirector by KERNIX] <?php print("$obj->description"); ?>">
<img src="<?php print($l_graphpath); ?>" border="0">
</a>
</div>
<?php

elseif ($obj->media == "FLASH"):

?>

<form action="<?php print("$g_externpath/pubredirector.php3?p_url=$obj->url&p_idpub=$g_idpub&p_id=$g_idvisitor"); ?>" method="get" name="pubredictor"></form>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0" width="468" height="60">
    <param name=movie value="<?php print($l_graph); ?>">
    <param name=quality value=high>
    <embed src="<?php print($l_graph); ?>" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="468" height="60">
    </embed> 
</object>

<?php

else:

?>

<iframe src="<?php print($l_graph); ?>" title="<?php print("$obj->name - kernix -"); ?>" width=480 height=60 marginwidth=0 marginheight=0 align=center>
<a href="<?php print("$g_externpath/pubredirector.php3?p_url=$obj->url&p_idpub=$g_idpub&p_id=$g_idvisitor"); ?>"> <?php print($obj->name); ?> </a>
</iframe>

<?php

endif;

?>
