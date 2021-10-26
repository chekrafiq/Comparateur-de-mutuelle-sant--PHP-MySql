<form method=post action="<?php print($PHP_SELF);?>" > 
<input type=hidden name="p_idegroup"     value="<?php print($p_idegroup); ?>"> 
<input type=hidden name="p_egroupaction" value="email_store"> 
<input type=hidden name="p_egroupflag"   value="batch"> 

<textarea name=p_email cols=60 rows=40></textarea>

<br><br>

<?php show_hr(); ?>

<br>

<input type="submit" value="enregistrer les emails" class="button">

</form>
