<?php
include("$g_modulespath/devis/var.inc");

if ($p_devisaction=="tempdevis")
{ 
  $p_devisaction = "homedevis";
  //echo "En construction.<a href='/?p_idref=$p_idref&p_devisaction=homedevis' class='contenu'>&nbsp;</a>";
  //return;
}

if ($p_devisaction=="tempsous")
{ 
  $p_devisaction = "homesous";
  //echo "En construction.<a href='/?p_idref=$p_idref&p_devisaction=homesous' class='contenu'>&nbsp;</a>";
  //return;
}

if ($p_devisaction=="retoursous")
{ 
  if (isset($MYSESSION["sous"])) unset($MYSESSION["sous"]);
  if (isset($MYSESSION["sous2"])) unset($MYSESSION["sous2"]);
  include("$g_designpath/common/modules.inc.php3");
  session_destroy();
  return;
}

if ($p_devisaction=="homesous")
{
  $p_devisaction = "homedevis";
  $l_txt = 1;
}

if ($p_devisaction=="sousetape")
{
  include("sous.inc.php3");
  //print_r($MYSESSION); 
?>
  </td>
  <td width="24%" align="center" valign="top"> 

  <?php include("_right_sous.inc"); ?>

  </td>
 </tr>
</table>
<?php
      return;
}

if ($p_devisaction == "homedevis" || $p_devisaction == "etape")
{
  include("devis.inc.php3");
  //print_r($MYSESSION);
?>
  </td>
  <td width="24%" align="center" valign="top"> 

<?php
if ($p_devisaction == "sousetape") include("_right_sous.inc");
else include("_right_devis.inc");
?>

  </td>
 </tr>
</table>
<?php
      return;
}
?>
