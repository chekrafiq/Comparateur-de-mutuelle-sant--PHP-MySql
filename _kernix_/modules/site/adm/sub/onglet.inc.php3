<?php 

$n_cell = 6; 

?>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td class="admtablinkstitle">

<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>

  <td class="<?php if (!isset($p_siteadmaction) OR (ereg('ref',$p_siteadmaction) AND !ereg('referencement',$p_siteadmaction))) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref"?>" class="link">page</a>
  </td>

  <td class="<?php if (ereg('referencement',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="25%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=referencement_view"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=referencement_view"?>" class="link">référencement</a>
  </td>

  <td class="<?php if (ereg('content',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=content_view"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=content_view"?>" class="link">contenu</a>
  </td>

  <td class="<?php if (ereg('property',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=property_view"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=property_view"?>" class="link">propriétés</a>
  </td>

  <td class="<?php if (ereg('modules',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=modules_view"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=modules_view"?>" class="link">modules</a>
  </td>

  <td class="<?php if (ereg('admin',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
   &nbsp;<a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=admin_view"?>" class=leftlinks <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border=0></a>
   <a href="<?="$PHP_SELF?p_idref=$p_idref&p_siteadmaction=admin_view"?>" class="link">admin</a>
  </td>

<?php 

if ($ref->idproduct > 0): 
$n_cell++;

?>

   <td class="<?php if (ereg('product',$p_siteadmaction)) echo 'ongleton'; else echo 'ongletoff'; ?>" align="left" width="15%">
    &nbsp;<a href="<?="$PHP_SELF?p_siteadmaction=product_view&p_idref=$p_idref&p_idproduct=$ref->idproduct"?>" class="leftlinks" <?=$g_kwotarget?>><img src="/pictures/adm/point.gif" border="0"></a>
    <a href="<?="$PHP_SELF?p_siteadmaction=product_view&p_idref=$p_idref&p_idproduct=$ref->idproduct"?>" class="link" title="gestion produit">produit</a>
   </td>

<?php endif; ?>

 </tr>

 <tr><td class="list" colspan="<?=$n_cell?>>">&nbsp; <b>::</b>
<?php

$l_tabpath = get_tabpath_admin($ref->nodekey);
$i = 0;
while($l_tabpath[$i])
{
  print(" $sep <a href=$PHP_SELF?p_idref=" . $l_tabpath[$i]["idref"]  . " class=pathlink title=\" ID [ " . $l_tabpath[$i]["idref"] . " ]\">" . $l_tabpath[$i]["name"] . "</a>"); 
  $sep = '<img src=/pictures/adm/sep.gif> ';
  $i++;
}

?>
</td></tr>

<?php

if (($g_power == 1) && ereg('admin',$p_siteadmaction))
{
  $l_sql = "SELECT idref FROM ref WHERE nodekey >= '" . $ref->nodekey . "' AND nodekey < '" . $ref->nodekey . "ZZ'";
  $c_db->query($l_sql);
  $nbsspg = $c_db->numrows;
  print("<tr><td class=list colspan=$n_cell align=left>\n");
  print("<small>&nbsp; <b>::</b> ");
  print("prv=$ref->prev&nbsp;&nbsp;");
  print("nxt=$ref->next&nbsp;&nbsp;");
  print("up=$ref->up&nbsp;&nbsp;");
  print("nbsbref=$ref->nbsubref&nbsp;&nbsp;");
  print("nodek=$ref->nodekey&nbsp;&nbsp;");
  print("idorder=$ref->idorder&nbsp;&nbsp;");
  print("cp=$adm->copy_idref&nbsp;&nbsp;");
  print("sspg=$nbsspg");
  print("</small></td></tr>\n");
}

?>

</table>
</td></tr></table>
