<?php

//print($l_lastsession . "<hr>");

function whatsnew($val,$url)
{
  global $g_kwotarget;

  if ($val == 0) 
  {
    print('&nbsp;');
    return 0;
  }
  print("<a href=\"$url\" $g_kwotarget title=\"voir les nouveautés\"><img src=/pictures/adm/warning.gif border=0></a>\n");
}

/*
$l_sql = "SELECT idemail FROM $table_email WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbnewemail = $c_db->numrows;

$l_sql = "SELECT idformpost FROM $table_formpost WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbform = $c_db->numrows;

$l_sql = "SELECT idaffiliate FROM $table_affiliate WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbnewaffiliate = $c_db->numrows;

$l_sql = "SELECT idcommand FROM $table_command WHERE date > '$l_lastsession' AND status = '4'";
$c_db->query($l_sql);
$l_nbnewcommand = $c_db->numrows;

$l_sql = "SELECT idpub FROM $table_publog WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbpubclick = $c_db->numrows;

$l_sql = "SELECT date FROM $table_pollpost WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbvote = $c_db->numrows;

$l_sql = "SELECT date FROM $table_gbpost WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbgb = $c_db->numrows;

$l_sql = "SELECT date FROM $table_keywords WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbkeywords = $c_db->numrows;

$l_sql = "SELECT idclient FROM $table_client WHERE date > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbclient = $c_db->numrows;

$l_sql = "SELECT idvisitor FROM $table_visitor WHERE firstvis > '$l_lastsession'";
$c_db->query($l_sql);
$l_nbnewvisitor = $c_db->numrows;

$l_sql = "SELECT idlog FROM $table_log WHERE date > '$l_lastsession' AND newvis = 1";
$c_db->query($l_sql);
$l_nbnewvisit = $c_db->numrows;

$l_timefivemnago = time() - (4 * 60);
$l_fivemnago = date("Y-m-d G:i:s",$l_timefivemnago);
$l_sql = "SELECT DISTINCT idsession FROM log WHERE date > '$l_fivemnago'";
$c_db->query($l_sql);
$l_nbactualvis = $c_db->numrows;
*/

?>

<table align="center" width="100%" align="center"> 

<?php if ($adm->ecommerceflag == 1): ?>
   <tr>
    <td align="left" class="color1" colspan="3">:: <?=$ln['e-commerce']?></td> 
   </tr>
   <tr>
    <td align="right" class="color2"><?=$ln['affiliate']?></td> 
    <td class="color3" align="center"><?=$l_nbnewaffiliate?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbnewaffiliate,"/$g_modulespath/affiliate/adm/index.php3"); ?></td>
   </tr> 
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['commands']?></td> 
    <td class="color3" align="center"><?=$l_nbnewcommand?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbnewcommand,"/$g_modulespath/command/adm/index.php3"); ?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['client_profile']?></td> 
    <td class="color3" align="center"><?=$l_nbclient?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbclient,"/$g_modulespath/client/adm/index.php3"); ?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['pub_clicks']?></td> 
    <td class="color3" align="center"><?=$l_nbpubclick?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbpubclick,"/$g_modulespath/pub/adm/index.php3"); ?></td>
   </tr>
   <tr><td>&nbsp;</td> </tr>
<?php endif; ?>
   <tr><td align="left" class="color1" colspan="3">:: <?=$ln['modules']?></td> </tr>
    <tr>
    <td align="right" class="color2" width="75%"><?=$ln['emails']?></td> 
    <td class="color3" align="center"><?=$l_nbnewemail?></td>
    <td class="listlight" align="center" width="8%"><?php whatsnew($l_nbnewemail,"/$g_modulespath/egroup/adm/index.php3?p_egroupaction=_whatsnew"); ?></td>
   </tr> 
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['form_responses']?></td> 
    <td class="color3" align="center"><?=$l_nbform?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbform,"/$g_modulespath/form/adm/index.php3?p_formaction=_whatsnew"); ?></td>
   </tr>   
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['poll_responses']?></td> 
    <td class="color3" align="center"><?=$l_nbvote?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbvote,"/$g_modulespath/poll/adm/index.php3?p_pollaction=_whatsnew"); ?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['guestbook_entries']?></td> 
    <td class="color3" align="center"><?=$l_nbgb?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbgb,'p_trafficaction=whtsnew'); ?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['keywords']?></td> 
    <td class="color3" align="center"><?=$l_nbkeywords?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbkeywords,"/$g_modulespath/searchengine/adm/index.php3?p_seaction=lastkeywords&p_option=whatsnew"); ?></td>
   </tr>
   <tr><td>&nbsp;</td> </tr>
   <tr><td align="left" class="color1" colspan="3">:: <?=$ln['site']?></td> </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['visits']?></td> 
    <td class="color3" align="center"><?=$l_nbnewvisit?></td>
    <td class="listlight" align="center"><?php whatsnew($l_nbnewvisit,"/$g_modulespath/visitor/adm/index.php3?p_visitoraction=list&p_option=whatsnew"); ?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['visitors']?></td> 
    <td class="color3" align="center"><?=$l_nbnewvisitor?></td>
    <td class="listlight" align="center">&nbsp;</td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2"><?=$ln['online_visitors']?></td> 
    <td class="color3" align="center"><?=$l_nbactualvis?></td>
    <td class="listlight" align="center">&nbsp;</td>
   </tr>

</table>

