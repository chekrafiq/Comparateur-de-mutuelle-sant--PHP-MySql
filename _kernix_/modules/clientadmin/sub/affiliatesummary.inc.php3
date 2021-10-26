<br>

<table bgcolor=#444F5F border=0 cellspacing=0 cellpadding=0 align=center width=70%>
 <tr><td>
 <table bgcolor=white border=0 cellspacing=2 cellpadding=1 width=100%>
   
   <tr>
    <td class="color2" align="center"  colspan="2" height=20>
     état de votre compte depuis le dernier paiement
    </td>
   </tr>
   <tr>
    <td class="color3" align="right" width=50%>
     nombre de commandes &nbsp;
    </td>
    <td class="list">
      &nbsp;<?php print("$affiliate->currentorder"); ?>
    </td>
   </tr>
    <tr>
    <td class="color3" align="right">
     valeur &nbsp;
    </td>
    <td class="list">
      &nbsp;<?php print("$affiliate->currentaccount"); ?>
    </td>
   </tr>
   <tr>
    <td class="color2" align="center"  colspan="2" height=20>
     url pour pointer sur ce site
    </td>
   </tr>
    <tr>
    <td class="list" align="center" colspan=2>
     <font style="COLOR: #444F5F; FONT-FAMILY: arial; FONT-SIZE: 10pt;"><?php print("$g_urldyn?p_idaffiliate=$affiliate->idaffiliate"); ?></font>
    </td>
   </tr>

 </table>
</td></tr></table>

<br><br>

<?php show_white_hr(); ?>
