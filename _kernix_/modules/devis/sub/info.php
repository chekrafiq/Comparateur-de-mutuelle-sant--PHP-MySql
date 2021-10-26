<?php
//session_start();
 require_once('Connections/cnx.php'); ?>
<?php include_once("inclusions/calsses.php");?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

if (!isset($_POST['REGIME']) && !isset($_SESSION["client"])) {
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
}//fin si pas formulaire et pas session

if ($_POST['CP']==""){
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
}//fin pas de CP sélectionné

?>

<link href="_kernix_/modules/devis/sub/css/forms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function verif_email() {
<!--
  var str = document.form1.EMAIL.value;
  var regexp = new RegExp("^[a-zA-Z0-9_\\-\\.]{3,}@[a-zA-Z0-9\\-_]{2,}\\.[a-zA-Z]{2,4}$", "g");

  if (!regexp.test(str)) {
    alert("Veuillez entrer votre adresse mail SVP");
    document.form1.EMAIL.focus();
    return false;
  }
  return true;
}
// -->
</script>

<div id="cmpForm">
  <form id="form1" name="form1" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">
<input type="hidden" name="p_devisaction" value="etape">
<input type="hidden" name="p_devissubaction" value="next">
<input type="hidden" name="p_etape" value="<?=$p_etape?>">
    <fieldset id="demandeur">
    <legend>Vos informations Personnelles </legend>
      <p>
	  <?php
	  if (isset($_POST['REGIME']))
{
	$clt=new Client($_POST['NOM'],$_POST['PRENOM']
							,$_POST['JOUR']."-".$_POST['MOIS']."-".$_POST['ANNEE']
							,$_POST['ENFANTS'],$_POST['SEXE'],$_POST['COUPLE']
							,$_POST['REGIME']
							,substr($_POST['CP'],0,2),'','');
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
      </p>
      <p>
       <label>NOM: </label>
         <input name="NOM" type="text" id="NOM" />
      </p>
      <p>
       <label>PRENOM:  </label>
         <input name="PRENOM" type="text" id="PRENOM" />
      </p>
     <p>
       <label>EMAIL:  </label>
         <input name="EMAIL" type="text" id="EMAIL" />
      </p>
	  <p>
       <label>T&eacute;lephone:  </label>
         <input name="telephone" type="text" id="telephone" />
      </p>
    </fieldset>
    <p>
    <input name="envoyer" type="submit" value="comparer les tarifs" onclick='Javascript: return verif_email();' />
    </p>
  </form>
</div>