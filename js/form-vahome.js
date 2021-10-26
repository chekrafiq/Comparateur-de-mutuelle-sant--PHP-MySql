function validateFormOnSubmit(theForm) {
		var reason = "";
	    reason += validateEmptyuser(theForm.NOMPRENOM);
  		reason += validatePhone(theForm.TEL);
  		reason += validateclock(theForm.HEUR);
		reason += validaterobot(theForm.nobotc);
      
  if (reason != "") {
    alert("Important :\n" + reason);
    return false;
  }

  return true;
}

function validateEmptyuser(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "1) Vous n'avez pas entrer Votre Nom & Prénom !.\n";
    
    } else if (fld.value == "Nom & Prénom") {
        error = "1) Vous n'avez pas entré votre Nom & Prénom  !!.\n";     
     } return error;  
}
function validateclock(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        error = "3) Veuillez sélectionner l' heure d'appel !.\n"
    }
    return error;  
}
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "2) Vous n'avez pas entré votre numéro de téléphone.\n";
        
	} else if (fld.value == "Votre Numéro") {
        error = "2) Vous n'avez pas entré votre numéro de téléphone !!.\n";     
    
    } else if (isNaN(stripped)) {
        error = "2) Le numéro de téléphone contient des caractères illégaux.\n";
               
        
    } else if (!(stripped.length == 10)) {
        error = "2) Le numéro de téléphone est erroné.\n";
       
    }
      else if ((stripped == "1111111111" || stripped == "2222222222" || stripped == "3333333333" || stripped == "4444444444" || stripped == "5555555555"  
     || stripped == "6666666666" || stripped == "7777777777" || stripped == "8888888888" || stripped == "9999999999"|| stripped == "0000000000"  
     || stripped == "0123456789" || stripped == "9876543210" || stripped == "1122334455" || stripped == "0011223344"  || stripped == "0101010101" || stripped == "0202020202" || stripped == "0303030303" || stripped == "0404040404" || stripped == "0505050505" || stripped == "0606060606" || stripped == "0707070707" || stripped == "0808080808" || stripped == "0909090909"
     || stripped == "0100000000" || stripped == "0200000000" || stripped == "0300000000" || stripped == "0400000000" || stripped == "0500000000" || stripped == "0600000000" || stripped == "0700000000" || stripped == "0800000000" || stripped == "0900000000")) {
        error = "2) S'il vous plaît entrer votre vrai numéro de téléphone .\n";
       
    }
    return error;
}

function validaterobot(fld) {
    var error = "";
 
    if (fld.checked == false) {
        error = "4) Cocher la case  ANTI-SPAM !.\n"
    }
    return error;  
}
