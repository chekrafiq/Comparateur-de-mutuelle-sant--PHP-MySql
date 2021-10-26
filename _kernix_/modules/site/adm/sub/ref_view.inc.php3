<?php

if ($p_sitespecialaction == "copy")
{
  $l_sql = "UPDATE $table_admadm SET copy_idref = '$p_idref' WHERE idadmadm = 1";
  $c_db->query($l_sql);
}
elseif ($p_sitespecialaction == "empty")
{
  $l_sql = "UPDATE $table_admadm SET copy_idref = 0 WHERE idadmadm = 1";
  $c_db->query($l_sql);
}

if (isset($p_sitespecialaction))
{
  $l_sql = "SELECT * FROM $table_admshop, $table_admsite, $table_admadm";
  $c_db->query($l_sql);
  $adm = $c_db->object_result();
}

function html_subref_list($id, $l_limit)
{
  global $c_db, $table_ref, $table_property;
  
  $l_sql = "SELECT idref, name, description, idorder, idproduct, visibilityflag FROM $table_ref AS R WHERE up = '$id' ORDER BY R.idorder DESC";
  if (!$l_limit) $l_sql .= ' limit 0,15';
  $c_db->query($l_sql);
  $n = $c_db->numrows;
  $l_list = "<table width=100% align=center>\n";
  $i = 1;
  while ($obj = $c_db->object_result())
  {
    $l_list .= "<tr>\n";
    $l_list .= "<td class=color3 width=2%><small> [$n] </small></td>\n";
    $l_class = "listlight";
    if ($obj->visibilityflag == 0) $l_class = "warning";
    $l_list .= "<td class=$l_class>&nbsp;<small> <a href=$PHP_SELF?p_idref=$obj->idref class=truelink title=\"ID [ $obj->idref ]\"><b>$obj->name</b></a></td>\n";
    if ($obj->visibilityflag == 1)
    {
      $l_list .= "<td class=color3 width=2% align=middle><a href=$PHP_SELF?p_idorder=$obj->idorder&p_siteadmaction=ref_changeorder&p_move=down&p_fromref=$id&p_listlimit=$l_limit class=truelink title=\"monter\"><img src=/pictures/adm/up.gif border=0></a></td>\n";
      $l_list .= "<td class=listlight width=2% align=middle><a href=$PHP_SELF?p_idorder=$obj->idorder&p_siteadmaction=ref_changeorder&p_move=up&p_fromref=$id&p_listlimit=$l_limit class=truelink title=\"descendre\"><img src=/pictures/adm/down.gif border=0></a></td>\n";
      $l_list .= "<td class=color3 width=2% align=middle><a href=$PHP_SELF?p_idorder=$obj->idorder&p_siteadmaction=ref_changeorder&p_move=top&p_fromref=$id&p_listlimit=$l_limit class=truelink title=\"tout en bas\"><img src=/pictures/adm/bottom.gif border=0></a></td>\n";
      $l_list .= "<td class=listlight width=4% align=middle><a href=$PHP_SELF?p_idref=$obj->idref&p_siteadmaction=ref_del class=truelink title=\"supprimer cette page\"><img src=/pictures/adm/suppr.gif border=0></a></td>\n";
    }
    else
    {
      $l_list .= "<td class=color3 width=2% align=middle colspan=3>&nbsp;</td>\n";
    }
    $l_list .= "</tr>\n";
    $i++;
    $n--;
  }
  $l_list .= "</table>\n\n";
  if ($i == 1) $l_list = '';
  return $l_list;
}

$l_sql = "SELECT * FROM $table_property AS P, $table_ref AS R WHERE R.idref = '$p_idref' AND R.idproperty = P.idproperty";
$c_db->query($l_sql);

if (!$c_db->numrows)
{
  $p_idref=2;
  $l_sql = "SELECT * FROM $table_property AS P, $table_ref AS R WHERE R.idref = '$p_idref' AND R.idproperty = P.idproperty";
  $c_db->query($l_sql);
}

$ref = $c_db->object_result();

$l_propertylist  = build_select($table_property,$ref->idproperty,"idproperty","propertyname","p_idproperty","","","");

if ($p_listlimit == "no") $p_limit = 100;
$l_list_subpages = html_subref_list($ref->idref, $p_listlimit);

include("sub/onglet.inc.php3");

