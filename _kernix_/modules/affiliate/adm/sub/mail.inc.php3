<?php

$l_email = $adm->email;

$l_sql = "SELECT * FROM $table_affiliate WHERE email != ''";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
     show_response("erreur, cet affilié n'existe pas."); 
     return 0;
}
$affiliate = $c_db->object_result();
?>

<form action="<?php print("$PHP_SELF"); ?>" method=POST>
<input type=hidden name=p_affiliateaction value=sendmail>
<table width=80% align=center>
 <tr>
   <td align=left class=color1 colspan=2>
    :: mailing &nbsp;&nbsp; <small>( <?php print("$c_db->numrows");?> emails ) </small>
   </td> 
 </tr> 
 <tr>
  <td class=color2 align=right width=25%>sujet &nbsp;</td>
  <td class=listlight align=left>
   &nbsp;<input type=text size=50 class=text name=p_subject>
  </td>
 </tr> 
 <tr>
  <td class=color2 align=right valign=top>corps &nbsp;</td>
  <td class=listlight align=left>
   &nbsp;<textarea rows=15 cols=50 class=text name=p_body></textarea>
  </td>
 </tr>
   <td class=color2 align=right width=25%>reply &nbsp;</td>
  <td class=listlight align=left>
   &nbsp;<input type=text size=25 class=text name=p_reply value=<?php print("$l_email");?>>
  </td>
 </tr> 
</table>

<table width=80% align=center>
<tr>
<td class=main align=left>
<input type=checkbox name=p_accountflag CHECKED>inclure le montant du compte<br>
<input type=checkbox name=p_commandflag CHECKED>inclure le nombre de commandes<br>
</td>
</tr>
</table>

<br><br>
<input type=submit value="envoyer" class=button>
<form>

<br><br><br>
