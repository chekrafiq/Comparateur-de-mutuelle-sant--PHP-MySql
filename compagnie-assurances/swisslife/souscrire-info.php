<?php 
	include('../../inc_dyn/gezip.php'); 
	include('../../inc_dyn/domain_config.php');
	//define('PATCH',"../../"); //patch of css and include file

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Demande d'information ou souscription </title>
<?php include_once('../../inc_meta/meta.php'); ?>

<link href="../../css/reset.css" rel="stylesheet" type="text/css" />
<link href="../../css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="../../css/screen.css" rel="stylesheet" type="text/css" />
<link href="../../css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="../../css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script src="../../js/assu_script.js" type="text/javascript"></script>
<script src="../../js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script src="../../js/jquery.prettyPhoto.js" type="text/javascript"></script>

<script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOM);
        reason += validateEmail(theForm.EMAIL);
  		reason += validatePhone(theForm.TEL);
     	reason += validateEmptysujet(theForm.SUJEET);


      
  if (reason != "") {
    alert("Important :\n" + reason);
    return false;
  }

  return true;
}

function validateEmptyuser(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "1) Vous n'avez pas entrer Votre Nom !\n"
    }else if (fld.value == "Tapez votre Nom &amp; votre Prénom") {
        error = "1) Vous n'avez pas entré votre Nom &amp; Prénom  !\n";     
     }
    return error;  
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
        error = "3) Vous n'avez pas entré votre numéro de téléphone !\n";
     
    } else if (fld.value == "Tapez Votre Numéro de Téléphone") {
        error = "3) Vous n'avez pas entré votre numéro de téléphone !\n";
               
        
    } 
    else if (isNaN(stripped)) {
        error = "3) Le numéro de téléphone contient des caractères illégaux !\n";
               
        
    }
    
    else if (!(stripped.length == 10)) {
        error = "3) Le numéro de téléphone est erroné !\n";
       
    }
     else if ((stripped == "1111111111" || stripped == "2222222222" || stripped == "3333333333" || stripped == "4444444444" || stripped == "5555555555"  
     || stripped == "6666666666" || stripped == "7777777777" || stripped == "8888888888" || stripped == "9999999999"|| stripped == "0000000000"  
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  
     )) {
        error = "3) Le numéro de téléphone est erroné !\n";
       
    }
    return error;
}
function validateEmptysujet(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "4) Vous n'avez pas entrer Votre Sujet !\n"
    }
    return error;  
}

</script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		<?php require_once('../../inc_file/header.php'); ?>
		<?php require_once('../../inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div  class="grid_2">
		<div id="menu_for_statique">
			<img alt="Garantie des Accidents " src="../../images/gav.jpg" />
			<ul class="color_bl">
				<li class="retour_bl"><a href="#">Retour</a></li>
			</ul>
		</div>
		</div>
	<div id="content" class="grid_5">
	<h1>Demande d'information ou souscription :</h1>
	<h2>N'hésitez pas à prendre contact avec nous...</h2>
		<div class="message_box_wrap notice">Si vous avez des questions relatives à ce produit, un devis ou une souscription en ligne, n'hesitez pas à 
			<strong style="color:red">remplir ce formulaire</strong> en indiquant 
			<em><strong>votre nom</strong></em>, <em><strong>votre 
		numéro</strong></em> , <em><strong>votre E-mail</strong></em> , <strong>
			<em>votre sujet </em></strong>.</div><p></p>
		<form method="post" action="../../control/ctr_contact.php" onsubmit="return validateFormOnSubmit(this)">
	<fieldset class="p_l_r_100">
	<input value="Tapez votre Nom et votre Prénom" onblur="if(this.value=='') this.value='Tapez votre Nom et votre Prénom'" onfocus="if(this.value =='Tapez votre Nom et votre Prénom' ) this.value=''" id="NOMPRENOM" name="NOM" class="box w_250" type="text"/><input value="Tapez Votre valide E-Mail @" onblur="if(this.value=='') this.value='Tapez Votre valide E-Mail @'" onfocus="if(this.value =='Tapez Votre valide E-Mail @' ) this.value=''" id="EMAIL" name="EMAIL" class="box w_250" type="text"/><input  value="Tapez Votre Numéro de Téléphone" onblur="if(this.value=='') this.value='Tapez Votre Numéro de Téléphone'" onfocus="if(this.value =='Tapez Votre Numéro de Téléphone' ) this.value=''" id="TEL" name="TEL" class="box w_250" type="text"/><textarea rows="5"  cols="3"  id="SUJEET" name="SUJET"  class="box w_250 h_150 " ></textarea><div class="clearfix"><input class="submit" type="submit" value="Envoyer"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="submit" type="reset" value="Annuler "/></div></fieldset>
	
	</form>


	<p></p>
	
	</div>
	<div class="grid_3">
		<p></p>

		<?php require_once('../../inc_file/box_help.php'); ?>
		<?php require_once('../../inc_file/box_bannier.php'); ?>

	</div>
		<div class="clear">
	</div>
</div>
			<?php include_once('../../inc_file/footer.php'); ?>
			</body>

</html>
