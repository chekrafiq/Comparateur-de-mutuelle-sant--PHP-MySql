<?php

include('_kernix_/var.inc.php3');

$table_boardpost = 'boardpost';
$table_logaltern = 'logaltern';

$REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);
$l_sql = "INSERT INTO $table_logaltern (idref,remoteaddr,remotehost,remotereferer,system,page,date) VALUES ('0','$REMOTE_ADDR','$REMOTE_HOST','$HTTP_REFERER','$HTTP_USER_AGENT','$REQUEST_URI','$l_date')";
$c_db->query($l_sql);

?>
<html>

<header>

<title> plan du site <?=$g_sitename?> </title>

<META NAME="KEYWORDS"    CONTENT="<?=$g_sitename?>">
<META NAME="DESCRIPTION" CONTENT="<?=$g_sitename?>' s page list">
<META NAME="STUDIO"      CONTENT="KerniX Web Office - ultimate ecommerce-portal solution - http://www.kernix.com">
<META NAME="ROBOTS"      CONTENT="noindex,follow">
<META NAME="GOOGLEBOT"   CONTENT="NOARCHIVE">

<LINK HREF="<?=$g_skinpath?>/default/listpages.css" REL="stylesheet" TYPE="text/css">

</header>

<?php

//-- PRODUCT LIST
//$l_sql = "SELECT *  FROM $table_ref WHERE idproduct > 0 AND visibilityflag = 1";
//-- STD LIST
$l_sql = "SELECT idref, name, description, title, idproduct, updatedate FROM $table_ref WHERE nodekey >= '0101' AND visibilityflag = 1 AND idproperty <> 2 ORDER BY idref DESC";
$c_db->query($l_sql);

$n = $c_db->numrows;

?>

<body>

<?php if (!ereg('inerd',$g_domainname) && ($g_js == 1)): ?>
<script language="javascript">
window.location = '<?=$g_urlroot?>';
</script>
<?php endif; ?>

<table width="750" align="center" border="1" cellspacing="0" cellpadding="8" bordercolor="white">
 <tr><td>
  <h1>Plan du site : <?=$g_sitename?></h1>
  <font class=edito>Vous pouvez trouver ci-dessous une liste exhaustive de toutes les pages du site <b><?=$g_sitename?></b>
  ( <b><?=$g_urlroot?></b> ). 
  <br>Cette page est mise à jour trés régulièrement.
  Le site contient actuellement <b><?=$c_db->numrows?> pages</b>.</font><br><br><br><br><br>
 </td></tr>

<?php

while ($datas = $c_db->object_result())
{
  if ($j % 2) $l_class = 'dark'; else $l_class = 'light';
  print("\n<tr><td class=$l_class>\n");
  $datas->description = ereg_replace("\n"," ",$datas->description);
  print("<a href=/" . get_text_link($datas->name) . "__" . "$datas->idref.html><b>" . strtoupper($datas->title) . "</b></a> :<br>\n");
  print("$datas->description<br>\n");
  print('<i>dernière maj ' . show_date($datas->updatedate) . '</i>');
  print("</td></tr>\n");
  $j++;
}

$l_sql = "SELECT idref, idboard idboard FROM $table_ref WHERE idboard > 0 AND visibilityflag = 1";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $tab_pagenews[$i][0] = $obj->idref; 
    $tab_pagenews[$i][1] = $obj->idboard; 
    $i++;
  }
  $i = 0;
  while ($tab_pagenews[$i])
  {
    $l_idref = $tab_pagenews[$i][0];
    $l_idboard = $tab_pagenews[$i][1];
    $l_sql = "SELECT idpost, title, abstract, date FROM $table_boardpost WHERE idboard = " . $tab_pagenews[$i][1];
    $c_db->query($l_sql);
    while ($obj = $c_db->object_result())
    {
      if ($j % 2) $l_class = 'dark'; else $l_class = 'light';
      print("\n<tr><td class=$l_class>\n");
      print("<a href=$g_urldyn?p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost&p_idref=$l_idref><b>NEWS : $obj->title</b></a> :<br>");
      print(" $obj->abstract <br>\n");
      print('<i>date ' . show_date($obj->date) . '</i>');
      print("</td></tr>\n");
      $j++;
    }
    $i++;
  }
}

?>

</table>

<br><br><br><br><center>created by <b>KerniX Web Office</b>, 
<a href="<?=$g_softurl?>" title="solutions e-commerce, hebergement PHP/MySQL" target="_blank"><b>KERNIX.COM</b></a>
</center>
</body>
</html>
