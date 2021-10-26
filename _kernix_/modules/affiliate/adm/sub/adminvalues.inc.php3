
<form action="<?php print($PHP_SELF)?>" method="POST">
<input type="hidden" name="p_affiliateflag" value="adminvalues">
<input type="hidden" name="p_affiliateaction" value="home">

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=right valign=top width=98%><tr><td>

<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center class=color3>
.:: affiliatemode ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center>
   <br><select name=p_affiliatemode>
    <option value=2 <?php if ($affiliateadm->affiliatemode == 2) print("SELECTED"); ?> > -- POURCENT -- </option>
    <option value=1 <?php if ($affiliateadm->affiliatemode == 1) print("SELECTED"); ?> > -- VAL FIXE -- </option>
   </select><br><br>
  </td>
 </tr>
 <tr>
  <td align=center class=color3>
    .:: affiliatevalue ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center>
   <br><input name=p_affiliatevalue type=text class=text value="<?php print($affiliateadm->affiliatevalue); ?>" size=4> 
<?php
    if ($affiliateadm->affiliatemode == 1) print($g_currencyhtml);
else print("%");
?>
<br><br>
  </td>
 </tr>
 <tr>
  <td align=center class=color3>
.:: affiliatemax ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center>
   <br><input name=p_affiliatemax type=text class=text value="<?php print($affiliateadm->affiliatemax); ?>" size=6> <?php print($g_currencyhtml); ?><br><br>
  </td>
 </tr>
 <tr>
  <td align=center class=list>
   <input type=submit value="enregistrer" class=button>
  </td>
 </tr>
</table>

</td></tr></table>

</form>
