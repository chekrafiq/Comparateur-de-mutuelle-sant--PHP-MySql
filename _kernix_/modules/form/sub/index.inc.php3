<!-- BEGIN FORM -->
<LINK HREF="<?php print("$g_skinpath/$g_skin/form"); ?>.css" REL="stylesheet" TYPE="text/css">

<?php

function explode_formfieldstring($str)
{
  $l_tabfields = explode("&&",$str);
  $i = 0;
  while ($l_tabfields[$i])
  {
    $l_out[$i] = explode(";;",$l_tabfields[$i]);
    $i++;
  }
  return $l_out;
}

function format_libelle($str)
{
  $l = ereg_replace("_", " ", $str);
  $l = ucfirst($l);
  return $l;
}

$table_form      = "form";
$table_post      = "formpost";
$table_email     = "email";

$l_sql = "SELECT * FROM $table_form WHERE idform = '$g_idform' ";
$c_db->query($l_sql);
$form = $c_db->object_result();

$l_strvalid = bdd2html($form->msg_valid);
$l_strerror = bdd2html($form->msg_error);
$l_line          = "\n----------------------------------------------------------------------\n";


if(isset($p_formflag))
{
  $ref->name    = "FORM :: $form->name";
  $tab_field    = explode("&&",$form->fieldstring);
  $l_sepchar    = "";
  $l_poststring = "";
  $i = 0;
  while ($l_field = $tab_field[$i])
  {
    $tab_elem   = explode(";;",$l_field);
    $l_name     = $tab_elem[0];
    $l_required = $tab_elem[3];
    $l_val      = ${$l_name};

    if (empty($l_val) && ($l_required == 1))
    {
      print("<p class=contenu align=center><br>$l_strerror<br><br><a href='javascript:history.back()' class=contenu>Retour</a><br></p>");
      return 0;
    }

    if (eregi("mail",$l_name) && !is_valid_email($l_val))
    {
      print("<p class=contenu align=center><br>$l_strerror<br><br><a href='javascript:history.back()' class=contenu>Retour</a><br></p>");
      return 0;
    }

    if (eregi("mail",$l_name) && is_valid_email($l_val))
    {
      $email = $l_val;
    }

    $l_poststring .= $l_sepchar . $l_name . "==" . $l_val;
    $l_sepchar     = "&&";
    $i++;
  }
  $l_sql = "INSERT INTO $table_post (post,idvisitor,idform,date) VALUES ('$l_poststring','$g_idvisitor','$g_idform','$l_date')";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_form SET nbpost = nbpost + 1, lastpostdate = '$l_date' WHERE idform = '$g_idform'";
  $c_db->query($l_sql);
  if (($form->emailflag > 0) && ($g_sendflag == 1))
  {
    $l_header  = "";
    $l_header .= "From: $g_softname <$g_kernixemail>\n";
    if (is_valid_email($email)) $l_header .= "Reply-To: $email <$email>\n";
    $l_header .= "X-Mailer: $g_softname\n";
    $l_header .= "Errors-to: $adm->email\n";
    $l_subject    = "reponse au formulaire " . $form->name;
    $l_poststring = "- " . ereg_replace("=="," \n",$l_poststring);
    $l_poststring = ereg_replace("&&","\n\n- ",$l_poststring);
    $l_text       = "$l_date\n$l_line" . ereg_replace("_"," ",$l_poststring) . "\n" . $l_line;
    if ($g_pubflag == 1)  $l_text .= $g_pubmsg;
    mail($form->email, $l_subject, $l_text, $l_header);
  }
  if (($form->idegroup > 0) && is_valid_email($email))
  {
    $l_sql = "REPLACE INTO $table_email (idegroup,idvisitor,emailkey,email,opt,source,idsource,date) VALUES ('$form->idegroup','$g_idvisitor','$form->idegroup-$email','$email','OUT','FORM','$g_idform','$l_date')";
    $c_db->query($l_sql);
  }
  if ($g_idform == 10) $p_idref = 2;
  print("<p class=contenu align=center><br>$l_strvalid<br><br><a href='$g_urldyn?p_idref=$p_idref' class=contenu>Retour</a><br></p>");
  return 1;
}

?>

<form action="<?=$PHP_SELF?>" method="POST">
 <input type="hidden" name="p_idref"    value="<?=$g_idref?>">
 <input type="hidden" name="p_idform"   value="<?=$g_idform?>">
 <input type="hidden" name="p_formflag" value="store">

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">

<?php

if ($form->subject) print("<tr><td colspan=2 class=contenu>" . bdd2html($form->subject) . "<br><br><br></td></tr>\n\n");
$l_fields = explode_formfieldstring($form->fieldstring);
$i = 0;
$l_nbreq = 0;
while ($l_fields[$i])
{
  $l_valign = "middle";
  if ($l_fields[$i][0])
  {
    if ($l_fields[$i][1] == 1) $l_valign = " valign=top"; 
    print("<tr><td align=left $l_valign class=contenu width=40%>" . format_libelle($l_fields[$i][0]));
    if ($l_fields[$i][3] == 1)
    {
      print(" *&nbsp;");
      $l_nbreq++;
    }
    else { print(" &nbsp;&nbsp;"); }
    print("</td><td align=left class=contenu>\n");

    switch($l_fields[$i][1])
    {
    case "0":
      print("<input type=text size=42 name=\"" . $l_fields[$i][0] . "\" value=\"" . $l_fields[$i][2] . "\"");
      print("$l_rollover>\n");
      break;
    case "1":
      print("<textarea cols=32 rows=7 name=\"" . $l_fields[$i][0] . "\"$l_rollover>");
      if ($l_fields[$i][2] == "dynamique_ce")
      {
	print($msgce);
      }
      else
      {
	print($l_fields[$i][2]);
      }
      print("</textarea>\n");
      break;
    case "2":
      print("<select name=\"" . $l_fields[$i][0] . "\"");
      print("$l_rollover>");
      $l_options = explode(",",$l_fields[$i][2]);
      $j = 0;
      while ($l_options[$j])
      {
	print("<option value=\"$l_options[$j]\">-- $l_options[$j] --</option>");
	$j++;
      }
      print("</select>\n");
      break;
    case "3":
      $l_options = explode(",",$l_fields[$i][2]);
      $j = 0;
      while ($l_options[$j])
      {
	print("<input type=radio name=\"" . $l_fields[$i][0] . "\" value=\"$l_options[$j]\" >$l_options[$j] &nbsp;");
	$j++;
      }
      break;
    }
    print("</td></tr>\n");
  }
  $i++;
}
?>
	   
 <tr>
  <td align="left" class="contenu" colspan=2>

<?php
if ($l_nbreq > 0) print("(* champs obligatoires)"); 
?>

  </td>
 </tr> 
 <tr>
  <td align="center" colspan=2>
   <input type="submit" value="Envoyer" class="button">
  </td>
 </tr>
</table>

</form>

<!-- END FORM -->
