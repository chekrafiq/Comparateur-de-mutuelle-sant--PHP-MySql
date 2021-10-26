<?php include("_top.inc.php"); ?>

    <tr> 
     <td>
      <table width="770"  border="0" cellspacing="0" cellpadding="0"> 
       <tr> 
        <td width="200" align="center" valign="top"><br> 

<?=get_ref_output("type:a@@url:/?p_idref=4@@text:".get_ref_output("type:img@@src:".$g_picturepath."/home-sante.jpg@@style:border: ".$g_borderflag."px")."@@alt:Mutuelle Sante@@title:Mutuelle Sante")?>

         <ul class="liste_bleu">

<?php
$l_tab = get_tabsubref(4,"","");
if (count($l_tab))
{
  for ($i=0;$i<count($l_tab);$i++)
  {
    echo get_ref_output("type:a@@url:".$l_tab[$i]["url"]."@@class:liste_bleu@@text:<li><div align='left'>".$l_tab[$i]["name"]."</div></li>@@alt:".$l_tab[$i]['accroche']."@@title:".$l_tab[$i]['accroche']);
  }
}
?>
         </ul>
        </td> 
        <td width="370" valign="middle"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="370" height="294"> 
          <param name="movie" value="<?=$g_mediapath?>/intro.swf"> 
          <param name="quality" value="high"> 
          <embed src="<?=$g_mediapath?>/intro.swf" width="370" height="294" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed> 
         </object>
        </td> 
        <td width="200" align="center" valign="top"><br>
<?=get_ref_output("type:a@@url:/?p_idref=5@@text:".get_ref_output("type:img@@src:".$g_picturepath."/home-epargne.jpg@@style:border: ".$g_borderflag."px")."@@alt:Epargne@@title:Epargne")?>

         <ul class="liste_vert">

<?php
$l_tab = get_tabsubref(5,"","");
if (count($l_tab))
{
  for ($i=0;$i<count($l_tab);$i++)
  {
    echo get_ref_output("type:a@@url:".$l_tab[$i]["url"]."@@class:liste_vert@@text:<li><div align='left'>".$l_tab[$i]["name"]."</div></li>@@alt:".$l_tab[$i]['accroche']."@@title:".$l_tab[$i]['accroche']);
  }
}
?>
         </ul>
        </td> 
       </tr> 
      </table>
     </td> 
    </tr>

<?php include("_bottom.inc.php"); ?>
