<script  src="js/jquery-ui-1.8.11.custom.min.js" type="text/javascript"></script>
<script charset="utf-8" src="js/uidatepicker-fr.js" type="text/javascript"></script>
<script type="text/javascript">
		
			$(function(){

				// Datepicker
				
			    $( "#dateEffect" ).datepicker({ altFormat: 'dd-mm-yy' });
				
			});
		</script>
<script type="text/javascript">jQuery(document).ready(function() {
    jQuery.datepicker.setDefaults(jQuery.datepicker.regional['fr']);
    jQuery("#dateEffect").mousedown(function(){
        jQuery("#dateEffect").datepicker('change', {dateFormat: 'dd-mm-yy', firstDay:1 }).attr("readonly","readonly");
    });
});</script>

	

<script src="js/form-vahome.js" type="text/javascript"></script>
<script src="js/assu_script.js" type="text/javascript"></script>
<script src="js/min.jquery.smartSocialCount.js" type="text/javascript"></script>
<script src="http://apis.google.com/js/plusone.js" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<!-- Light Box -->
<script  src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script type="text/javascript">$(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto();

		});
</script>


<script  type="text/javascript">
function validate(){
var c = document.getElementById("Checkbox1");
var ADRESSE = document.getElementById("ADRESSE");
var CODEPOSTAL = document.getElementById("CODEPOSTAL");
var VILLE = document.getElementById("VILLE");
var TEL = document.getElementById("TEL");
var EMAIL = document.getElementById("EMAIL");
var NOM = document.getElementById("NOM");
var PRENOM = document.getElementById("PRENOM");
var T1 = document.getElementById("T1");
var T2 = document.getElementById("T2");
var T3 = document.getElementById("T3");
var T4 = document.getElementById("T4");
var T5 = document.getElementById("T5");
var T6 = document.getElementById("T6");
var T7 = document.getElementById("T7");
var TC1 = document.getElementById("TC1");
var TC2 = document.getElementById("TC2");
var TC3 = document.getElementById("TC3");
var TC4 = document.getElementById("TC4");
var TC5 = document.getElementById("TC5");
var TC6 = document.getElementById("TC6");
var TC7 = document.getElementById("TC7");
var NOMConj = document.getElementById("NOMConj");
var PRENOMConj = document.getElementById("PRENOMConj");
var NUMERODECOMPTE1 = document.getElementById("NUMERODECOMPTE1");
var NUMERODECOMPTE2 = document.getElementById("NUMERODECOMPTE2");
var NUMERODECOMPTE3 = document.getElementById("NUMERODECOMPTE3");
var NUMERODECOMPTE4 = document.getElementById("NUMERODECOMPTE4");
var error = "0";
var message="";
if(c.checked==0)
{
message+="Vous devez cocher la case pour accepter les conditions générales de ventes\n";
error = "1";
}

if(ADRESSE.value=="")
{
//alert("Vous devez saisir l'adresse");
message+="Vous devez saisir l'adresse\n";
error = "1";
}

if(CODEPOSTAL.value=="")
{
//alert("Vous devez saisir le code postal");
message+="Vous devez saisir le code postal\n";
error = "1";
}

if(VILLE.value=="")
{
//alert("Vous devez saisir votre ville");
message+="Vous devez saisir votre ville\n";
error = "1";
}

if(TEL.value=="")
{
//alert("Vous devez saisir votre téléphone");
message+="Vous devez saisir votre téléphone\n";
error = "1";
}

if(EMAIL.value=="")
{
//alert("Vous devez saisir votre EMAIL");
message+="Vous devez saisir votre EMAIL\n";
error = "1";
}

if(NOM.value=="")
{
//alert("Vous devez saisir votre nom");
message+="Vous devez saisir votre nom\n";
error = "1";
}

if(PRENOM.value=="")
{
//alert("Vous devez saisir votre prénom");
message+="Vous devez saisir votre prénom\n";
error = "1";
}

if(T1.value=="" || T2.value=="" || T3.value=="" || T4.value=="" || T5.value=="" || T6.value=="" || T6.value=="" )
{
//alert("Vous devez saisir numéro de sécurité social");
message+="Vous devez saisir numéro de sécurité social\n";
error = "1";
}

if(NUMERODECOMPTE1.value=="" || NUMERODECOMPTE2.value=="" || NUMERODECOMPTE3.value=="" || NUMERODECOMPTE4.value=="" )
{
//alert("Vous devez saisir votre rib");
message+="Vous devez saisir votre rib ";
error = "1";
}
if(error=="1")
{
alert(message);
return false;
}
else
return true;

}


function changePaiment(){
var c = document.getElementById("TYPEPRELEVEMENT");
if(c.value=='cheque')
{
document.getElementById("trCheque").style.visibility= 'visible'; 
document.getElementById("trPre").style.visibility= 'hidden'; 
}
else
{
document.getElementById("trCheque").style.visibility= 'hidden'; 
document.getElementById("trPre").style.visibility= 'visible'; 
}
}

</script>
<script  src="js/jquery.prettyPhoto.js" type="text/javascript"></script>

