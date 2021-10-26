<div id="box"><h3>Remplissez ce simple formulaire : </h3>
<div class="clear"></div>
<form id="box" method ="post" action="confirmation-souscription.php" onsubmit="return validate()">
<?php 
if (isset($_GET['idDevis'])) 
{
mysql_select_db($database_cnx, $cnx);
$idDevis=$_GET['idDevis'];
$query_rsDevis = sprintf("SELECT * FROM vw_devis where ndevis=$idDevis");
$rsDevis = mysql_query($query_rsDevis, $cnx) or die(mysql_error());
$row_rsDevis = mysql_fetch_assoc($rsDevis);
 do {
 $nbrenfants = $row_rsDevis['nbrEnfant']; 
 ?>
<div class="resume">Vous avez choisi la formule <span>
<?php echo $row_rsDevis['nomfrml']; ?></span> de la gamme <span><?php echo $row_rsDevis['nomgam']; ?></span> de la compagnie <span><?php echo $row_rsDevis['nomcmp']; ?></span> . Votre cotisation mensuelle pour cette formule est de <span><?php echo $row_rsDevis['tarifs']; ?> €/ mois</span> .</div>

<fieldset>
<legend >Informations du souscripteur: </legend>
<ul><li>
<label>Adresse : </label>
<input name="idDevis" type="hidden" id="idDevis" value="<?php echo $_GET['idDevis'] ?>" />
<input name="nbrenfants" type="hidden" id="nbrenfants" value="<?php echo $nbrenfants;?>" />
<input class="box" name="ADRESSE" id="ADRESSE" type="text"/></li>
<li><label>Code postal : </label><input class="box" name="CODEPOSTAL" id="CODEPOSTAL" type="text"/></li>
<li><label>Ville : </label><input class="box" name="VILLE" id="VILLE" type="text"/></li>
<li><label>Tel : </label><input class="box" name="TEL" id="TEL" type="text" value="<?php echo $row_rsDevis['tel']; ?>" /></li>
<li><label>Email : </label><input  style="width:180px" class="box" name="EMAIL" id="EMAIL" type="text" value="<?php echo $row_rsDevis['email']; ?>" /></li>

</ul>
</fieldset>
<fieldset>
<legend >Coordonnées : </legend>
<ul>
<li><label>Nom : </label><input class="box" name="NOM"  id="NOM" type="text" value="<?php echo $row_rsDevis['NomProspect']; ?>" /></li>
<li><label>Prénom : </label><input class="box" name="PRENOM" id="PRENOM" value="<?php echo $row_rsDevis['PrenomProspet']; ?>" type="text"/></li>
<li>
<label>Sexe : </label><input disabled="disabled" style="width:60px" class="box" name="sexe" id="sexe" type="text" value="<?php echo $row_rsDevis['sexeProspet']; ?>" /></li>

<li><label>Date de naissance :</label>
<input disabled="disabled" style="width:70px" class="box" name="dateNaissance" type="text" value="<?php echo $row_rsDevis['dateNaissance']; ?>"/>
</li>

<li><label>Régime : </label> <input style="width:130px" class="box" name="regime" type="text" value="<?php echo htmlentities($row_rsDevis['nomRegime']); ?>" /></li>
			<li><label>Numéro de sécurité sociale :</label><input style="width:7px" class="box" name="T1" id="T1" type="text"/> <input style="width:15px" class="box" name="T2" id="T2" type="text"/> <input style="width:15px" class="box" name="T3" id="T3" type="text" /> <input style="width:15px" class="box" name="T4" id="T4" type="text"/> <input style="width:22px" class="box" name="T5" id="T5" type="text"/> <input style="width:22px" class="box" name="T6"  id="T6" type="text"/> <input style="width:15px" class="box" name="T7" id="T7"  type="text"/></li>
<li><label class="exemple">Exemple de numéro de SC :</label><input disabled="disabled" style="width:7px" class="box" name="Te" type="text" value="1"/> <input disabled="disabled" style="width:15px" class="box" name="T2e" type="text" value="23"/> <input disabled="disabled" style="width:15px" class="box" name="T3e" type="text" value="45"/> <input disabled="disabled" style="width:15px" class="box" name="T4e" type="text"  value="67"/> <input disabled="disabled" style="width:22px" class="box" name="T5e" type="text" value="789" /> <input disabled="disabled" style="width:22px" class="box" name="T6e" type="text" value="658"/> <input disabled="disabled" style="width:15px" class="box" name="T7e" type="text" value="13"/></li>


</ul>

</fieldset>
<?php 

if($row_rsDevis['coupleProspet']=="couple")
{
?>
<fieldset>
<legend >Coordonnées Conjoint: </legend>
<ul>
<li><label>Nom  : </label><input class="box" name="NOMConj"  id="NOMConj" type="text"  /></li>
<li><label>Prénom  : </label><input class="box" name="PRENOMConj"  id="PRENOMConj" type="text"  /></li>
<li><label>Date Naissance  : </label><input disabled="disabled" class="box" name="DateConj"  id="DateConj" type="text" value="<?php echo $row_rsDevis['dateNaissanceConj'] ?>" /></li>
<li><label>Numéro de sécurité sociale :</label><input style="width:7px" class="box" name="TC1" id="TC1" type="text"/> <input style="width:15px" class="box" name="TC2" id="TC2" type="text"/> <input style="width:15px" class="box" name="TC3" id="TC3" type="text" /> <input style="width:15px" class="box" name="TC4" id="TC4" type="text"/> <input style="width:22px" class="box" name="TC5" id="TC5" type="text"/> <input style="width:22px" class="box" name="TC6"  id="TC6" type="text"/> <input style="width:15px" class="box" name="TC7" id="TC7"  type="text"/></li>
<li><label class="exemple">Exemple de numéro de SC :</label><input disabled="disabled" style="width:7px" class="box" name="Te" type="text" value="1"/> <input disabled="disabled" style="width:15px" class="box" name="T2e" type="text" value="23"/> <input disabled="disabled" style="width:15px" class="box" name="T3e" type="text" value="45"/> <input disabled="disabled" style="width:15px" class="box" name="T4e" type="text"  value="67"/> <input disabled="disabled" style="width:22px" class="box" name="T5e" type="text" value="789" /> <input disabled="disabled" style="width:22px" class="box" name="T6e" type="text" value="658"/> <input disabled="disabled" style="width:15px" class="box" name="T7e" type="text" value="13"/></li>
<li>

<label>Sexe : </label><input style="width:60px" class="box" name="sexeConj" id="sexeConj" type="text" value="<?php echo $row_rsDevis['sexeConjoint'] ?>" /></li>

</ul>
</fieldset>
<?php 
}
} while ($row_rsDevis = mysql_fetch_assoc($rsDevis)); 
?>

<fieldset>
<?php 
if($nbrenfants>0)
{
for ( $i=0;$i<$nbrenfants;$i++)
{
?>
<legend >Coordonnées Enfant <?php echo $i+1; ?> : </legend>
<ul>
<li><label>Nom enfant <?php echo $i+1; ?>  : </label><input class="box" name="NOMenfant<?php echo $i+1; ?>"  id="NOMenfant<?php echo $i+1; ?>" type="text"  /></li>
<li><label>Prénom enfant <?php echo $i+1; ?>  : </label><input class="box" name="PRENOMenfant<?php echo $i+1; ?>"  id="PRENOMenfant<?php echo $i+1; ?>" type="text"  /></li>
<li><label>Date Naissance enfant <?php echo $i+1; ?>  : </label><input class="box" name="DATEenfant<?php echo $i+1; ?>"  id="DATEenfant<?php echo $i+1; ?>" type="text"  /></li>
</ul>
<?php 
}
}
?>
</fieldset>

<fieldset>

<legend >&nbsp;Informations de paiement : </legend>

<ul>
<li><label>Nom de la banque :   </label><input class="box" name="NOMBonq"  id="NOMBonq" type="text"  /></li>
<li><label>Adresse de la Banque  : </label><input class="box" name="ADRBonq"  id="ADRBonq" type="text"  /></li>

</ul>

<table style="text-align:center;width: 100%;font-size:16px;" cellpadding="0" cellspacing="0" >
	<tr>
		<td><label>Code Banque </label></td>
		<td>Code Guichet </td>
		<td>Numéro De Compte</td>
		<td>Clé </td>
	</tr>
	<tr>
		<td><input style="width:35px" class="box" name="NUMERODECOMPTE1" id="NUMERODECOMPTE1" type=""/></td>
		<td><input style="width:35px" class="box" name="NUMERODECOMPTE2" id="NUMERODECOMPTE2" type=""/></td>
		<td><input style="width:79px" class="box" name="NUMERODECOMPTE3" id="NUMERODECOMPTE3"type=""/></td>
		<td><input style="width:15px" class="box" name="NUMERODECOMPTE4" id="NUMERODECOMPTE4" type=""/></td>
	</tr>
	<tr>
		<td><input disabled="disabled" style="width:35px" class="box" name="NUMERODECOMPTE" type="" value="12345"/></td>
		<td><input disabled="disabled" style="width:35px" class="box" name="NUMERODECOMPTE" type="" value="12345"/></td>
		<td><input disabled="disabled" style="width:79px" class="box" name="NUMERODECOMPTE" type="" value="12345678912"/></td>
		<td><input disabled="disabled" style="width:15px" class="box" name="NUMERODECOMPTE" type="" value="12"/></td>
	</tr>

	
</table>
<div class="clear" style="padding-top: 20px">
		</div>

<ul>
			<li><label>Mode de paiement: </label><select name="TYPEPRELEVEMENT" id="TYPEPRELEVEMENT" onchange="changePaiment()">
			
			<option value="Prelevement">Par Prélèvement</option>
			<option value="cheque">Par chéque</option>
			</select></li>
			<li id="trCheque" style="visibility:hidden"><label>Par chéque : </label><select name="TYPEPRELEVEMENT">
			<option>----------</option>
			<option>Tous les 3 mois</option>
			<option>Tous les 6 mois</option>
			<option>Tous les 12 mois</option>
			</select></li>
			<li id="trPre"><label>Date de Prélèvement : </label>
			<select name="datePre" id="datePre">
			<option>1 er  de mois</option>
			<option>10 du mois</option>
			</select></li>
			<li><label>Date d&#39;effet : </label>
			<input id="dateEffect" class="box" name="dateEffect" size="20" style="width:100px" type="" />
			<img alt="" src="images/bt_calendar.png" /></li>
		</ul>

<div class="note"><strong><input name="Checkbox1" type="checkbox" id="Checkbox1" />&nbsp; En cochant cette case,</strong> je reconnais avoir pris connaissance et accepté les<strong> <a  style="color:red" href="condition.html?iframe=true&width=430&height=520" rel="prettyPhoto[iframes]" class="button">conditions générales</a></strong> de vente de Sinader. </div>

</fieldset>

<input class="boximg" type="image" src="images/valider.jpg"  /> 

</form>
</div>
<?php
		mysql_free_result($rsDevis);
		}
		?>