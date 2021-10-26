<?php

$l_file = "$g_urlroot/upload/$p_rep/" . $p_userfile_name;

$l_size = filesize("$l_base/$p_rep/" . $p_userfile_name) / 1000;

$l_size = sprintf("%.2f", $l_size);

$tab_size = getimagesize("$g_urlroot/upload/$p_rep/" . $p_userfile_name);

?>

<br>

<table width="80%" bordercolor="black" bgcolor="black" border="0" cellpadding="3" cellspacing="1" align="center">
<form action="<?=$PHP_SELF?>">
<input type="hidden" name="p_rep" value="<?=$p_rep?>">
<input type="hidden" name="p_userfile_name" value="<?=$p_userfile_name?>">
<input type="hidden" name="p_fileaction"   value="file_transform_exec">
<input type="hidden" name="p_w_oldval"   value="<?=$tab_size[0]?>">
<input type="hidden" name="p_h_oldval"   value="<?=$tab_size[1]?>">
 <tr>
  <td class="color2" align="left"> 
   :: fichier d&#39;origine &nbsp; : 
   &nbsp; <a href="<?=$l_file?>" class="whitelink"><?=$p_userfile_name?></a> 
   __ [ <i><?=$l_size?> k</i> ] __ [ <?php echo "$tab_size[0] x $tab_size[1]"; ?> ]
  </td>
 </tr>
 <tr>
  <td class="list">
   <table width="95%" align="center">
    <tr>
     <td class="main" width="40%" align="right">fichier de destination &nbsp;</td>
     <td class="main"><input type="text" name="p_destfile_name" value="<?=$p_userfile_name?>" class="text"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td class="list">
   <table width="95%" align="center">
    <tr>
     <td class="main" width="40%" align="right">dimensions &nbsp;</td>
     <td class="main"><input type="text" name="p_w_val" value="" class="text" size="5"> x <input type="text" name="p_h_val" value="" class="text" size="5"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td class="list">
   <table width="95%" align="center">
    <tr>
     <td class="main" width="40%" align="right">rotation &nbsp;</td>
     <td class="main">
      <select name="p_rotation_val">
       <option value="">-- aucune rotation --</option>
       <option value="90">-- 90° --</option>
       <option value="180">-- 180° --</option>
      </select>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td class="list">
   <table width="95%" align="center">
    <tr>
     <td class="main" width="40%" align="right">bordure &nbsp;</td>
     <td class="main">
      <select name="p_bordersize_val">
       <option value="">-- aucun bord --</option>
       <option value="1">-- 1 pixel --</option>
       <option value="2">-- 2 pixels --</option>
      </select>
     </td>
    </tr>
    <tr>
     <td class="main" width="40%" align="right">couleur de la bordure &nbsp;</td>
     <td class="main">
      <select name="p_bordercolor_val">
       <option value="black">-- noir --</option>
       <option value="white">-- blanc --</option>
      </select>
     </td>
    </tr>
   </table>
  </td>
 </tr> 
 <tr>
  <td class="list" align="center" height="50">
   <input type="submit" value="exécuter" class="button">
  </td>
 </tr>
</form>
</table>

<br><br><br>

<?php show_back_url("$PHP_SELF?p_fileaction=file_list&p_userfile_name=&p_rep=$p_rep"); ?>
