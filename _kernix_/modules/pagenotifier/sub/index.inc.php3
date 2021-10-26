<?php
$table_egroup = "egroup";
$table_email = "email";
$table_visitor = "visitor";
$table_client = "client";
$l_pnmessage = "mailez cet page à un ami";

if (!isset($p_pnemail)):

$l_sql = "SELECT * FROM $table_egroup WHERE idegroup = '$g_idegroup'";
$c_db->query($l_sql);

$egroup = $c_db->object_result();
?>

<table width=80%>
 <tr>
  <td align=center class=main>
   <?php print("$l_pnmessage"); ?>
   
  </td>
 </tr>
 <tr>
  <td align=center>
   <form method=post action="<?php print("$PHP_SELF"); ?>">
   <input type=hidden name=p_idegroup value="<?php print("$g_idref"); ?>">
   <input type=text name=p_pnemail value="" size="10" class=text>
   <br><input type=submit value=envoyer class=button>
   </form>
  </td>
 </tr>
</table>

<?php
else:
{

     $l_sql = "SELECT email FROM $table_email  WHERE idegroup = '$p_idegroup' AND email = '$p_email'";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  print("vous êtes déjà enregistré.");
     }
     else
     {
	  $l_sql = "INSERT INTO $table_email  (idegroup,email,idvisitor,creationdate) VALUES ('$p_idegroup','$p_email','$g_idvisitor','$l_date')";
	  $c_db->query($l_sql);
	  if ($g_idvisitor > 0)
	  {
	       $l_sql = "SELECT idclient FROM $table_visitor WHERE idvisitor = '$g_idvisitor'";
	       $c_db->query($l_sql);
	       $l_idclient = $c_db->result(0,"idclient");
	       if ($l_idclient != 0)
	       {
		    $l_sql = "UPDATE $table_client SET email2 = '$p_email' WHERE idclient = '$l_idclient'";
		    $c_db->query($l_sql);
	       }
	       else
	       {
		    $l_sql = "INSERT INTO $table_client (email2) VALUES ('$p_email')";
		    $c_db->query($l_sql);
		    $l_idclient = $c_db->get_id();
		    $l_sql = "UPDATE $table_visitor SET idclient = '$l_idclient' WHERE idvistor = '$g_idvisitor'"; 
		    $c_db->query($l_sql); 
	       }
	  }
	  print("enregistrement éffectué.");
     }
}
endif;
?>

