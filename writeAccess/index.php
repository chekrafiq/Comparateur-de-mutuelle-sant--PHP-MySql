<?php
	$pwd = dirname($_SERVER['SCRIPT_FILENAME']);

	if (is_file("$pwd/degallaix.nobody.tmp"))
	{
		echo "<table><tr><td bgcolor=red width=30>&nbsp;</td><td>ATTENTION : LE SITE EST ACTUELLEMENT MODIFIABLE PAR FTP<br />LE COMPORTEMENT DU SITE SERA ALTERE TANT QUE LA SECURITE N'AURA PAS ETE RETABLIE</tr></table>";
		echo "<a href='disableFTP.php'>Cliquez ici pour retablir la securite et le fonctionnement du site</a>";
	}
	else
	{
		echo "<table><tr><td bgcolor=green width=30>&nbsp;</td><td>LE SITE FONCTIONNE NORMALEMENT. SEULE LA LECTURE EST POSSIBLE EN FTP.</tr></table>";
		echo "<a href='enableFTP.php'>Cliquez ici pour autoriser les modifications par FTP</a>";
	}

?>

	<br /><p>&nbsp;</p>
<strong>NE PAS INTERROMPRE LE CHARGEMENT APRES AVOIR CLIQUE</strong>
