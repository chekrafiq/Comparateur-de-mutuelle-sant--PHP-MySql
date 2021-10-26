<?php 
	include('../../../../inc_dyn/gezip.php'); 
	include('../../../../inc_dyn/domain_config.php');
	//define('PATCH',"../../"); //patch of css and include file

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>SwissLife Habitation : Information</title>
<?php include_once('../../../../inc_meta/meta.php'); ?>

<link href="../../../../css/reset.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/screen.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/garantie.css" rel="stylesheet" type="text/css" />

<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="../../../../js/assu_script.js" type="text/javascript"></script>
<script src="../../../../js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script src="../../../../js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOMPRENOM);
		reason += validateEmail(theForm.EMAIL);
  		reason += validatePhone(theForm.TEL);
  		reason += validateNAISSANCE(theForm.NAISSANCE);
  		reason += validatePROFESSION(theForm.PROFESSION);
  		reason += validateADRESSE(theForm.ADRESSE);
  		reason += validateADRESSE2(theForm.ADRESSE2);
  		reason += validateCODEPOSTAL(theForm.CODEPOSTAL);
  		reason += validateVILLE(theForm.VILLE);
  		reason += validateNOMBREPIECE(theForm.NOMBREPIECE);
  		reason += validateDATECONTRAT(theForm.DATECONTRAT);
if (reason != "") {
    alert("Important :\n" + reason);
    return false;
					}
	return true;
}

function validateEmptyuser(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "1) Vous n'avez pas entré votre Nom &amp; Prénom !.\n";
    
    } else if (fld.value == "Votre Nom &amp; votre Prénom") {
        error = "1) Vous n'avez pas entré votre Nom &amp; Prénom !.\n";     
     } return error;  
}

function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
}

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\&lt;\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value == "") {
        error = "2) Vous n'avez pas entrer une adresse e-mail !\n";
    } else if (!emailFilter.test(tfld)) {              //test email for illegal characters
        error = "2) S'il vous plaît entrer une adresse email valide !\n";
    } else if (fld.value.match(illegalChars)) {
        error = "2) L'adresse e-mail contient des caractères illégaux !\n";
    } 
    return error;
}


function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "3) Vous n'avez pas entré votre numéro de téléphone.\n";
        
	} else if (fld.value == "Votre Numéro de Téléphone") {
        error = "3) Vous n'avez pas entré votre numéro de téléphone !.\n";     
    
    } else if (isNaN(stripped)) {
        error = "3) Le numéro de téléphone contient des caractères illégaux.\n";
               
        
    } else if (!(stripped.length == 10)) {
        error = "3) Le numéro de téléphone est erroné.\n";
       
    }
      else if ((stripped == "1111111111" || stripped == "2222222222" || stripped == "3333333333" || stripped == "4444444444" || stripped == "5555555555"  
     || stripped == "6666666666" || stripped == "7777777777" || stripped == "8888888888" || stripped == "9999999999"|| stripped == "0000000000"  
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  || stripped == "0101010101" || stripped == "0202020202" || stripped == "0303030303" || stripped == "0404040404" || stripped == "0505050505" || stripped == "0606060606" || stripped == "0707070707" || stripped == "0808080808" || stripped == "0909090909"
     || stripped == "0100000000" || stripped == "0200000000" || stripped == "0300000000" || stripped == "0400000000" || stripped == "0500000000" || stripped == "0600000000" || stripped == "0700000000" || stripped == "0800000000" || stripped == "0900000000")) {
        error = "3) S'il vous plaît entrer votre vrai numéro de téléphone .\n";
       
    }
    return error;
}

 function validateNAISSANCE(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "4) Vous n'avez pas entré votre date de naissance !.\n";
    
    } else if (fld.value == "Votre date de naissance") {
        error = "4) Vous n'avez pas entré  votre date de naissance !.\n";     
     } return error;  
}

 function validatePROFESSION(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "5) Vous n'avez pas entré Votre Profession exact !.\n";
    
    } else if (fld.value == "Votre Profession exact") {
        error = "5) Vous n'avez pas entré Votre Profession exact !.\n";     
     } return error;  
}

 function validateADRESSE(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "6) Vous n'avez pas entré Votre Adresse !.\n";
    
    } else if (fld.value == "Votre Adresse") {
        error = "6) Vous n'avez pas entré Votre Adresse !.\n";     
     } return error;  
}

 function validateADRESSE2(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "7) Vous n'avez pas entré Votre Complement d&#8217;adresse !.\n";
    
    } else if (fld.value == "Complement d&#8217;adresse") {
        error = "7) Vous n'avez pas entré Votre Complement d&#8217;adresse !.\n";     
     } return error;  
}

 function validateCODEPOSTAL(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "8) Vous n'avez pas entré Votre Code postal !.\n";
    
    } else if (fld.value == "Votre Code postal") {
        error = "8) Vous n'avez pas entré Votre Code postal !.\n";     
     } return error;  
}

 function validateVILLE(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "9) Vous n'avez pas entré Votre ville !.\n";
    
    } else if (fld.value == "Votre Ville") {
        error = "9) Vous n'avez pas entré Votre ville !.\n";     
     } return error;  
}

 function validateNOMBREPIECE(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "10) Vous n'avez pas entré le Nombre des pièces (hors cuisine)  !.\n";
    
    } else if (fld.value == "Nombre de pièces (hors cuisine)") {
        error = "10) Vous n'avez pas entré le Nombre des pièces (hors cuisine)  !.\n";     
     } return error;  
}

 function validateDATECONTRAT(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "11) Vous n'avez pas entré la Date effective du contrat  !.\n";
    
    } else if (fld.value == "Date effective du contrat") {
        error = "11) Vous n'avez pas entré la Date effective du contrat !.\n";     
     } return error;  
}

