<?php

if (!isset($p_idegroup))
{
  $p_idegroup = 0;
}

if ($p_idegroup == 0)
{
  $l_sql = "SELECT DISTINCT(email) FROM $table_email WHERE status = '1'";
}
else
{
  $l_sql = "SELECT email FROM $table_email WHERE idegroup = '$p_idegroup'  AND status = '1'";
}
$c_db->query($l_sql);
$l_nbemail = $c_db->numrows;

if ($c_db->numrows == 0)
{
  show_response("aucun email dans cet egroup");
  if (isset($p_idegroup))
  {
    include("sub/egroup_view.inc.php3");
  }
  else
  {
    include("sub/egroup_list.inc.php3");
  }
  return 0;
}

?>

<form method="post" action="<?=$PHP_SELF?>" > 
 
<input type="hidden" name="p_egroupaction" value="mailing_register"> 
<input type="hidden" name="p_idegroup"     value="<?=$p_idegroup?>">  

<br>

 <table align="center" width="90%"> 
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: nouveau mailing  &nbsp;&nbsp; [  <small><?=$c_db->numrows?> destinataires potentiels</small> ]</td> 
  </tr>
  <tr>
   <td align="right" class="color2"> nom du mailing &nbsp;</td>
   <td class="color3"><input type="text" name="p_name" class="text" size="25"></td>
  </tr>
  <tr>
   <td align="right" class="color2"> sujet &nbsp;</td>
   <td class="color3"><input type="text" name="p_subject" class="text" size="50"></td>
  </tr> 
  <tr>
   <td valign="top" align="right" class="color2">corps &nbsp;</td>
   <td class="color3"><textarea name="p_body" cols="60" rows="20"></textarea></td>
  </tr> 
  <tr>
   <td align="right" class="color2"> format &nbsp;</td>
   <td class="color3">
    <select name="p_format">
     <option value="TEXT">-- TEXT --</option>
     <option value="HTMLFULL" SELECTED>-- HTML --</option>
     <option value="HTMLBOX">-- SITE --</option>
    </select>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2"> destinataires &nbsp;</td>
   <td class="color3">
    <select name="p_sel_format">
     <option value="" SELECTED>-- TOUS --</option>
<!--
     <option value="HTML">-- HTML --</option>
     <option value="TEXT">-- TEXT --</option>
//-->
    </select>
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2"> email de test &nbsp;</td>
   <td class="color3"><input type="text" name="p_email" class="text" size="50"></td>
  </tr> 
  <tr>
   <td valign="top" align="right" class="main">
    <input type="checkbox" name="p_signatureflag" value="1"> &nbsp;
   </td>
   <td class="main">
    inclusion de votre signature
   </td>
  </tr>
<!--
  <tr>
   <td valign="top" align="right" class="main">
    <input type="checkbox" name="p_unsubscribeflag" value="1" CHECKED> &nbsp;
   </td>
   <td class="main">
    possiblité de se désabonner
   </td>
  </tr>
 //-->
  <tr>
   <td valign="top" align="right" class="main">
    <input type="checkbox" name="p_priorityflag" value="1"> &nbsp;
   </td>
   <td class="main">
    mail prioritaire
   </td>
  </tr>
</table>
<br>

<?php show_hr(); ?>

<br>
<select name="p_mailingflag">
 <option value="test" SELECTED>-- envoyer un mailing de test --</option>
 <option value="real">-- envoyer le mailing --</option>
</select>
<input type="submit" value='exécuter' class="button">

</form> 


<script language="Javascript">

function tinywindow(str)
 {
   w = window.open("","","toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=600,height=500");
   w.location = str;
 }

</script>

<?php 

show_hr();
print("<br>"); 
show_note(" <i>ATTENTION</i> : ce mailing sera envoyé avec les paramétres contenus <br> dans votre profil, clickez <a href=\"javascript:tinywindow('$PHP_SELF?p_egroupaction=profile_view');\" class=truelink>ici</a> pour le modifier <br>")

?>
