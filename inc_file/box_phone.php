<?php $nobot = time().'_'.rand(50000, 60000); ?>
<div class="box"><h3>
			<img alt="Etre appele"  src="<?php echo ROOT_PATH ;?>images/etre_appele.gif"/>
				Etre appelé :</h3><form action="<?php echo ROOT_PATH ;?>control/etre_appele.php" method="post" onsubmit="return validateFormOnSubmit(this)">
				
	<input type="hidden" name="try" value="send">
<input type="hidden" name="nobotv" value="<?php echo $nobot; ?>">
<!-- ICI tout ce que vous voulez dans votre formulaire HTML -->
<p class="p_l_r_5 "><input name="NOMPRENOM" id="NOMPRENOM" class="box"  value="Nom &amp; Prénom" onblur="if(this.value=='') this.value='Nom &amp; Prénom'" onfocus="if(this.value =='Nom &amp; Prénom' ) this.value=''" type="text"/>
				<input id="TEL"  class="box" value="Votre Numéro" onblur="if(this.value=='') this.value='Votre Numéro'" onfocus="if(this.value =='Votre Numéro' ) this.value=''" type="text" name="TEL"/><select name="HEUR" id="HEUR" class="box"><option value="">Heur d'appel&nbsp; </option><option>8:00</option>
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
				<option>19:00</option></select><br/>
				</p>

<!-- On Rajoute cette petite case à cocher en bas du formulaire -->
<h3>Anti-Spam :</h3>
<input type="checkbox" name="nobotc" value="<?php echo md5($nobot); ?>" /> &nbsp;&nbsp;Je confirme que je suis un être humain, et pas un robot.
<div style="position: absolute; visibility: hidden; left: -5000; top : -5000">
<br><input type="checkbox" name="nobots" value="<?php echo time(); ?>" />I'm a Stupid Spam-Robot
</div><br/></br> 
<input class="submit" value="envoyer" type="submit"/>
</form> 
			</div>

			
			