$l_bartitleclass = "color1";
if (!$ref->visibilityflag) $l_bartitleclass = "warning";

?>

<form method="post" action="<?=$PHP_SELF?>" name="mainform">
<input type="hidden" name="p_design" value="<?=$ref->design?>">

<table width="100%" border="0">
 <tr>
  <td class="<?=$l_bartitleclass?>" align="left" colspan="2" height="20" valign="center">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td align="left" class="color1" height="20">:: [ <small>page#<?=$p_idref?></small> ] &nbsp; ( <small>dernière maj le <?php echo show_datetime($ref->updatedate); ?></small> )</td> 
     <td align=right class="color3">

<?php

print("<a href=\"$PHP_SELF?p_idref=$p_idref&p_sitespecialaction=copy\" class=whitelink title=\"stock la page en mémoire pour un 'Coller' ultérieur\"><img src=/pictures/adm/copy.gif border=0 align=absbottom></a>");

if ($adm->copy_idref) 
{ 
  print("<a href=\"$PHP_SELF?p_fromref=$p_idref&p_siteadmaction=ref_duplicate_form\" class=whitelink title=\"accès au menu pour coller la page en mémoire en tant que sous page de la référence actuelle\"><img src=/pictures/adm/paste.gif border=0 hspace=3 align=absbottom></a>");
  print("<a href=\"$PHP_SELF?p_idref=$p_idref&p_sitespecialaction=empty\" class=whitelink title=\"annule le copier\"><img src=/pictures/adm/cancel.gif border=0 hspace=8 align=absbottom></a>"); 
} 

?>
     </td>
    </tr>
   </table>
  </td>
 </tr>

 <tr>
  <td class="color2" align="right" width="22%">type de page&nbsp;</td>
  <td class="color3"><?=$l_propertylist?></td>
 </tr>

 <tr>
  <td class="color2" align="right">nom &nbsp;</td>
  <td class="color3"><input class="text" type="text" name="p_name" value="<?=$ref->name?>" size="65"></td>
 </tr>

 <tr>
  <td class="color2" align="right">renvoi automatique &nbsp;</td>
  <td class="color3"><input class="text" type="text" name="p_link" value="<?=$ref->link?>" size="65"></td>
 </tr>

 <tr>
  <td colspan="2" align="center">

   <br>
    <input type="hidden" name="p_idref" value="<?=$p_idref?>">
    <select name="p_siteadmaction" size="1">
     <option value=ref_update selected> -- enregistrer les modifications -- </option>
     <?php if (!$l_row->idproduct) print("<option value=ref_add_form>-- ajouter une sous-page --</option>"); ?>
     <option value=ref_del>-- supprimer la page actuelle (#<?=$ref->idref?>) --</option>
    </select>
    <input type="submit" name="submit" value="exécuter" class="button">
    <br><br>
  </td>
 </tr>

 <tr>
  <td class="color1" align="left" colspan="2">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="50%" align="left" class="color1" height="20">:: sous-pages</td>
     <td  width="50%" align="right" class="color1">
<?php 

if ($ref->prev != 0) print("<a href=$PHP_SELF?p_idref=$ref->prev class=whitelink title=\"page prec\"><img src=/pictures/adm/prev.gif border=0 hspace=1 align=absbottom></a>");
if ($ref->up != 0) print("<a href=$PHP_SELF?p_idref=$ref->up class=whitelink title=\"remonter d'un niveau\"><img src=/pictures/adm/refup.gif border=0 hspace=1 align=absbottom></a>");
if ($ref->next != 0) print("<a href=$PHP_SELF?p_idref=$ref->next class=whitelink title=\"page suiv\"><img src=/pictures/adm/next.gif border=0 hspace=1 align=absbottom></a>");
if ($ref->nbsubref > 15) print(" . <a href=\"$PHP_SELF?p_idref=$p_idref&p_listlimit=no\" class=whitelink title=\"afficher toutes les pages\"><img src=/pictures/adm/displayall.gif border=0 hspace=6 align=absbottom></a>"); 

?>
     &nbsp;
     </td>
    </tr>
   </table>
  </td>
 </tr>

<?php if ($l_list_subpages[0] != ""): ?>

 <tr><td class="color3" colspan="2">
   <?=$l_list_subpages?>
 </td></tr>

<?php endif; ?>

</table>

<br><br>

</form>
