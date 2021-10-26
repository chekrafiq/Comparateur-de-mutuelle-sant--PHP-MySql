<form action="<?php print($PHP_SELF); ?>">
<select name=p_hcaction>
 <option value=writecache>-- Ecrire le CACHE --</option>
 <option value=rehash>-- reconstruire toute la table de HASH --</option>
<!-- <option value=viewresult>-- voir le contenu de la table de HASH --</option> -->
</select>
<br><br>
<input type=submit class=button value="exécuter">
</form>
