<?php

$l_sql = "SELECT * FROM $table_showcase WHERE idshowcase = '$p_idshowcase' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<table cellspacing=2 cellpadding=2 border=0 width=98% align=center>
<tr>
<td width=60% class=main valign=left>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idshowcase" value="<?php print("$p_idshowcase"); ?>">

 <table width="98%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Showcase <?php print("$p_idshowcase"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print("$obj->name"); ?>" size="35">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" class="text" cols="35" rows="6"><?php print("$obj->description"); ?></textarea>
   </td>
  </tr> 
 </table> 

<br>

<center>
 <select name="p_showcaseaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce showcase --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">
</center>

</form>

</td>
<td class=main align=right valign=top>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center  class=color3>
   .:: creation ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center height=20>
   <?php print(show_datetime($obj->date)); ?>
  </td>
 </tr>
</table>
</td></tr></table>

</td>
</tr>
</table>


<?php 

show_hr(); 
include("sub/productadd.inc.php3");
show_hr();
print("<br>");
include("sub/productlist.inc.php3");
show_back(); 
?>

