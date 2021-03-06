<?php

$table_egroup  = "egroup";
$table_email   = "email";
$table_visitor = "visitor";

$l_sql = "SELECT * FROM $table_egroup WHERE idegroup = '$g_idegroup'";
$c_db->query($l_sql);
$egroup = $c_db->object_result();

if (isset($p_egroupflag))
{
  $ref->name = "::EGROUP:: $egroup->name - $p_email";
  if (!is_valid_email($p_email))
  {
    print("<div align=center class=contenu>$egroup->msgbad</div>");
  }
  else
  {
    if (($egroup->notificationflag == 1) && ($g_sendflag == 1))
    {
      mail($adm->email,"$g_sitename - nouvel email : egroup [$egroup->name]", "email : $p_email (" . show_datetime($l_date) . ")", "From: $g_sitename <$adm->email>\nErrors-to: $adm->email\n");
    }
    if (($egroup->confirmflag == 1) && ($g_sendflag == 1))
    {
      $l_msg = ereg_replace("%%EMAIL%%", $p_email, $egroup->msgconfirm);
      if ($g_pubflag == 1)  $l_msg .= "\n\n" . $g_pubmsg;
      mail($p_email,"$g_sitename - inscription newsletter", $l_msg, "From: $g_sitename <$adm->email>\nErrors-to: $adm->email\n");
    }
    $l_sql = "REPLACE INTO $table_email (idegroup,emailkey,email,format,idvisitor,source,idsource, flagpref, date) VALUES ('$g_idegroup','$g_idegroup-$p_email','$p_email','$p_emailformat','$g_idvisitor','EGROUP','$egroup->idegroup','$p_pref','$l_date')";
    $c_db->query($l_sql);
    $l_sql = "UPDATE $table_visitor SET email = '$p_email' WHERE idvisitor = '$g_idvisitor'";
    $c_db->query($l_sql);
    print("<div align=center class=contenu>$egroup->msgok</div>");
    return;
  }
}

?>


<!-- KERNIX EGROUP  -->


<table width="100%">
 <tr>
  <td align="center" class="contenu">

   <form method="POST" action="<?=$PHP_SELF?>">
    <input type="hidden" name="p_idegroup"   value="<?=$g_idegroup?>">
    <input type="hidden" name="p_idref"      value="<?=$g_idref?>">
    <input type="hidden" name="p_egroupflag" value="yes"> 

<?php 

print("<b>$egroup->subject</b>"); 

if ($egroup->formatflag == 1)
{
  print("<br><input type=radio name=p_emailformat value=TXT> TEXTE/AOL - \n");
  print("    <input type=radio name=p_emailformat value=HTML CHECKED> HTML<br>\n");
}
else
{
  print("<input type=hidden name=p_emailformat value=HTML>\n");
}

?>

  </td>
 </tr>
 <tr>
  <td align="center">
 
    <input type="text"   name="p_email"      value="<?=$p_email?>" size="14" class="text"><br>
  <input type="checkbox" name="p_pref" value="1" <?=($p_pref==1) ? "checked" : ""?>> <em class="contenu">je suis int?ress?(e) par des offres pr?f?rentielles de nos partenaires</em><br /> <br />
  <input type="submit" value="inscription" class="button">
   </form>

  </td>
 </tr>
</table>


<!-- END KERNIX EGROUP  -->
