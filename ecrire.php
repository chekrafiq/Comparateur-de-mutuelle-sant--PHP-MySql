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
<link href="css/rappelcss.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOM);
	    reason += validateEmptypre(theForm.PRENOM);
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
function validateEmptysujet(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "Vous n'avez pas entrer Votre Sujet !.\n"
    }
    return error;  
}

</script>
	

</head>

<body>
<div id="box"><h3 class="h3box">Nous écrire !</h3>
<h4 class="boxh4">Veuillez remplire les champs</h4>
<div class="clear"></div>
<form id="box" method="post" action="confirmationecrire.php" onsubmit="return validateFormOnSubmit(this)">
<fieldset>
<legend >Vos coordonnées :</legend>
<ul><li>
<label>Nom : </label><input class="box" name="NOM"  type="text" id="NOM"/></li>
<li><label>Prénom : </label><input class="box" name="PRENOM" type="text" id="PRENOM"/></li>
<li><label>Email : </label><input class="box" name="EMAIL" type="text" id="EMAIL"/></li>
<li><label>Tel : </label><input class="box" name="TEL" type="text" id="TEL" /></li>
<li>
<label>Sujet : </label>&nbsp;</li>

<li><textarea id="SUJEET" name="SUJEET" style="width:300px;height:100px;margin-left:50px" class="box"></textarea></li>

</ul>
</fieldset>
<input class="boximg" type="image" src="images/bt_rappel.jpg"  /> 
</form>
</div>
</body>

</html>
