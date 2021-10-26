<?php
if ($ref->idproperty == 8)
{
 $tab_subref = get_tabsubref($ref->up,"","");
 $refup = get_aref($ref->up);
 $ref->template = $refup->template;
 $ref->icon = $refup->icon;
 $l_title = $refup->title;
 $l_subtitle = $ref->title;
}
else
{
  $tab_subref = get_tabsubref($ref->idref,"","");
  $l_title = $ref->title;
  $l_subtitle = "";
}

if ($ref->up == 7 || $ref->up == 8) $ref->up = 2; 

if ($ref->template == "aucun") $ref->template = "";
?>

<?php include("_top.inc.php"); ?>

    <tr> 
     <td height="294">

<?php
switch($ref->template)
{
 case "bleu":
   $l_color1 = "#7EB1DD";
   $l_color2 = "#287DC7";
   break;
 case "vert":
   $l_color1 = "#85C680";
   $l_color2 = "#33A02C";
   break;
 case "rouge":
   $l_color1 = "#FE8C97";
   $l_color2 = "#FC0019";
   break;
 case "orange":
   $l_color1 = "#F2D98";
   $l_color2 = "#EABF40";
   break;
}
?>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"> 
       <tr>
<?php if ($ref->template && $ref->template != "aucun") { ?>
        <td width="128" valign="top" class="td_<?=$ref->template?>">

<?php if ($ref->icon) echo get_ref_output("type:img@@src:".$g_picturepath."/".$ref->icon."@@style:border: ".$g_borderflag."px") . "<br>"; ?>

         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="contenu" bgcolor="<?=$l_color2?>">
          <tr>
           <td height="20" bgcolor="#000000">&nbsp;</td>
          </tr>

<?php
if (count($tab_subref))
{
  for ($i=0;$i<count($tab_subref);$i++)
  {
?>
          <tr onmouseover='javascript:this.bgColor="<?=$l_color1?>"' onmouseout='javascript:this.bgColor="<?=$l_color2?>"'>
           <td height="20">

<?=get_ref_output("type:a@@url:".$tab_subref[$i]["url"]."@@class:menu@@text:".get_ref_output("type:img@@src:".$g_picturepath."/puce_blanche.gif@@style:border: ".$g_borderflag."px")."".$tab_subref[$i]["name"]."@@alt:".$tab_subref[$i]['accroche']."@@title:".$tab_subref[$i]['accroche'])?>

           </td>
          </tr>
<?php
  }
}
?>

	  <tr onmouseover='javascript:this.bgColor="<?=$l_color1?>"' onmouseout='javascript:this.bgColor="<?=$l_color2?>"'>
	   <td height="20"><a href="/?p_idref=<?=$ref->up?>" class="menu"><img src="<?=$g_picturepath?>/puce_retour.gif" width="7" height="7" border="0">Retour</a></td>
	  </tr>
         </table>
        </td>
<?php } ?>

        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="15" class="contenu">
          <tr>
           <td><br>
	    <span class="titre_<?=$ref->template?>"><?=$l_title?></span>
            <br> 
	    <br>
<?php if ($l_subtitle) { ?>
	    <span class="sous_titre"><?=$l_subtitle?></span>
	    <br>
<?php } ?>
<?php if ($ref->accroche) { ?>
	    <span class="accroche"><?=$ref->accroche?></span>
	    <br>
<?php } ?>

            <?=$ref->content?>

            <?php include("$g_designpath/common/modules.inc.php3"); ?>

            <?php include("_plan.inc.php"); ?>

           </td>
          </tr>
         </table>
        </td>
       </tr>
      </table>
     </td> 
    </tr> 

<?php include("_bottom.inc.php"); ?>
