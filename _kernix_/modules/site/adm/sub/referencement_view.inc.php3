<?php

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);

$ref = $c_db->object_result();

include("sub/onglet.inc.php3");

?>

<form method="post" action="<?=$PHP_SELF?>" name="mainform">
<input type="hidden" name="p_siteadmaction" value="referencement_update">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">

<table width="100%">
 <tr>
  <td class="color1" align="left" colspan="2" height="20">:: [ <small>page#<?=$p_idref?></small> ] référencement : <small><?=$ref->name?></small></td>
 </tr>

 <tr>
  <td class="color2" align="right" valign="top">titre  &nbsp;</td>
  <td class="color3"><textarea name="p_title_ref" cols="65" rows="3"><?=$ref->title_ref?></textarea></td>
 </tr>

 <tr>
  <td class="color2" align="right" valign="top">mots clefs &nbsp;</td>
  <td class="color3"><textarea name="p_keywords" cols="65" rows="6"><?=$ref->keywords?></textarea></td>
 </tr>

 <tr>
  <td class="color2" align="right" valign="top">description &nbsp;</td>
  <td class=color3><textarea name="p_description" cols="65" rows="10"><?=$ref->description?></textarea></td>
 </tr>

 <tr>
  <td colspan="2" align="center">
   <br>
    <input type="submit" name="submit" value="enregistrer" class="button">
   <br><br>
  </td>
 </tr>

</table>

</form>
