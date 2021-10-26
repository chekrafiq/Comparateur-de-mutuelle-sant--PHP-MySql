<p align=center>

<form method="POST" action="<?php print("$PHP_SELF")?>">
 <input type="hidden" name="p_idcommand" value="<?php print("$p_idcommand")?>">
 <input type="hidden" name="p_idclient" value="<?php print("$l_row->idvisitor")?>">
 <input type="hidden" name="p_commandaction" value="send_command">
 <input type="text" name="p_email" class="text">
 &nbsp;&nbsp;
 <select name="p_mailinfos" size="1">
  <option value="commandclient"> commande seulement </option>
  <option value="command"> commande + infos client </option>
 </select>
 <br><br>
 <input type="submit" name="submit" value="envoyer la commande" class=button>
</form>

</p>
