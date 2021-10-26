<?php
if ($p_za == "command")
{
  include("$g_displaypath/pages/DEVIS.inc.php3");
}
else
{
?>
<table width=100% border=0 height=100% cellspacing=0 cellpadding=0>
<tr>
<td width=10% valign=top class=zeroleft align=center>
<br>
<?php if (!$p_fromref) $p_fromref = 2; ?>
&nbsp;<a href="/?p_idref=<?php print($p_fromref); ?>">&#171; retour</a>
<br>
</td>
<td valign=top>

<table align=center valign=top width=95% cellspacing=8 cellpadding=0 border=0>
<tr><td class=main>
<?php
//echo "->$p_prix<br>";
include("$g_designpath/zero/middle.inc.php3");
?>
<br><br>
</td></tr>
</table>

<br>
</td>
</tr>
</table>

<?php
}
?>
