<?php

$table_alert = "alert";

$l_msg = "surveiller cette page";

if ($p_alertflag)
{
  if (is_valid_email($p_email))
  {
    $l_sql = "INSERT INTO $table_alert  (idref,idvisitor,email,date) VALUES ('$g_idref','$g_idvisitor','$p_email','$l_date')";
    $c_db->query($l_sql);
    return 1;
  }
  else
  {
    print("email invalide<br>");
  }
}

?>

<table width="80%">
 <tr>
  <td align=center class=main>
   <?php print("$l_msg"); ?>
   
  </td>
 </tr>
 <tr>
  <td align="center">
   <form method="post" action="<?php print("$PHP_SELF"); ?>">
   <input type="hidden" name="p_alertflag" value="true" size="10" class="text">
   <input type="text" name="p_email" value="" size="10" class="text">
   <br><input type="submit" value="envoyer" class="button">
   </form>
  </td>
 </tr>
</table>

