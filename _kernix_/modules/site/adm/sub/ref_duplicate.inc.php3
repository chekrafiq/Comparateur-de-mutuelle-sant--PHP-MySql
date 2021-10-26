<?php

if (!$p_idref_source)
{
  show_response("Pas de source sélectionnée");
  show_back();
  return;
}
elseif ($p_idref == $p_idref_source)
{
  show_response("Opération impossible : la source et la destination sont les mêmes pages");
  show_back();
  return;
}

$l_tabrefunvisible = array();
$p_idref_topsafe = $p_idref;
$l_refunvisibleflag = 0;

if ($p_ssrefflag == 3 && $p_couperflag)
{
//##########################################
// couper coller tous
//##########################################
  include("sub/ref_duplicate_3_1.inc.php3");
}
elseif($p_ssrefflag == 3 && !$p_couperflag)
{
//##########################################
// copier coller tous
//##########################################
  include("sub/ref_duplicate_3_0.inc.php3");
}
elseif($p_ssrefflag == 1 && $p_couperflag)
{
//##########################################
// couper coller uniquement la page source
//##########################################
  include("sub/ref_duplicate_1_1.inc.php3");
}
elseif($p_ssrefflag == 1 && !$p_couperflag)
{
//##########################################
// copier coller uniquement la page source
//##########################################
  include("sub/ref_duplicate_1_0.inc.php3");
}
elseif($p_ssrefflag == 2 && !$p_couperflag)
{
//##########################################
// copier coller uniquement les sous références
//##########################################
  include("sub/ref_duplicate_2_0.inc.php3");
}
elseif($p_ssrefflag == 2 && $p_couperflag)
{
//##########################################
// couper coller uniquement les sous références
//##########################################
  include("sub/ref_duplicate_2_1.inc.php3");
}

while($p_idref = array_pop($l_tabrefunvisible)) { include("sub/ref_changevisibility.inc.php3"); }

$l_sql = "UPDATE $table_admadm SET copy_idref = 0 WHERE idadmadm = 1";
$c_db->query($l_sql);

$p_idref = $p_idref_topsafe;      

$p_move = "order";
include("sub/ref_changeorder.inc.php3");

show_response("Duplication effectuée");
include("sub/ref_view.inc.php3");  
?>