</script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<?php require_once('../../../../inc_file/header.php'); ?>
		<?php require_once('../../../../inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div  class="grid_2">
		<div id="menu_for_statique">
			<img alt="Assurance Habitation" src="../../../../images/perp.jpg" />
			<ul class="color_ver">
				<li><a title="Garanties" href="garantie-habitation-assurance.php">Garanties</a></li>
				<li><a title="Avantages" href="avantages-habitation-assurance.php">Avantages</a></li>
				<li><a title="Informations" href="information-habitation-assurance.php">Demande d'Informations</a></li>
				<li class="retour_ver"><a href="#">Retour</a></li>
			</ul>
		</div>
		</div>
	<div id="content" class="grid_5">
		<h1>Siwsslife , Habitation Assurance information</h1>
				<p>Si vous désirez, sans engagement de votre part, obtenir une information complète sur SwissLife Habitation, n’hésitez pas à remplir le formulaire suivant ou nous contacter :
</p>
				<div class="message_box_wrap notice">Si vous souhaitez obtenir plus d'informations, nous vous prions 
		de bien vouloir<strong style="color:red"> remplir ce formulaire</strong> afin que nous puissions 
					<em><strong>vous établir un devis gratuit et sans engagement</strong></em> : </div>
		<p>&nbsp;</p>
		<form method="post" action="../../../../control/info_habitation.php" onsubmit="return validateFormOnSubmit(this)">
	<fieldset class="p_l_r_100">
	<input value="Votre Nom &amp; votre Prénom" onblur="if(this.value=='') this.value='Votre Nom &amp; votre Prénom'" onfocus="if(this.value =='Votre Nom &amp; votre Prénom' ) this.value=''" id="NOMPRENOM" name="NOM" class="box w_250" type="text"/><input value="Votre valide E-Mail @" onblur="if(this.value=='') this.value='Votre valide E-Mail @'" onfocus="if(this.value =='Votre valide E-Mail @' ) this.value=''" id="EMAIL" name="EMAIL" class="box w_250" type="text"/><input  value="Votre Numéro de Téléphone" onblur="if(this.value=='') this.value='Votre Numéro de Téléphone'" onfocus="if(this.value =='Votre Numéro de Téléphone' ) this.value=''" id="TEL" name="TEL" class="box w_250" type="text"/>
	<input id="NAISSANCE" name="NAISSANCE" class="box w_250" type="text" value="Votre date de naissance" onblur="if(this.value=='') this.value='Votre date de naissance'" onfocus="if(this.value =='Votre date de naissance' ) this.value=''" />
	<input id="PROFESSION" name="PROFESSION" class="box w_250" type="text" value="Votre Profession exact" onblur="if(this.value=='') this.value='Votre Profession exact'" onfocus="if(this.value =='Votre Profession exact' ) this.value=''" />
	<input id="ADRESSE" name="ADRESSE" class="box w_250" type="text"  value="Votre Adresse" onblur="if(this.value=='') this.value='Votre Adresse'" onfocus="if(this.value =='Votre Adresse' ) this.value=''" />
	<input id="ADRESSE2" name="ADRESSE2" class="box w_250" type="text" value="Complement d&#8217;adresse" onblur="if(this.value=='') this.value='Complement d&#8217;adresse'" onfocus="if(this.value =='Complement d&#8217;adresse' ) this.value=''" />
	<input id="CODEPOSTAL" name="CODEPOSTAL" class="box w_250" type="text" value="Votre Code postal" onblur="if(this.value=='') this.value='Votre Code postal'" onfocus="if(this.value =='Votre Code postal' ) this.value=''"/>
	<input id="VILLE" name="VILLE" class="box w_250" type="text" value="Votre Ville" onblur="if(this.value=='') this.value='Votre Ville'" onfocus="if(this.value =='Votre Ville' ) this.value=''"/>
<p>
	<input  name="Vous_êtes" type="radio" value="Propriétaire" checked="checked"/>Propriétaire 
	&nbsp;<input name="Vous_êtes" type="radio" value=" Copropriétaire"/> 
	Copropriétaire &nbsp;<br/><input name="Vous_êtes" type="radio" value=" Locataire"/> 
	Locataire</p> <p>
	<input  name="d'une" type="radio" value="Maison" checked="checked"/>Maison &nbsp;<input name="d'une" type="radio" value=" Appartement"/> 
	Appartement &nbsp;</p><input class="box w_250" type="text" value="Nombre de pièces (hors cuisine)" id="NOMBREPIECE" name="NOMBREPIECE" onblur="if(this.value=='') this.value='Nombre de pièces (hors cuisine)'" onfocus="if(this.value =='Nombre de pièces (hors cuisine)' ) this.value=''"/><input class="box w_250"  type="text" value="Date effective du contrat" id="DATECONTRAT" name="DATECONTRAT" onblur="if(this.value=='') this.value='Date effective du contrat'" onfocus="if(this.value =='Date effective du contrat' ) this.value=''"/>
	
	<input  class="box w_150"  type="text" value="" id="vercode" name="vercode" />
	&nbsp;&nbsp; <img src="http://www.assursante.fr/control/captcha.php"> 
	<div class="clearfix"><input class="submit" type="submit" value="Envoyer"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="submit" type="reset" value="Annuler "/></div></fieldset>
	
	</form>


	<p></p>
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('../../../../inc_file/box_help.php'); ?>
		<?php require_once('../../../../inc_file/box_bannier.php'); ?>
		
	</div>
		<div class="clear">
	</div>
</div>
			<?php include_once('../../../../inc_file/footer.php'); ?>
			</body>

</html>

