<?php

if ($p_confirmflag != 1):
  
?>

<font color="red">Attention !!</font> &nbsp; le fichier va être décompressé dans le répertoire < <?=$p_rep?> >,<br>
les fichiers seront TOUS placés à la racine de ce répertoire,<br>
les fichiers déjà présents sur le serveur seront écrasés s&#39;ils existent déjà.

<form action="<?=$PHP_SELF?>" method="post">
 <input type="hidden" name="p_rep" value="<?=$p_rep?>">
 <input type="hidden" name="p_userfile_name" value="<?=$p_userfile_name?>">
 <input type="hidden" name="p_fileaction" value="file_unzip">
 <input type="hidden" name="p_confirmflag" value="1">
 <input type="submit" value="dezipper le fichier" class="button">
</form>

<?php 

return 0;
endif; 


$l_file = "$l_base/$p_rep/$p_userfile_name";

$l_cmd = "kexec unzip -jo  $l_file -d $l_base/$p_rep > /dev/null";
//echo $l_cmd;
system($l_cmd);
$l_cmd = "kexec chown nobody.nobody $l_base/$p_rep/*.*";
system($l_cmd);
$l_cmd = "kexec chmod 755 $l_base/$p_rep/*.*";
system($l_cmd);

show_response("décompression OK");

?>

<center><a href="<?="$PHP_SELF?p_rep=$p_rep&p_fileaction=file_list"?>">retour</a></center><br>
