<div id="box">
		<h3>Remplissez ce simple formulaire</h3>

<form id="box" name="form1" method="post" action="comparateur-mutuelle.php?Fiche=1" onsubmit="return validateFormOnSubmit(this)">
<fieldset>
 <?php
	  if (isset($_POST['REGIME']))
{
	$clt=new Client($_POST['NOM'],$_POST['PRENOM']
							,$_POST['JOUR']."-".$_POST['MOIS']."-".$_POST['ANNEE']
							,$_POST['ENFANTS'],$_POST['SEXE'],$_POST['COUPLE']
							,$_POST['REGIME']
							,substr($_POST['CP'],0,2),'','','','','','','','');
							?>
		<input name="SEXE" type="hidden" id="SEXE" value="<?php echo $clt->sexe ?>"  />
          <input name="JOUR" type="hidden" id="JOUR"  value="<?php echo $_POST['JOUR'] ?>"  />
		  <input name="MOIS" type="hidden" id="MOIS"  value="<?php echo $_POST['MOIS'] ?>"  />
		  <input name="ANNEE" type="hidden" id="ANNEE"  value="<?php echo $_POST['ANNEE'] ?>"  />
		  
		  <input name="REGIME" type="hidden" id="REGIME" value="<?php echo $clt->regime ?>" />
		  <input name="CP" type="hidden" id="CP" value="<?php echo $_POST['CP'] ?>" />
		  <input name="ENFANTS" type="hidden" id="ENFANTS" value="<?php echo $_POST['ENFANTS'] ?>" />	
		  <input name="COUPLE" type="hidden" id="COUPLE" value="<?php echo $_POST['COUPLE'] ?>" />
							<?php
							
		if($clt->couple=="couple"){
		$conj=new Conjoint($_POST['NOMC'],$_POST['PRENOMC'],$_POST['JOURC']."-".$_POST['MOISC']."-".$_POST['ANNEEC']
								,($_POST['SEXE']=="homme"?"femme":"homme")
								,$_POST['REGIMEC']);
		$clt->conj=$conj;
		?>
		  <input name="REGIMEC" type="hidden" id="REGIMEC" value="<?php echo $_POST['REGIMEC'] ?>" />
		  <input name="ANNEEC" type="hidden" id="ANNEEC" value="<?php echo $conj->naiss ?>" />
		  <input name="NOMC" type="hidden" id="NOMC" value="<?php echo $_POST['NOMC'] ?>" />
		  <input name="PRENOMC" type="hidden" id="PRENOMC" value="<?php echo $_POST['PRENOMC'] ?>" />
		<?php
		
	}
	else
		$clt->conj=NULL;
		
		$_SESSION["client"]=serialize($clt);
}		
		
	  ?>
<ul><li>

<label class="color_bl_t">Vos Informations Personnelles :</label><span class="clearfix"></span></li>
<li>
<label>Nom : </label><input class="box" name="NOM" id="NOM" type="text"/></li>
<li><label>Prénom : </label><input class="box" name="PRENOM" id="PRENOM" type="text"/></li>
<li><label>Email : </label><input class="box" name="EMAIL" id="EMAIL" type="text"/></li>
<li><label>Tel : </label><input class="box" name="TELEPHONE" id="TELEPHONE" type="text"/></li>
</ul>
</fieldset>
<input class="boximg" type="image" src="images/etap3.jpg" /> 

</form>
</div>
