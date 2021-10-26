<?php

// idbringer
// 0
// 1 : affiliation
// 2 : mailing

if ($p_idmailing > 0)
{
  $l_idbringer = $p_idmailing;
  $l_bringer   = '2';
}

if ($p_idaffiliate > 0)
{
  $l_idbringer = $p_idaffiliate;
  $l_bringer   = '1';
}

$p_refer = trim($p_refer,'/');

if ($p_refer == $p_page) $p_page = '::RELOAD::';

$l_sql = "INSERT INTO $table_log (idsession,idvisitor,idproperty,page,date,numvis,skin,design,bringer,idbringer,newvis,idpub) values ('$p_idvisitor-$p_numvis','$p_idvisitor','$p_idproperty','$p_page','$l_date','$p_numvis','$p_skin','$p_design','$l_bringer','$l_idbringer','$p_newvis','$p_idpub')";
$c_db->query($l_sql);

if ($p_newvis == 1)
{
  if (!($l_refer = $p_refer)) $l_refer = $p_remoteuser;
  if (eregi("mail|courrier|message|pop|smtp",$p_pagefrom)) $l_refer = '::MAIL::';
  $l_sql = "UPDATE $table_visitor SET urlfromlastvis = '$p_refer' WHERE idvisitor = '$p_idvisitor'";
  $c_db->query($l_sql);
}

$c_db->close();

Header("Content-type:  image/gif"); 
Header("Expires: Wed, 11 Nov 1998 11:11:11 GMT"); 
Header("Cache-Control: no-cache"); 
Header("Cache-Control: must-revalidate"); 
printf("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c",71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);

//header("Content-type: image/gif");
//readfile("$g_absolutepath/pictures/empty.gif");

?>
