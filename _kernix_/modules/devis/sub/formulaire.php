<?php require_once('Connections/cnx.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_cnx, $cnx);
$query_rsRegime = "SELECT * FROM vw_regimes order by NREGIME";
$rsRegime = mysql_query($query_rsRegime, $cnx) or die(mysql_error());
$row_rsRegime = mysql_fetch_assoc($rsRegime);
$totalRows_rsRegime = mysql_num_rows($rsRegime);
$year_17  = (int)(date("Y")-17);
$year_100  = (int)(date("Y")-100);
?>

<link href="_kernix_/modules/devis/sub/css/forms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function verif_cp() {
  if (document.form1.CP.value == "") {
     alert('Veuillez sélectionner votre département SVP');
     return false;
  } else {
     return true;
  }
  return false;
 }
</script>

<div id="cmpForm">
  <form id="form1" name="form1" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">
<input type="hidden" name="p_devisaction" value="etape">
<input type="hidden" name="p_devissubaction" value="next">
<input type="hidden" name="p_etape" value="<?=$p_etape?>">
    <fieldset id="demandeur">
    <legend>Vous </legend>
      <p>
          <input name="NOM" type="hidden" id="NOM" value="testeur nom" />
          <input name="PRENOM" type="hidden" id="PRENOM" value="testeur prenom" />
        <label>Sexe :</label>
        <label>
          <input name="SEXE" type="radio" id="sexe" value="homme" checked="checked" />
        Homme</label>
        <label>
          <input type="radio" name="SEXE" id="sexe2" value="femme" />
        Femme</label>
      </p>
      <p>
       <label>Date de naissance : </label>
         <select name="JOUR" id="JOUR">
         <?php for($i=1;$i<=31;$i++){
			 	if($i<10)$i="0".$i;
			 ?>
           <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php }?>
         </select>
         /
         <select name="MOIS" id="MOIS">
         <?php for($i=1;$i<=12;$i++){
			 	if($i<10)$i="0".$i;
			 ?>
           <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php }?>
         </select>
         /
         <select name="ANNEE" id="ANNEE">
           <?php for($i=$year_17;$i>=$year_100;$i--){ ?>
           <option value="<?php echo $i;?>"><?php echo $i;?></option>
           <?php }?>
         </select>
      </p>
      <p>
        <label> Votre r&eacute;gime social :
          <select name="REGIME" id="REGIME">
            <?php
do {
?>
            <option value="<?php echo $row_rsRegime['NREGIME']?>"><?php echo htmlentities($row_rsRegime['REGIME']);?></option>
            <?php
} while ($row_rsRegime = mysql_fetch_assoc($rsRegime));
  $rows = mysql_num_rows($rsRegime);
  if($rows > 0) {
      mysql_data_seek($rsRegime, 0);
	  $row_rsRegime = mysql_fetch_assoc($rsRegime);
  }
?>
          </select>
        </label>
      </p>
    </fieldset>
    <fieldset id="coord">
      <legend>Vos coordonn&eacute;es</legend>


        <input name="EMAIL" type="hidden" id="EMAIL" value="klk1@yaho.como" />


        <input name="TEL" type="hidden" id="TEL" value="012232155235" />

		<p>
      <label>D&eacute;partement :
        <select name="CP" id="CP">
