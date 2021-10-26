<?php

$l_sql = "SELECT * FROM $table_commandstatus";
$c_db->query($l_sql);

while ($obj = $c_db->object_result())
{
  $tab_status[$obj->mode][$obj->status] = $obj->name;
}

if (isset($p_status_select))
{
  $p_deb = "01/" . $p_deb;
  $p_end = "31/" . $p_end;
  $p_deb_select = " AND A.date >= '" . date2bdd($p_deb) . " 00:00:00'";
  $p_end_select = " AND A.date <= '" . date2bdd($p_end) . " 23:59:59'";
  if (!empty($p_mode_select))
  {
    $p_mode_select = " AND mode = '$p_mode_select'";
  }
  $l_sql = "SELECT A.*, B.lastname FROM $table_command as A, $table_client as B WHERE A.idclient = B.idclient AND A.idcommand > 0 $p_status_select $p_mode_select $p_deb_select $p_end_select ORDER BY A.idcommand DESC";
//  print("$l_sql<br>");
}
else
{
  $l_sql = "SELECT A.*, B.lastname FROM $table_command as A, $table_client as B WHERE A.idclient = B.idclient AND A.status = 4 ORDER BY A.idcommand DESC";
}
$c_db->query($l_sql);

?>

<script language="Javascript">

function tinywindow(str)
 {
   w = window.open("","","toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=600,height=500 ");
   w.location = str;
 }

</script>


<table align=center width=98%>

 <tr>
  <td class=color2 width=5% align=center height=20>
   n°
  </td>
  <td class=color2 width=15% align=center>
   montant TTC
  </td>
  <td class=color2 align=left>
   &nbsp; état
  </td>
  <td class=color2 align=left>&nbsp;client</td>
  <td class=color2 width=22% align=center>
   date
  </td>
 </tr>

<?php
if ($c_db->numrows)
{
  $i = 0;
  while ($obj = $c_db->object_result())
  {
    if (($i++ % 2) == 0) $l_class = "listdark"; else $l_class = "listlight";
    if ($obj->status == 4)
    {
      $l_class = "hotwarning";
    }
    if (($obj->status > 4) && ($obj->status < 20))
    {
      $l_class = "warning";
    }
    print("<tr>");
    print("<td class=$l_class align=center>");
    print("<a href=\"$PHP_SELF?p_idcommand=$obj->idcommand&p_commandaction=command_view\" class=truelink>$obj->idcommand</a>");
    print("</td>");
    print("<td class=$l_class align=center> $obj->pricettcport $obj->currency </td>");
    if (($obj->status >= 4) && (($obj->status < 20)))
      print("<td class=$l_class align=left>&nbsp; " . $tab_status[$obj->mode][$obj->status] . " [$obj->mode]</td>");
    else
      print("<td class=" . $l_class . "small align=left>&nbsp; " . $tab_status["NONE"][$obj->status] . " [$obj->mode]</td>");
    print("<td class=$l_class align=left>[<a href='/$g_modulespath/client/adm/index.php3?p_clientaction=view&p_idclient=$obj->idclient'>$obj->idclient</a>] $obj->lastname</td>");
    print("<td class=$l_class align=center>" . show_datetime($obj->billdate) . "</td>");
    print("</tr>");
  }
}
?>
</table>

<br><br>

<?php show_hr(); ?>

<form action"<?php print($PHP_SELF)?>" method="POST">
<table width=98%>
<tr>
 <td class=main align=right width=40%>état</td>
 <td class=main>
 <select name="p_status_select">
  <option value=" AND A.status > 0">-- TOUS --</option>
  <option value=" AND A.status = 4">-- NOUVELLES COMMANDES --</option>
  <option value=" AND A.status = 20" SELECTED>-- FINALISEES --</option>
  <option value=" AND A.status = 1" SELECTED>-- ERREURS --</option>
  <option value=" AND A.status >= 4 AND A.status < 20" SELECTED>-- EN TRAITEMENT --</option>
 </select>
 </td>
</tr>
<tr>
 <td class=main align=right width=30%>moyen de paiement</td>
 <td class=main>
 <select name="p_mode_select">
  <option value="">-- TOUS --</option>
  <option value="CHQ">-- CHQ --</option>
  <option value="VIR">-- VIR --</option>
  <option value="CCB">-- CCB --</option>
 </select>
 </td>
</tr>
<tr>
 <td class=main align=right>début</td>
 <td class=main><input name="p_deb" type="text" class="text" value="<?php print(date("m/Y")); ?>"></td>
</tr>
<tr>
 <td class=main align=right>fin</td>
 <td class=main><input name="p_end" type="text" class="text" value="<?php print(date("m/Y")); ?>"></td>
</tr>
<tr>
 <td class=main height=40>&nbsp;</td>
 <td class=main><input type=submit value="lister les commandes" class="button"></td>
</tr>
</table>
</form>

<?php show_hr(); ?>

<form action"<?=$PHP_SELF?>" method="post">
 <input name="p_idcommand" type="text" class="text" value="" size="10">
 <select name="p_commandaction">
  <option value="command_view">-- éditer cette commande --</option>
<?//   <option value="client_ref">-- lister les clients ayant acheté cette réf --</option> ?>
<?//  <option value="files_home">-- génération de fichiers --</option> ?>
 </select>
 &nbsp; <input type=submit value="exécuter" class=button><br>
</form>

<? /* ?>
<?php show_hr(); ?>

<br>

<form action"<?=$PHP_SELF?>" method="post">
 <input name="p_commandaction" type="hidden" class="text" value="quickcommand_add">
 <input type=submit value="&#171; command express &#187;" class=button><br>
</form>
<? */ ?>
