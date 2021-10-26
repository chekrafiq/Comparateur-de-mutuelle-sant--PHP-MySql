
<script src="js/assu_script.js" type="text/javascript"></script>
<script src="js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>



<script type="text/javascript">
function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOM);
	    reason += validateEmptypre(theForm.PRENOM);
        reason += validateEmail(theForm.EMAIL);
  		reason += validatePhone(theForm.TELEPHONE);
     

      
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
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  || stripped == "0101010101" || stripped == "0202020202" || stripped == "0303030303" || stripped == "0404040404" || stripped == "0505050505" || stripped == "0606060606" || stripped == "0707070707" || stripped == "0808080808" || stripped == "0909090909"
     || stripped == "0100000000" || stripped == "0200000000" || stripped == "0300000000" || stripped == "0400000000" || stripped == "0500000000" || stripped == "0600000000" || stripped == "0700000000" || stripped == "0800000000" || stripped == "0900000000")) {
        error = "S'il vous plaît entrer votre vrai numéro de téléphone .\n";
       
    }   
    return error;
}
</script>