<option value="">Departement</option>
					<option value="01">01 Ain</option>
					<option value="02">02 Aisne</option>
					<option value="03">03 Allier</option>
					<option value="04">04 Alpes-Haute-Provence</option>
					<option value="05">05 Hautes-Alpes</option>
					<option value="06">06 Alpes-Maritimes</option>
					<option value="07">07 Ard&#232;che</option>
					<option value="08">08 Ardennes</option>
					<option value="09">09 Ari&#232;ge</option>
					<option value="10">10 Aube</option>
					<option value="11">11 Aude</option>
					<option value="12">12 Aveyron</option>
					<option value="13">13 Bouches-du-Rh&#244;ne</option>
					<option value="14">14 Calvados</option>
					<option value="15">15 Cantal</option>
					<option value="16">16 Charente</option>
					<option value="17">17 Charente-Maritime</option>
					<option value="18">18 Cher</option>
					<option value="19">19 Corr&#232;ze</option>
					<option value="20">2A Corse-du-Sud</option>
					<option value="20">2B Haute-Corse</option>
					<option value="21">21 C&#244;te-d'Or</option>
					<option value="22">22 C&#244;tes-d'Armor</option>
					<option value="23">23 Creuse</option>
					<option value="24">24 Dordogne</option>
					<option value="25">25 Doubs</option>
					<option value="26">26 Dr&#244;me</option>
					<option value="27">27 Eure</option>
					<option value="28">28 Eure-et-Loir</option>
					<option value="29">29 Finist&#232;re</option>
					<option value="30">30 Gard</option>
					<option value="31">31 Haute-Garonne</option>
					<option value="32">32 Gers</option>
					<option value="33">33 Gironde</option>
					<option value="34">34 H&#233;rault</option>
					<option value="35">35 Ille-et-Vilaine</option>
					<option value="36">36 Indre</option>
					<option value="37">37 Indre-et-Loire</option>
					<option value="38">38 Is&#232;re</option>
					<option value="39">39 Jura</option>
					<option value="40">40 Landes</option>
					<option value="41">41 Loir-et-Cher</option>
					<option value="42">42 Loire</option>
					<option value="43">43 Haute-Loire</option>
					<option value="44">44 Loire-Atlantique</option>
					<option value="45">45 Loiret</option>
					<option value="46">46 Lot</option>
					<option value="47">47 Lot-et-Garonne</option>
					<option value="48">48 Loz&#232;re</option>
					<option value="49">49 Maine-et-Loire</option>
					<option value="50">50 Manche</option>
					<option value="51">51 Marne</option>
					<option value="52">52 Haute-Marne</option>
					<option value="53">53 Mayenne</option>
					<option value="54">54 Meurthe-et-Moselle</option>
					<option value="55">55 Meuse</option>
					<option value="56">56 Morbihan</option>
					<option value="57">57 Moselle</option>
					<option value="58">58 Ni&#232;vre</option>
					<option value="59">59 Nord</option>
					<option value="60">60 Oise</option>
					<option value="61">61 Orne</option>
					<option value="62">62 Pas-de-Calais</option>
					<option value="63">63 Puy-de-D&#244;me</option>
					<option value="64">64 Pyr&#233;n&#233;es-Atlantiques</option>
					<option value="65">65 Hautes-Pyr&#233;n&#233;es</option>
					<option value="66">66 Pyr&#233;n&#233;es-Orientales</option>
					<option value="67">67 Bas-Rhin</option>
					<option value="68">68 Haut-Rhin</option>
					<option value="69">69 Rh&#244;ne</option>
					<option value="70">70 Haute-Sa&#244;ne</option>
					<option value="71">71 Sa&#244;ne-et-Loire</option>
					<option value="72">72 Sarthe</option>
					<option value="73">73 Savoie</option>
					<option value="74">74 Haute-Savoie</option>
					<option value="75">75 Paris</option>
					<option value="76">76 Seine-Maritime</option>
					<option value="77">77 Seine-et-Marne</option>
					<option value="78">78 Yvelines</option>
					<option value="79">79 Deux-S&#232;vres</option>
					<option value="80">80 Somme</option>
					<option value="81">81 Tarn</option>
					<option value="82">82 Tarn-et-Garonne</option>
					<option value="83">83 Var</option>
					<option value="84">84 Vaucluse</option>
					<option value="85">85 Vend&#233;e</option>
					<option value="86">86 Vienne</option>
					<option value="87">87 Haute-Vienne</option>
					<option value="88">88 Vosges</option>
					<option value="89">89 Yonne</option>
					<option value="90">90 Territoire de Belfort</option>
					<option value="91">91 Essonne</option>
					<option value="92">92 Hauts-de-Seine</option>
					<option value="93">93 Seine-Saint-Denis</option>
					<option value="94">94 Val-de-Marne</option>
					<option value="95">95 Val-d'Oise</option>
					<option value="97">971 Guadeloupe</option>
					<option value="97">972 Martinique</option>
					<option value="97">973 Guyane</option>
					<option value="97">974 R&#233;union</option>
					<option value="97">975 Saint-Pierre-et-Mi.</option>
					<option value="98">984 Terres aust. &amp; antar.</option>
					<option value="98">985 Mayotte</option>
					<option value="98">986 Wallis-et-Futuna</option>
					<option value="98">987 Polyn&#233;sie fran&#231;aise</option>
					<option value="98">988 Nouvelle-Cal&#233;donie</option>
					<option value="99">99  Etranger</option>
					<option value="97">97 DOM TOM </option>
        </select>
      </label>
      </p>
    </fieldset>
    <fieldset>
      <legend>Votre famille</legend>
       <p>
        <label>Nombre des <strong>enfants mineurs</strong> &aacute; assurer :
          <select name="ENFANTS" id="ENFANTS">
            <option value="0" selected="selected">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3 ou +</option>
          </select>
        </label>
      </p>
      <p><label>Souhaitez-vous inscrire un conjoint ?</label>&nbsp;
        <label>
<input type="radio" name="COUPLE" id="COUPLE" value="couple" onclick="document.getElementById('conjoint').style.display='block'" />
Oui</label>
        <label>
          <input name="COUPLE" type="radio" id="radio" value="seul" checked="checked" onclick="document.getElementById('conjoint').style.display='none'" />
          Non</label>
      </p>

    <div id="conjoint" style="display:none;">

          <p>
            <input type="hidden" name="NOMC" id="NOMC" value="nom conj" />
            <input type="hidden" name="PRENOMC" id="PRENOMC" value="prenom conj" />

            <label> Ann&eacute;e de naissance :
			  <select name="JOURC" id="JOURC">
         <?php for($i=1;$i<=31;$i++){
			 	if($i<10)$i="0".$i;
			 ?>
           <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php }?>
         </select>
         /
         <select name="MOISC" id="MOISC">
         <?php for($i=1;$i<=12;$i++){
			 	if($i<10)$i="0".$i;
			 ?>
           <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php }?>
         </select>
         /
              <select name="ANNEEC" id="ANNEEC">
                <?php for($i=$year_17;$i>=$year_100;$i--){ ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
              </select>
            </label>
&nbsp;  </p>
          <p>
            <label>r&eacute;gime social :
              <select name="REGIMEC" id="REGIMEC">
                <?php
					do {
				?>
                <option value="<?php echo $row_rsRegime['NREGIME']?>"><?php echo htmlentities($row_rsRegime['REGIME']);?></option>
                <?php
				} while ($row_rsRegime = mysql_fetch_assoc($rsRegime));
				  $rows = mysql_num_rows($rsRegime);
				  if($rows > 0) {
					  mysql_data_seek($rsRegime, 0);
					  $row_rsRegime = mysql_fetch_assoc($rsRegime);
				  }
				?>
              </select>
            </label>
          </p>
    </div>

    </fieldset>
    <p>
    <input name="envoyer" type="submit" value="comparer les tarifs" onclick='Javascript: return verif_cp();'/>
    </p>
  </form>
</div>

<?php
mysql_free_result($rsRegime);
?>