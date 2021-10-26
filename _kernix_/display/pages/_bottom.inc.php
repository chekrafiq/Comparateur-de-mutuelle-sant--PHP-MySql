<?php $tab_menubas = get_tabsubref(8,"",""); ?>
    <tr> 
     <td height="20" bgcolor="#000000"><div align="center" class="menu_bas">
<?php
echo get_ref_output("type:a@@url:/?p_idref=2@@class:menu_bas@@text:Accueil@@alt:AssurSante@@title:Mutuelle en Ligne");
echo ' | ';
if (count($tab_menubas))
{
  for ($i=0;$i<count($tab_menubas);$i++)
  {
    echo get_ref_output("type:a@@url:".$tab_menubas[$i]["url"]."@@class:menu_bas@@text:".$tab_menubas[$i]["name"]."@@alt:".$tab_menubas[$i]['accroche']."@@title:".$tab_menubas[$i]['accroche']);
    echo ' | ';
  }
}
echo get_ref_output("type:a@@url:#top@@class:menu_bas@@text:Haut de page@@alt:AssurSante@@title:Mutuelle en Ligne");
echo ' <img src="'.$g_picturepath.'/top.gif">';
?>
      </div>
     </td> 
    </tr> 
   </table>
  </td> 
 </tr> 
</table>
