<?php

$l_sql = "SELECT * FROM $table_pub WHERE idpub = '$p_idpub' ORDER BY idpub DESC";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
<input type="hidden" name="p_idpub" value="<?php print("$p_idpub"); ?>">

<table align=center width=90%> 
 <tr>
  <td align=left class=color1 colspan=3>
   :: Pub < <small><?php print("$obj->name"); ?></small> > &nbsp;&nbsp;&nbsp;
      ( <small><?php print("$obj->nbview"); ?> nbview, <?php print("$obj->nbclick"); ?> clicks </small>)
  </td> 
 </tr>

 <tr>
  <td align=right class=color2 width=35%>nom &nbsp;</td>
  <td class=color3>
   <input type=text name=p_name size=20 class=text value="<?php print("$obj->name"); ?>">
  </td>
 </tr>
 <tr>
  <td align=right class=color2>data &nbsp;</td>
  <td class=color3>
   <input type=text name=p_image size=45 class=text value="<?php print("$obj->image"); ?>">
  </td>
 </tr>
 <tr>
  <td align=right class=color2>média &nbsp;</td>
  <td class=color3>
   <select name="p_media">
    <option value="PICT" SELECTED>-- image --</option>
    <option value="FLASH" <?php if($obj->media=="FLASH") print("SELECTED");?>>-- animation FLASH --</option>
    <option value="HTML" <?php if($obj->media=="HTML") print("SELECTED");?>>-- HTML/IFRAME --</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>adresse de destination &nbsp;</td>
  <td class=color3>
   <input type=text name=p_url size=45 class=text value="<?php print("$obj->url"); ?>">
  </td>
 </tr>
 <tr>
  <td align=right valign=top class=color2>description &nbsp;</td>
  <td class=color3>
   <textarea cols=45 rows=8 class=text name=p_description><?php print("$obj->description"); ?></textarea>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>type &nbsp;</td>
  <td class=color3>
   <select name="p_type">
    <option value="1" SELECTED>-- nbview --</option>
    <option value="2" <?php if($obj->type==2) print("SELECTED");?>>-- nbclick --</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>nbmax &nbsp;</td>
  <td class=color3>
   <input type=text name="p_nbmax" size=20 class=text value="<?php print("$obj->nbmax"); ?>">
  </td>
 </tr>
 <tr>
  <td align=right valign=top class=color2>infos &nbsp;</td>
  <td class=color3>
   <textarea cols=45 rows=8 class=text name=p_infos><?php print("$obj->infos"); ?></textarea>
  </td>
 </tr>
</table> 

<br>

 <select name=p_pubaction>
  <option value=store>-- enregistrer les modifications --</option>
  <option value=logview>-- voir les logs --</option>
  <option value=logreset>-- faire un reset des logs --</option>
 </select>&nbsp;
 <input type=submit value="exécuter" class=button>

</form>


<?php 

print("<br>");
show_hr();
print("<br>");
$g_idpub = $p_idpub;
include("$g_modulespath/pub/sub/index.inc.php3");

print("<br><br>");

show_back(); 

?>
