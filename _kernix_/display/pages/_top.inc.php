<?php $tab_menuhaut = get_tabsubref(7,"",""); ?>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000000"> 
 <tr> 
  <td>
   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
    <tr> 
     <td height="80">
      <table width="770" height="100%"  border="0" cellpadding="0" cellspacing="0"> 
       <tr> 
        <td width="400"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="400" height="80"> 
          <param name="movie" value="<?=$g_mediapath?>/logo.swf"> 
          <param name="quality" value="high"> 
          <embed src="<?=$g_mediapath?>/logo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="400" height="80"></embed> 
         </object>
        </td> 
        <td align="right" valign="bottom" class="menu_haut">
<?php
if (count($tab_menuhaut))
{
  for ($i=0;$i<count($tab_menuhaut);$i++)
  {
    echo get_ref_output("type:a@@url:".$tab_menuhaut[$i]["url"]."@@class:menu_haut@@text:".$tab_menuhaut[$i]["name"]."@@alt:".$tab_menuhaut[$i]['accroche']."@@title:".$tab_menuhaut[$i]['accroche']);
    if ($i != (count($tab_menuhaut)-1)) echo ' | ';
  }
}
?>
        &nbsp;</td> 
       </tr> 
      </table>
     </td> 
    </tr>
<?php
$l_flag = "";
if ($ref->template) $l_flag = "?flag=".$ref->template;
?>
    <tr> 
     <td height="40" bgcolor="#000000"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="770" height="40"> 
       <param name="movie" value="<?=$g_mediapath?>/menu.swf<?=$l_flag?>"> 
       <param name="quality" value="high"> 
       <embed src="<?=$g_mediapath?>/menu.swf<?=$l_flag?>" width="770" height="40" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed> 
      </object>
     </td> 
    </tr> 
