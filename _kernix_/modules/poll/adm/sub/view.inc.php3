<?php

$l_sql = "SELECT * FROM $table_poll WHERE idpoll = '$p_idpoll' ";
$c_db->query($l_sql);
$poll = $c_db->object_result();

?>

<form method=post action="<?php print($PHP_SELF); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_idpoll" value="<?php print($poll->idpoll); ?>">
   <tr>
    <td align=left class=color1 width=70% colspan=4 height=20>
      :: vote [<?php print($poll->idpoll); ?>] &nbsp; 
      < <font style="font-weight: normal;"><?php print($poll->nbclick); ?> click(s)</font> >
    </td> 
   </tr>
   <tr>
    <td align=right class=color2 width=20%>nom du vote &nbsp;</td> 
    <td class=color3 colspan=3>
     &nbsp;<input type=text name="p_name" class=text value="<?php print($poll->name); ?>">
    </td>
   </tr>
   <tr>
    <td align=right class=color2>label &nbsp;</td> 
    <td class=color3 colspan=3>
     &nbsp;<input type=text name="p_label" size=60 class=text value="<?php print($poll->label); ?>">
    </td>
   </tr>

<?php
for ($i=1;$i<=$l_nboptions;$i++)
{
  if ($c_db->result(0,nbclick)==0) $l_nbc=1; else $l_nbc=$c_db->result(0,nbclick); 
  print("<tr><td align=right class=color2>option $i&nbsp;</td><td class=color3>\n");
  print("&nbsp;<input type=text name=p_option$i size=40 class=text value=\"" . $c_db->result(0,"option$i") . "\" >\n");
  print("</td><td align=center class=listlight>\n");
  
  if ($c_db->result(0,"option$i"))
  {$l_n = $c_db->result(0,"nbclick$i") / $l_nbc*100;printf("%.2f",$l_n);print(" %");}
  print("</td>\n");
  if ($c_db->result(0,"option$i"))
  {
    print("<td class=main align=middle>");
    print("<a href=$PHP_SELF?p_pollaction=listpollvis&p_idpoll=$p_idpoll&p_option=$i class=truelink title=\"detail des clicks pour l'option $i\">");
    print("<img src=/pictures/poll/msg.gif border=0>");
    print("</a></td></tr>\n");
  }
  else
  print("<td class=main>&nbsp;</td></tr>\n");
}
?>
   <tr>
    <td align=right valign=top class=main>
     <input type="checkbox" name="p_viewflag" value="1" <?php if ($poll->viewflag == 1) print("CHECKED"); ?>>
    </td> 
    <td class=main colspan=3> résultats visibles en ligne</td>
   </tr>
  </table> 

<br>
 <input type=hidden name=p_idpoll value="<?php print("$poll->idpoll"); ?>">
 <select name=p_pollaction>
  <option value=store SELECTED>-- enregistrer les modifications --</option>
  <option value=delete>-- supprimer ce vote --</option>
  <option value=reset>-- remettre à zéro --</option>
 </select>
 <input type=submit value=executer class=button>
</form>

<?php show_back(); ?>





