<form action="<?php print("$PHP_SELF"); ?>">
<input type=hidden name=p_aboutaction value=send>
 <textarea rows=6 cols=70 name=p_txt></textarea>
 <br><br>
 <select name=p_type class=select>
  <option value=bug>- je désire reporter un BUG -</option>
  <option value=comment>- envoyer un commentaire -</option>
 </select>
 <br><br>
 <input type=submit class=button value="envoyer à KERNIX">
</form>
