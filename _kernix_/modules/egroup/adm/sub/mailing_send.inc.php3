<?php

if ($p_mailingflag != "test")
{
  $l_sql = "INSERT INTO $table_mailing (name,subject,body,nbemail,idegroup,date) VALUES ('$p_name','$p_subject','$p_body','$p_nbemail','$p_idegroup','$l_date')";
  echo $l_sql;
  $c_db->query($l_sql);
  $l_idmailing = $c_db->get_id();
  if ($p_idegroup != 0)
  {
    $p_nbrmsg++;
    $l_sql = "UPDATE $table_egroup SET nbmailing = nbmailing + 1, lastmsgdate = '$l_date' WHERE idegroup = '$p_idegroup'";
    $c_db->query($l_sql);
  }
  if ($p_recipient != "ALL") $l_cond = " AND format = '$p_recipient'";
  if ($p_idegroup != 0)
  {
    $l_sql = "SELECT email FROM $table_email WHERE idegroup = '$p_idegroup' AND status = '1' $l_cond";
  }
  else
  {
    $l_sql = "SELECT DISTINCT(email) FROM $table_email WHERE status = '1' $l_cond";
  }  
  $c_db->query($l_sql);
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    $tab_email[$i] = $obj->email;
    $i++;
  }
}
else
{
  if (!empty($p_emailtest))
  {
    $tab_email[0] = $p_emailtest;
  }
  else
  {
    show_response("il faut specifier un email de test");
  }
}


// get the infos from the profile tab
$l_sql = "SELECT * FROM $table_profile";
$c_db->query($l_sql);
$profile = $c_db->object_result();
$l_namefrom     = $profile->name;
$l_emailfrom    = $profile->emailfrom;
$l_emailreply   = $profile->emailreply; 
$l_emailrequest = $profile->emailrequest;
$l_signature    = $profile->signature;

$l_header  = "";
$l_header .= "From: $l_namefrom <$l_emailfrom>\n";
$l_header .= "Reply-To: $l_emailreply\n";
$l_header .= "X-Mailer: $g_softname\n";
$l_header .= "Errors-to: $profile->emailreply\n";

if ($p_priorityflag == 1)
{
  $l_header .= "X-Priority: 1\n";
}

if (($p_format == "HTMLFULL") || ($p_format == "HTMLBOX"))
{
  $l_header .= "MIME-Version: 1.0\n";
  $l_header .= "Content-Type: multipart/alternative; boundary=B97C1230\n";
  $l_text    = "\nThis is a multi-part message in MIME format.";
  $l_text   .= "\n--B97C1230\nContent-Type: text/html; charset=\"iso-8859-1\"\n\n";
}

// TEXT
if ($p_format == "TEXT")
{
  $l_text .= "\n$p_body\n";
  if ($p_signatureflag == "1")
  {
    $l_text .= "\n $l_signature";
  }
  if ($p_unsuscribeflag == "1")
  {
    $l_text .= "\n\n pour vous désisncrire cliquez <a href=\"$g_clientadminpage\">ici</a> ";
    if ($g_pubflag == 1) {$l_text .= "$g_pubmsg";}
  }
}
// HTMLBOX
elseif ($p_format == "HTMLBOX")
{
  if ($p_signatureflag == "1")
  {
    $p_body .= "\n\n<center>$l_signature</center>";
  }
  $p_body = nl2br($p_body);
  ob_start();        
  include ("sub/mailing_template.inc.php3");    
  $l_buf = ob_get_contents();
  ob_end_clean();
  $l_text .= $l_buf; 
  $l_text .= "\n--B97C1230--\n end of the multi-part";
}
// HTMLFULL
elseif ($p_format == "HTMLFULL")
{
  $l_text .= "\n$p_body\n";
  $l_text .= "\n--B97C1230--\n end of the multi-part";
}

$i = 0;
while ($tab_email[$i])
{ 
  $l_to = $tab_email[$i];
  if ($g_sendflag == 1) mail($l_to,$p_subject,$l_text,$l_header);
  $i++;
}

//show_response("<pre>$l_header  $l_text</pre>");
show_response("l'email a été envoyé $l_bcc");

print("<br>");

if (!isset($p_idegroup))
{
  include("sub/egroup_list.inc.php3");
}
else
{
  include("sub/egroup_view.inc.php3");
}

?>
