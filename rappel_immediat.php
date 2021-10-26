<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Votre adhésion en ligne </title>
<style type="text/css">
/* css for timepicker */
.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
.ui-timepicker-div dl{ text-align: left; }
.ui-timepicker-div dl dt{ height: 25px; }
.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }

</style>

<link type="text/css" href="css/black-tie/jquery-ui-1.8.11.custom.css" rel="stylesheet" />	
		<link href="css/rappelcss.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>

		<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
		<script src="js/uidatepicker-fr.js" type="text/javascript"></script>
<script type="text/javascript">
				
					$(function(){
		
						// Datepicker
						
					    $( "#datepicker" ).datepicker({ altFormat: 'dd-mm-yy' });
						
					});
		</script>
<script type="text/javascript">
		jQuery(document).ready(function() {
	    jQuery.datepicker.setDefaults(jQuery.datepicker.regional['fr']);
	    jQuery("#datepicker").mousedown(function(){
        jQuery("#datepicker").datepicker('change', {dateFormat: 'dd-mm-yy', firstDay:1 }).attr("readonly","readonly");
    	});
		});
</script>
 <script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOM);
	    reason += validateEmptypre(theForm.PRENOM);
        reason += validateEmail(theForm.EMAIL);
  		reason += validatePhone(theForm.TEL);
     

      
  if (reason != "") {
    alert("Important :\n" + reason);
    return false;
  }

  return true;
}

function validateEmptyuser(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "Vous n'avez pas entrer Votre Nom !.\n"
    }
    return error;  
}
function validateEmptypre(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "Vous n'avez pas entrer Votre Prenom !.\n"
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
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value == "") {
        error = "Vous n'avez pas entrer une adresse e-mail.\n";
    } else if (!emailFilter.test(tfld)) {              //test email for illegal characters
        error = "S'il vous plaît entrer une adresse email valide.\n";
    } else if (fld.value.match(illegalChars)) {
        error = "L'adresse e-mail contient des caractères illégaux.\n";
    } 
    return error;
}
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "Vous n'avez pas entré votre numéro de téléphone.\n";
     
    } else if (isNaN(stripped)) {
        error = "Le numéro de téléphone contient des caractères illégaux.\n";
               
        
    } else if (!(stripped.length == 10)) {
        error = "Le numéro de téléphone est erroné.\n";
     }
     else if ((stripped == "1111111111" || stripped == "2222222222" || stripped == "3333333333" || stripped == "4444444444" || stripped == "5555555555"  
     || stripped == "6666666666" || stripped == "7777777777" || stripped == "8888888888" || stripped == "9999999999"|| stripped == "0000000000"  
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  
     )) {
        error = "Le numéro de téléphone est erroné.\n";

    }
    return error;
}
</script>

</head>

<body>
<div id="box"><h3 class="h3box">Rappel Immédiat !</h3>
<h4 class="boxh4">Veuillez remplire les champs</h4>
<div class="clear"></div>
<form name="formulaire" id="box" method="post" action="confirmationRappel.php" onsubmit="return validateFormOnSubmit(this)">
<fieldset>
<legend >Vos coordonnées :</legend>
<ul><li>
<label>Nom : </label><input class="box" name="NOM"  type="text" id="NOM"/></li>
<li><label>Prénom : </label><input class="box" name="PRENOM" type="text" id="PRENOM"/></li>
<li><label>Sexe : </label><input class="box" name="SEXE" type="text"/></li>
<li><label>Email : </label><input class="box" name="EMAIL" type="text" id="EMAIL"/></li>
<li><label>Tel : </label><input class="box" name="TEL" type="text" id="TEL"/></li>

</ul>
</fieldset>
<fieldset>
<legend >Choisir une date et un horaire :</legend>
<ul><li>
<label>Date De Rappel : </label><input id="datepicker" class="box" name="datepicker" type="text"/> <img alt=""  src="images/bt_calendar.png"/></li>
<li><label>Heure de rappel :</label><select name="Select1">
				<option>8:00</option>
				<option>9:00</option>
				<option>10:00</option>
				<option>11:00</option>
				<option>12:00</option>
				<option>13:00</option>
				<option>14:00</option>
				<option>15:00</option>
				<option>16:00</option>
				<option>17:00</option>
				<option>18:00</option>
				<option>19:00</option>
			</select></li>

</ul>
</fieldset>
<input class="boximg" type="image" src="images/bt_rappel.jpg"  /> 
</form>
</div>
</body>

</html>
