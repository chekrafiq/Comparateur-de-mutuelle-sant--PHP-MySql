<?php

function convert_link($str,$format)
{
  global $g_urlroot;

  if (ereg("HTML",$format))
  {
//    $out = eregi_replace("<link:([[:alnum:][:space:]_-]*),([[:alnum:]/+-=%&:_~?\.]*)>","<a href=\"$g_urlroot/extern/redirect.php3?p_url=\\2&p_idmailing=1\">\\1</a>", $str);
    $out = eregi_replace("<link:([[:alnum:][:space:]_-]*),([[:alnum:]/+-=%&:_~?\.]*)>","<a href=\"$g_urlroot/extern/redirect.php3?p_url=\\2&p_idmailing=%%IDMAILING%%\">\\1</a>", $str);
  }
  else
  {
    $out = eregi_replace("<link:([[:alnum:][:space:]_-]*),([[:alnum:]/+-=%&:_~?\.]*)>","\\1 ( \\2 ) ", $str);
  }
  return $out;
}

if (empty($p_email) && ($p_mailingflag == "test"))
{
  show_response("un email de test doit être spécifié.");
  show_back();
  return 0;
}


$p_body = stripslashes($p_body);


//--- get the infos from the profile tab
//--------------------------------------
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
  $l_body    = "\nThis is a multi-part message in MIME format.";
  $l_body   .= "\n--B97C1230\nContent-Type: text/plain; charset=\"iso-8859-1\"\n\n";
  $l_body   .= "si vous n'arrivez pas à lire ce message etc...";
  $l_body   .= "\n--B97C1230\nContent-Type: text/html; charset=\"iso-8859-1\"\n\n";
}

//-- TEXT
//-------
if ($p_format == "TEXT")
{
  $l_body .= "\n$p_body\n";
  $l_header .= "Content-Type: text/plain; charset=ISO-8859-1\n";
  if ($p_signatureflag == "1")
  {
    $l_body .= "\n $l_signature";
  }
  if ($p_unsuscribeflag == "1")
  {
    $l_body .= "\n\n pour vous désisncrire cliquez <a href=\"$g_clientadminpage\">ici</a> ";
    if ($g_pubflag == 1) {$l_body .= "$g_pubmsg";}
  }
}

//-- HTMLBOX
//----------
elseif ($p_format == "HTMLBOX")
{
  if ($p_signatureflag == "1")
  {
    $p_body .= "\n\n\n<center>$l_signature</center>";
  }
  $p_body = nl2br($p_body);
//  $p_body = chunk_split($p_body);
  ob_start();        
  include ("sub/mailing_template.inc.php3");    
  $l_buf = ob_get_contents();
  ob_end_clean();
  $l_body .= $l_buf; 
  $l_body .= "\n--B97C1230--\n end of the multi-part";
}

//-- HTMLFULL
//-----------
elseif ($p_format == "HTMLFULL")
{
  $l_body .= "\n$p_body\n";
  $l_body .= "\n--B97C1230--\n end of the multi-part";
}

$l_body = convert_link($l_body, $p_format);

if ($p_mailingflag != "test")
{
  $l_replace_flag = 0;
  $p_body = addslashes($p_body);
  $l_body = addslashes($l_body);
  if (eregi("%%EMAIL%%",$p_body)) $l_replace_flag = 1;
  $l_sql = "INSERT INTO $table_mailing (idegroup,name,subject,header,body,rawbody,format,sel_format,replace_flag,status,date) VALUES ('$p_idegroup','$p_name','$p_subject','$l_header','$l_body','$p_body','$p_format','$p_sel_format','$l_replace_flag','1','$l_date')";
  $c_db->query("$l_sql");
  if ($p_idegroup != 0)
  {
    $l_sql = "UPDATE $table_egroup SET nbmailing = nbmailing + 1, lastmsgdate = '$l_date' WHERE idegroup = '$p_idegroup'";
    $c_db->query($l_sql);
  }
}
elseif ($g_sendflag == 1)
{
  $p_subject = stripslashes($p_subject);
  $l_body    = stripslashes($l_body);
  mail($p_email,$p_subject,$l_body,$l_header);
}

if ($p_mailingflag == "test")
{
  show_response("email de test envoyé");
  print("<br><br>");
  show_back();
  return 0;
}
else
{
  show_response("le mailing sera envoyé en cours de soirée");
}

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
