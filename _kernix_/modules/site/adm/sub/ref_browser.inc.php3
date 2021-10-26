<?php
$l_target = "target=\"kwo1\"";

if (isset($g_kwotarget))
{
  $l_target = $g_kwotarget;
}

function build_site_tree_2($root_ref)
{
  global $c_db, $table_ref, $table_property, $l_tree, $l_index;
  
  $l_sql = "SELECT idref, nodekey, name, description, nbsubref FROM $table_ref where idref >= $root_ref order by nodekey";
  $c_db->query($l_sql);
  while($l_list_ref = $c_db->object_result())
  {
    $l_tree[$l_index][0] = $l_list_ref->idref;
    $l_tree[$l_index][1] = strlen($l_list_ref->nodekey) / 2;
    $l_tree[$l_index][3] = $l_list_ref->nbsubref;
    $l_tree[$l_index][2] = $l_list_ref->name;
    $l_tree[$l_index][4] = $l_list_ref->description;
    $l_index++;
  }
}

function html_site_tree($idref)
{
  global $c_db, $l_tree, $l_index, $table_ref, $table_property, $l_target, $adm;
  
  $l_index = 0;
  $l_file = "";

  build_site_tree_2($idref);

  for ($i=0;$i<$l_index;$i++)
  {
    $l_cell = current($l_tree);
    $l_espace1 = "";

    if ($l_cell[1] > 1)
    {
      $l_test = $l_cell[1] - 1;
      for ($k=1;$k < $l_cell[1];$k++)
      {
	  $l_espace1 .= ".";
      }
    }

    if (!$l_cell[3])
    {
      $l_nbsubref = "";
    }
    else
    {
      $l_nbsubref = ", " . $l_cell[3];
    }
    
    $l_file .= $l_espace1 . ".<a href=\"/_kernix_/modules/site/adm/?p_idref=".$l_cell[0]."\" target=kwo1 title=\"" . ereg_replace("\r?\n", " ", $l_cell[4]) . "\">" . $l_cell[2] . "</a>$l_nbsubref - <small>[<a href=\"/_kernix_/modules/site/adm/?p_idref=".$l_cell[0]."\" $l_target>". $l_cell[0] . "</a>]";
    $l_file .= "&nbsp;&nbsp;<a href=\"$PHP_SELF?p_fromref=".$l_cell[0]."&p_siteadmaction=ref_browser&p_browseraction=copy\" title=\"Stock la page en mémoire pour un 'Coller' ultérieur\">< Copier</a>";
    if ($adm->copy_idref)
    {  
      $l_file .= "&nbsp;-&nbsp;<a href=\"$PHP_SELF?p_fromref=".$l_cell[0]."&p_siteadmaction=ref_duplicate_form\" title=\"Accès au menu pour coller la page en mémoire en tant que sous page de la référence actuelle\" $l_target>Coller</a>&nbsp;-&nbsp;<a href=\"$PHP_SELF?p_siteadmaction=ref_browser&p_browseraction=empty\" title=\"libère la mémoire de 'Copier'\">Vider</a>";
    }
    $l_file .= " ></small>\n";
    next($l_tree);
  }
  return $l_file;
}

if ($p_browseraction == "copy")
{
  $l_sql = "UPDATE $table_admadm SET copy_idref = '$p_fromref' WHERE idadmadm = 1";
  $c_db->query($l_sql);
}
elseif ($p_browseraction == "empty")
{
  $l_sql = "UPDATE $table_admadm SET copy_idref = 0 WHERE idadmadm = 1";
  $c_db->query($l_sql);
}

$l_sql = "SELECT * FROM $table_admshop, $table_admsite, $table_admadm";
$c_db->query($l_sql);
$adm = $c_db->object_result();

if (!is_file("$g_absolutepath/$g_cachepath/browser_cache.txt"))
{
  $fp = fopen("$g_absolutepath/$g_cachepath/browser_cache.txt", "a");
  $l_file = html_site_tree(2);
  fwrite($fp, $l_file);
  fclose($fp);
}

if ($p_browseraction)
{
  $fp = fopen("$g_absolutepath/$g_cachepath/browser_cache.txt", "w");
  $l_file = html_site_tree(2);
  fwrite($fp, $l_file);
  fclose($fp);
}

?>

<?php
$l_sql = "SELECT COUNT(idref) as n FROM $table_ref";
$c_db->query($l_sql);
$nbpages = $c_db->result(0,"n");
?>
<br>

<?php include("$g_modulespath/homesite/adm/sub/tab_search.inc.php3"); ?>

<br><br>
 < <?php print($nbpages); ?> pages au total > &nbsp; &nbsp; < <a href="<? print($PHP_SELF); ?>?p_siteadmaction=ref_browser&p_browseraction=gen">Regénerer la navigation</a> >
<?php if ($adm->copy_idref) { print(" &nbsp; &nbsp; < Copy : $adm->copy_idref >"); } ?>
 <br><br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=70%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=2 width=100%>

<?php
print("<tr>");
print("<td class=list valign=top>");
//print("$l_file<br><br>");

$treefile = "$g_absolutepath/$g_cachepath/browser_cache.txt";
include("$g_functionspath/treemenu.inc.php3");

print("<br></td>");
print("</tr>");
?>

</table>
</td></tr></table>
<br><br>
