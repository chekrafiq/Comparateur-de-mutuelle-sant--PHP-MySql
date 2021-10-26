<?php

$l_file_orig = "$l_base/$p_rep/$p_userfile_name";
$l_file_dest = "$l_base/$p_rep/$p_destfile_name";

if (!empty($p_w_val) || !empty($p_h_val))
{
  if (empty($p_w_val)) $p_w_val = round($p_w_oldval * ($p_h_val / $p_h_oldval));
  elseif (empty($p_h_val)) $p_h_val = round($p_h_oldval * ($p_w_val / $p_w_oldval));
  $l_cmd = "kexec /usr/X11R6/bin/convert convert -geometry " . $p_w_val . "x" . $p_h_val ."! $l_file_orig $l_file_dest";
//  echo $l_cmd;
  system($l_cmd);  
  if (file_exists($l_file_dest))
  {
    $p_userfile_name = $p_destfile_name;
    system("kexec chown nobody.nobody $l_file_dest");
    system("kexec chmod 755 $l_file_dest");
    show_response("modification effectuée.<br>");
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>problème lors de la transformation.<br>");
    show_back();
  }
}

if (!empty($p_rotation_val))
{
  $l_cmd = "kexec /usr/X11R6/bin/convert convert -rotate $p_rotation_val $l_file_orig $l_file_dest";
  system($l_cmd);
  if (file_exists($l_file_dest))
  {
    $p_userfile_name = $p_destfile_name;
    system("kexec chown nobody.nobody $l_file_dest");
    system("kexec chmod 755 $l_file_dest");
    show_response("modification effectuée.<br>");
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>problème lors de la transformation.<br>");
    show_back();
  }
}

if (!empty($p_bordersize_val))
{
  $l_cmd = "kexec /usr/X11R6/bin/convert convert -border " . $p_bordersize_val . "x" . $p_bordersize_val . " -bordercolor $p_bordercolor_val $l_file_orig $l_file_dest";
  system($l_cmd);
  if (file_exists($l_file_dest))
  {
    $p_userfile_name = $p_destfile_name;
    system("kexec chown nobody.nobody $l_file_dest");
    system("kexec chmod 755 $l_file_dest");
    show_response("modification effectuée.<br>");
  }
  else
  {
    show_response("<font color=red>-- warning --</font><br>problème lors de la transformation.<br>");
    show_back();
  }
}

//echo $l_cmd;



// include("sub/file_action.inc.php3");

?>

<form action="<?=$PHP_SELF?>">
<input type="hidden" name="p_rep" value="<?=$p_rep?>">
<input type="hidden" name="p_userfile_name" value="<?=$p_userfile_name?>">
<input type="hidden" name="p_fileaction"   value="file_action">
<input type="submit" value="retour sur l'image" class="button">
</form>
