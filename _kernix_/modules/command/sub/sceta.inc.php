<LINK HREF="<?php print("$g_skinpath/$g_skin/caddie"); ?>.css" REL="stylesheet" TYPE="text/css">

<form name="annuler" method="post" action="/?p_idref=730">
<input type="hidden" name="p_parc" value="<?=$p_parc?>">
<input type="hidden" name="p_poche" value="<?=$p_poche?>">
<input type="hidden" name="p_fromref" value="730">
<input type="hidden" name="p_caddiecookieaction" value="empty">
</form>

<?php
if ($p_za)
{
   $g_zaname = " ::COMMAND:: $p_commandaction";
   include("$g_modulespath/command/sub/_top.inc.php3");
   include("$g_modulespath/command/sub/index.inc.php3");
   include("$g_modulespath/command/sub/_bottom.inc.php3");
}
else
{
?>
<?php

if ($l_etape == 2)
{
   $g_zaname = " ::COMMAND:: confirmation";
   include("$g_modulespath/command/sub/_top.inc.php3");
   include("$g_modulespath/command/sub/sceta_".$l_etape.".inc.php");
   include("$g_modulespath/command/sub/_bottom.inc.php3");
}
else
{
  $l_tab = get_pocheresa($p_poche);
  $p_parc = $l_tab["idparc"];

  $l_month = date('m');
  $l_year = date('Y');
  $l_day = date('d');
  $l_heure = date('G');

  if ($p_fromparc != 1)
  {
    $fin_mois = $deb_mois = $l_month;
    $fin_jour = $deb_jour = $l_day;
    $fin_heure = $deb_heure = $l_heure;
  }
  
  $g_zaname = " ::COMMAND:: reservation";
  include("$g_modulespath/command/sub/_top.inc.php3");
?>

<form name="resa" id="resa" method="post" action="/?p_idref=728">
 <input type="hidden" name="p_etape"	value="<?=($l_etape+1)?>">
 <input type="hidden" name="p_parc"	value="<?=$l_tab["idparc"]?>">
 <input type="hidden" name="p_poche"	value="<?=$l_tab["idpoche"]?>">
 <input type="hidden" name="fin_min"	value="00">

 <p class="txt_n_arial_black"><?=$msg?>&nbsp;&nbsp;Parking : <span class="txt_n_arial_black_b"><?=$l_tab["libelle"]?></span></p>

 <p class="txt_n_arial_black">&nbsp;&nbsp;Date et heure d'entr&eacute;e :<br>
  &nbsp;&nbsp;<select name="deb_jour" class="txt_n_arial_black" id="deb_jour">
                      <option value=01>01</option>
                      <option value=02<?php echo ($deb_jour == 2) ? " selected" : "" ;?>>02</option>
                      <option value=03<?php echo ($deb_jour == 3) ? " selected" : "" ;?>>03</option>
                      <option value=04<?php echo ($deb_jour == 4) ? " selected" : "" ;?>>04</option>
                      <option value=05<?php echo ($deb_jour == 5) ? " selected" : "" ;?>>05</option>
                      <option value=06<?php echo ($deb_jour == 6) ? " selected" : "" ;?>>06</option>
                      <option value=07<?php echo ($deb_jour == 7) ? " selected" : "" ;?>>07</option>
                      <option value=08<?php echo ($deb_jour == 8) ? " selected" : "" ;?>>08</option>
                      <option value=09<?php echo ($deb_jour == 9) ? " selected" : "" ;?>>09</option>
                      <option value=10<?php echo ($deb_jour == 10) ? " selected" : "" ;?>>10</option>
                      <option value=11<?php echo ($deb_jour == 11) ? " selected" : "" ;?>>11</option>
                      <option value=12<?php echo ($deb_jour == 12) ? " selected" : "" ;?>>12</option>
                      <option value=13<?php echo ($deb_jour == 13) ? " selected" : "" ;?>>13</option>
                      <option value=14<?php echo ($deb_jour == 14) ? " selected" : "" ;?>>14</option>
                      <option value=15<?php echo ($deb_jour == 15) ? " selected" : "" ;?>>15</option>
                      <option value=16<?php echo ($deb_jour == 16) ? " selected" : "" ;?>>16</option>
                      <option value=17<?php echo ($deb_jour == 17) ? " selected" : "" ;?>>17</option>
                      <option value=18<?php echo ($deb_jour == 18) ? " selected" : "" ;?>>18</option>
                      <option value=19<?php echo ($deb_jour == 19) ? " selected" : "" ;?>>19</option>
                      <option value=20<?php echo ($deb_jour == 20) ? " selected" : "" ;?>>20</option>
                      <option value=21<?php echo ($deb_jour == 21) ? " selected" : "" ;?>>21</option>
                      <option value=22<?php echo ($deb_jour == 22) ? " selected" : "" ;?>>22</option>
                      <option value=23<?php echo ($deb_jour == 23) ? " selected" : "" ;?>>23</option>
                      <option value=24<?php echo ($deb_jour == 24) ? " selected" : "" ;?>>24</option>
                      <option value=25<?php echo ($deb_jour == 25) ? " selected" : "" ;?>>25</option>
                      <option value=26<?php echo ($deb_jour == 26) ? " selected" : "" ;?>>26</option>
                      <option value=27<?php echo ($deb_jour == 27) ? " selected" : "" ;?>>27</option>
                      <option value=28<?php echo ($deb_jour == 28) ? " selected" : "" ;?>>28</option>
                      <option value=29<?php echo ($deb_jour == 29) ? " selected" : "" ;?>>29</option>
                      <option value=30<?php echo ($deb_jour == 30) ? " selected" : "" ;?>>30</option>
                      <option value=31<?php echo ($deb_jour == 31) ? " selected" : "" ;?>>31</option>
                    </select>
                    <select name="deb_mois" class="txt_n_arial_black" id="deb_mois">
                      <option value=01>Janvier</option>
                      <option value=02<?php echo ($deb_mois == 2) ? " selected" : "" ;?>>F&eacute;vrier</option>
                      <option value=03<?php echo ($deb_mois == 3) ? " selected" : "" ;?>>Mars</option>
                      <option value=04<?php echo ($deb_mois == 4) ? " selected" : "" ;?>>Avril</option>
                      <option value=05<?php echo ($deb_mois == 5) ? " selected" : "" ;?>>Mai</option>
                      <option value=06<?php echo ($deb_mois == 6) ? " selected" : "" ;?>>Juin</option>
                      <option value=07<?php echo ($deb_mois == 7) ? " selected" : "" ;?>>Juillet</option>
                      <option value=08<?php echo ($deb_mois == 8) ? " selected" : "" ;?>>Ao&ucirc;t</option>
                      <option value=09<?php echo ($deb_mois == 9) ? " selected" : "" ;?>>Septembre</option>
                      <option value=10<?php echo ($deb_mois == 10) ? " selected" : "" ;?>>Octobre</option>
                      <option value=11<?php echo ($deb_mois == 11) ? " selected" : "" ;?>>Novembre</option>
                      <option value=12<?php echo ($deb_mois == 12) ? " selected" : "" ;?>>Décembre</option>
                    </select>
                    <select name="deb_annee" class="txt_n_arial_black" id="deb_annee">
                      <option value=<?=$l_year?>><?=$l_year?></option>
                      <option value=<?=($l_year+1)?><?php echo ($deb_annee == ($l_year+1)) ? " selected" : "" ;?>><?=($l_year+1)?></option>
                    </select>
                    <img src="/upload/pictures/p.gif" width="1" height="18">&nbsp;&agrave; <select name="deb_heure" class="txt_n_arial_black" id="deb_heure">
                      <option value=00>00</option>
                      <option value=01<?php echo ($deb_heure == 1) ? " selected" : "" ;?>>01</option>
                      <option value=02<?php echo ($deb_heure == 2) ? " selected" : "" ;?>>02</option>
                      <option value=03<?php echo ($deb_heure == 3) ? " selected" : "" ;?>>03</option>
                      <option value=04<?php echo ($deb_heure == 4) ? " selected" : "" ;?>>04</option>
                      <option value=05<?php echo ($deb_heure == 5) ? " selected" : "" ;?>>05</option>
                      <option value=06<?php echo ($deb_heure == 6) ? " selected" : "" ;?>>06</option>
                      <option value=07<?php echo ($deb_heure == 7) ? " selected" : "" ;?>>07</option>
                      <option value=08<?php echo ($deb_heure == 8) ? " selected" : "" ;?>>08</option>
                      <option value=09<?php echo ($deb_heure == 9) ? " selected" : "" ;?>>09</option>
                      <option value=10<?php echo ($deb_heure == 10) ? " selected" : "" ;?>>10</option>
                      <option value=11<?php echo ($deb_heure == 11) ? " selected" : "" ;?>>11</option>
                      <option value=12<?php echo ($deb_heure == 12) ? " selected" : "" ;?>>12</option>
                      <option value=13<?php echo ($deb_heure == 13) ? " selected" : "" ;?>>13</option>
                      <option value=14<?php echo ($deb_heure == 14) ? " selected" : "" ;?>>14</option>
                      <option value=15<?php echo ($deb_heure == 15) ? " selected" : "" ;?>>15</option>
                      <option value=16<?php echo ($deb_heure == 16) ? " selected" : "" ;?>>16</option>
                      <option value=17<?php echo ($deb_heure == 17) ? " selected" : "" ;?>>17</option>
                      <option value=18<?php echo ($deb_heure == 18) ? " selected" : "" ;?>>18</option>
                      <option value=19<?php echo ($deb_heure == 19) ? " selected" : "" ;?>>19</option>
                      <option value=20<?php echo ($deb_heure == 20) ? " selected" : "" ;?>>20</option>
                      <option value=21<?php echo ($deb_heure == 21) ? " selected" : "" ;?>>21</option>
                      <option value=22<?php echo ($deb_heure == 22) ? " selected" : "" ;?>>22</option>
                      <option value=23<?php echo ($deb_heure == 23) ? " selected" : "" ;?>>23</option>
                    </select>&nbsp;h
                    <select name="deb_min" class="txt_n_arial_black" id="deb_min">
                      <option value=00>00</option>
                      <option value=15<?php echo ($deb_min == 15) ? " selected" : "" ;?>>15</option>
                      <option value=30<?php echo ($deb_min == 30) ? " selected" : "" ;?>>30</option>
                      <option value=45<?php echo ($deb_min == 45) ? " selected" : "" ;?>>45</option>
                    </select>
</p>
<p>&nbsp;&nbsp;Date et heure de sortie :<br>
   &nbsp;&nbsp;<select name="fin_jour" class="txt_n_arial_black" id="fin_jour">
                      <option value=01>01</option>
                      <option value=02<?php echo ($fin_jour == 2) ? " selected" : "" ;?>>02</option>
                      <option value=03<?php echo ($fin_jour == 3) ? " selected" : "" ;?>>03</option>
                      <option value=04<?php echo ($fin_jour == 4) ? " selected" : "" ;?>>04</option>
                      <option value=05<?php echo ($fin_jour == 5) ? " selected" : "" ;?>>05</option>
                      <option value=06<?php echo ($fin_jour == 6) ? " selected" : "" ;?>>06</option>
                      <option value=07<?php echo ($fin_jour == 7) ? " selected" : "" ;?>>07</option>
                      <option value=08<?php echo ($fin_jour == 8) ? " selected" : "" ;?>>08</option>
                      <option value=09<?php echo ($fin_jour == 9) ? " selected" : "" ;?>>09</option>
                      <option value=10<?php echo ($fin_jour == 10) ? " selected" : "" ;?>>10</option>
                      <option value=11<?php echo ($fin_jour == 11) ? " selected" : "" ;?>>11</option>
                      <option value=12<?php echo ($fin_jour == 12) ? " selected" : "" ;?>>12</option>
                      <option value=13<?php echo ($fin_jour == 13) ? " selected" : "" ;?>>13</option>
                      <option value=14<?php echo ($fin_jour == 14) ? " selected" : "" ;?>>14</option>
                      <option value=15<?php echo ($fin_jour == 15) ? " selected" : "" ;?>>15</option>
                      <option value=16<?php echo ($fin_jour == 16) ? " selected" : "" ;?>>16</option>
                      <option value=17<?php echo ($fin_jour == 17) ? " selected" : "" ;?>>17</option>
                      <option value=18<?php echo ($fin_jour == 18) ? " selected" : "" ;?>>18</option>
                      <option value=19<?php echo ($fin_jour == 19) ? " selected" : "" ;?>>19</option>
                      <option value=20<?php echo ($fin_jour == 20) ? " selected" : "" ;?>>20</option>
                      <option value=21<?php echo ($fin_jour == 21) ? " selected" : "" ;?>>21</option>
                      <option value=22<?php echo ($fin_jour == 22) ? " selected" : "" ;?>>22</option>
                      <option value=23<?php echo ($fin_jour == 23) ? " selected" : "" ;?>>23</option>
                      <option value=24<?php echo ($fin_jour == 24) ? " selected" : "" ;?>>24</option>
                      <option value=25<?php echo ($fin_jour == 25) ? " selected" : "" ;?>>25</option>
                      <option value=26<?php echo ($fin_jour == 26) ? " selected" : "" ;?>>26</option>
                      <option value=27<?php echo ($fin_jour == 27) ? " selected" : "" ;?>>27</option>
                      <option value=28<?php echo ($fin_jour == 28) ? " selected" : "" ;?>>28</option>
                      <option value=29<?php echo ($fin_jour == 29) ? " selected" : "" ;?>>29</option>
                      <option value=30<?php echo ($fin_jour == 30) ? " selected" : "" ;?>>30</option>
                      <option value=31<?php echo ($fin_jour == 31) ? " selected" : "" ;?>>31</option>
                    </select>
                    <select name="fin_mois" class="txt_n_arial_black" id="fin_mois">
                      <option value=01>Janvier</option>
                      <option value=02<?php echo ($fin_mois == 2) ? " selected" : "" ;?>>F&eacute;vrier</option>
                      <option value=03<?php echo ($fin_mois == 3) ? " selected" : "" ;?>>Mars</option>
                      <option value=04<?php echo ($fin_mois == 4) ? " selected" : "" ;?>>Avril</option>
                      <option value=05<?php echo ($fin_mois == 5) ? " selected" : "" ;?>>Mai</option>
                      <option value=06<?php echo ($fin_mois == 6) ? " selected" : "" ;?>>Juin</option>
                      <option value=07<?php echo ($fin_mois == 7) ? " selected" : "" ;?>>Juillet</option>
                      <option value=08<?php echo ($fin_mois == 8) ? " selected" : "" ;?>>Ao&ucirc;t</option>
                      <option value=09<?php echo ($fin_mois == 9) ? " selected" : "" ;?>>Septembre</option>
                      <option value=10<?php echo ($fin_mois == 10) ? " selected" : "" ;?>>Octobre</option>
                      <option value=11<?php echo ($fin_mois == 11) ? " selected" : "" ;?>>Novembre</option>
                      <option value=12<?php echo ($fin_mois == 12) ? " selected" : "" ;?>>Décembre</option>
                    </select>
                    <select name="fin_annee" class="txt_n_arial_black" id="deb_annee">
                      <option value=<?=$l_year?>><?=$l_year?></option>
                      <option value=<?=($l_year+1)?><?php echo ($fin_annee == ($l_year+1)) ? " selected" : "" ;?>><?=($l_year+1)?></option>
                    </select>
                    <img src="/upload/pictures/p.gif" width="1" height="18">&nbsp;&nbsp;&agrave; <select name="fin_heure" class="txt_n_arial_black" id="fin_heure">
                      <option value=00>00</option>
                      <option value=01<?php echo ($fin_heure == 1) ? " selected" : "" ;?>>01</option>
                      <option value=02<?php echo ($fin_heure == 2) ? " selected" : "" ;?>>02</option>
                      <option value=03<?php echo ($fin_heure == 3) ? " selected" : "" ;?>>03</option>
                      <option value=04<?php echo ($fin_heure == 4) ? " selected" : "" ;?>>04</option>
                      <option value=05<?php echo ($fin_heure == 5) ? " selected" : "" ;?>>05</option>
                      <option value=06<?php echo ($fin_heure == 6) ? " selected" : "" ;?>>06</option>
                      <option value=07<?php echo ($fin_heure == 7) ? " selected" : "" ;?>>07</option>
                      <option value=08<?php echo ($fin_heure == 8) ? " selected" : "" ;?>>08</option>
                      <option value=09<?php echo ($fin_heure == 9) ? " selected" : "" ;?>>09</option>
                      <option value=10<?php echo ($fin_heure == 10) ? " selected" : "" ;?>>10</option>
                      <option value=11<?php echo ($fin_heure == 11) ? " selected" : "" ;?>>11</option>
                      <option value=12<?php echo ($fin_heure == 12) ? " selected" : "" ;?>>12</option>
                      <option value=13<?php echo ($fin_heure == 13) ? " selected" : "" ;?>>13</option>
                      <option value=14<?php echo ($fin_heure == 14) ? " selected" : "" ;?>>14</option>
                      <option value=15<?php echo ($fin_heure == 15) ? " selected" : "" ;?>>15</option>
                      <option value=16<?php echo ($fin_heure == 16) ? " selected" : "" ;?>>16</option>
                      <option value=17<?php echo ($fin_heure == 17) ? " selected" : "" ;?>>17</option>
                      <option value=18<?php echo ($fin_heure == 18) ? " selected" : "" ;?>>18</option>
                      <option value=19<?php echo ($fin_heure == 19) ? " selected" : "" ;?>>19</option>
                      <option value=20<?php echo ($fin_heure == 20) ? " selected" : "" ;?>>20</option>
                      <option value=21<?php echo ($fin_heure == 21) ? " selected" : "" ;?>>21</option>
                      <option value=22<?php echo ($fin_heure == 22) ? " selected" : "" ;?>>22</option>
                      <option value=23<?php echo ($fin_heure == 23) ? " selected" : "" ;?>>23</option>
                    </select>&nbsp;h <i>(approximative)</i>
</p>
<p>
Attention : vous disposez de deux heures à partir de l'heure d'entrée pour accéder à votre place réservée. Au delà, la place sera remise à la disposition de nos clients.
</p>
   <input type="submit" value="<?=$gl_nextstep?>" class="caddiebutton">
</form>

<?php
   include("$g_modulespath/command/sub/_bottom.inc.php3");
}
}
?>