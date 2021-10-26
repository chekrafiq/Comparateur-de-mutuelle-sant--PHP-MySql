<?php 
	include('inc_dyn/gezip.php'); 
	include('inc_dyn/domain_config.php');
	//$nobot = time().'_'.rand(50000, 60000); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Contact par E-mail</title>
<?php include_once('inc_meta/meta.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>
<script type="text/javascript" src="js/assu_script.js"></script>
<script type="text/javascript" src="js/min.jquery.smartSocialCount.js"></script>

<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

<script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOM);
        reason += validateEmail(theForm.EMAIL);
  		reason += validatePhone(theForm.TEL);
     	reason += validateEmptysujet(theForm.SUJEET);
		reason += validaterobot(theForm.vercode);
		


      
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
    }else if (fld.value == "Tapez votre Nom et votre Prénom") {
        error = "1) Vous n'avez pas entré votre Nom & Prénom  !\n";     
     }
    return error;  
}
function trim(s){
  return s.replace(/^\s+|\s+$/, '');
}
function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
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

   if (fld.value == "") 
		    {
				error = "3) Vous n'avez pas entré votre numéro de téléphone !\n";
			 
			} 
	else if (fld.value == "Tapez Votre Numéro de Téléphone") 
			{
				error = "3) Vous n'avez pas entré votre numéro de téléphone !\n";
					   
				
			} 
    else if (isNaN(stripped)) 
			{
				error = "3) Le numéro de téléphone contient des caractères illégaux !\n";
					   
				
			}
    
    else if (!(stripped.length == 10)) 
			{
				error = "3) Le numéro de téléphone est erroné !\n";
			   
			}
     else if ((stripped == "1111111111" || stripped == "2222222222" || stripped == "3333333333" || stripped == "4444444444" || stripped == "5555555555"  
     || stripped == "6666666666" || stripped == "7777777777" || stripped == "8888888888" || stripped == "9999999999"|| stripped == "0000000000"  
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  
     )) 
			{
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
function validaterobot(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "5) Vous n'avez pas entrer le code  ANTI-SPAM !.\n"
    }
    return error;  
}


</script>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
	<?php require_once('inc_file/header.php'); ?>
	<?php require_once('inc_file/inc_menu/menu.php'); ?>
	
</div>
<div class="container_10 wrapper m_t_10">
	<div id="content" class="grid_7">
	<h1>Contact par E-Mail :</h1>
	<h2>N'hésitez pas à prendre contact avec nous...</h2>
		<p>Si vous avez des questions relatives à nos produits, un devis ou une souscription en ligne, n'hesitez pas à remplir ce formulaire en indiquant votre nom, votre 
		numéro , votre E-mail , votre sujet .</p><p></p>
	
	
	<form method="post" action="control/ctr_contact.php" onsubmit="return validateFormOnSubmit(this)">
	<fieldset class="p_l_r_100">
		
		<input type="hidden" name="try" value="send"/>
		<input type="hidden" name="nobotv" value="<?php echo $nobot; ?>"/>
		<!-- ICI tout ce que vous voulez dans votre formulaire HTML -->

	<input value="Tapez votre Nom et votre Prénom" onblur="if(this.value=='') this.value='Tapez votre Nom et votre Prénom'" onfocus="if(this.value =='Tapez votre Nom et votre Prénom' ) this.value=''" id="NOMPRENOM" name="NOM" class="box w_250" type="text"/><input value="Tapez Votre valide E-Mail @" onblur="if(this.value=='') this.value='Tapez Votre valide E-Mail @'" onfocus="if(this.value =='Tapez Votre valide E-Mail @' ) this.value=''" id="EMAIL" name="EMAIL" class="box w_250" type="text"/><input  value="Tapez Votre Numéro de Téléphone" onblur="if(this.value=='') this.value='Tapez Votre Numéro de Téléphone'" onfocus="if(this.value =='Tapez Votre Numéro de Téléphone' ) this.value=''" id="TEL" name="TEL" class="box w_250" type="text"/><textarea   id="SUJEET" name="SUJET"  class="box h_150" style="width:420px" ></textarea><div class="clearfix">
	<!-- On Rajoute cette petite case à cocher en bas du formulaire -->
<h3>Anti-Spam :</h3>
<input id="vercode" class="box w_150" type="text" name="vercode" /> <img src="control/captcha.php">
<div style="position: absolute; visibility: hidden; left: -5000; top : -5000">
<br/>
</div><br/><br/> 

	<input class="submit" type="submit" value="Envoyer"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="submit" type="reset" value="Annuler "/></div></fieldset>
	
	</form>
	<p></p>
	</div>
	<div class="grid_3">
		<p></p>
		<?php require_once('inc_file/box_help.php'); ?>
		<?php require_once('inc_file/box_bannier.php'); ?>

		
	</div><div class="clearfix"></div>
</div>

			<?php include_once('inc_file/footer.php'); ?>

</body>

</html>
