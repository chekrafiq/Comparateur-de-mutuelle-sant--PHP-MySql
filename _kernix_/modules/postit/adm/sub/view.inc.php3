<?php

$l_sql = "SELECT * FROM $table_module WHERE code = '$p_module' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<p class=main>notes concernant le module ..... <?php print(strtoupper($obj->name)); ?>.</p> 


<?php show_hr(); ?>

<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_module" value="<?php print($p_module); ?>">

<textarea name="p_postit" cols="70" rows="30" class="postit"><?php print($obj->postit); ?></textarea>


<br><br><br>

 <select name="p_postitaction">
  <option value="store">-- enregistrer les modifications --</option>
<!--  <option value="list">-- lister les postits --</option> -->
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br>

<?php show_hr(); ?>

<form method="POST" action="<?php print("/$g_modulespath/$obj->path/adm"); ?>">
<input type="submit" value="retour au module : <?php print($obj->name); ?>" class="button">
</form>


<?php show_back(); ?>

