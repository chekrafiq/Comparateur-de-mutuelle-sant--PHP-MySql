

<?php

		require_once('../config/cnx.php');
		include_once('../inc_class/calsses.php');
		
		if (isset($_GET['f'])) 
		{
		$formule= $_GET['f'];
		$nformule= $_GET['nf'];
		$compagnie= $_GET['c'];
		$ncompagnie= $_GET['nc'];
		$tarif= $_GET['t'];
		$telephone= $_GET['tel'];
		$email= $_GET['em'];
		$idDevis= $_GET['idDevis'];
		
		echo $idDevis;
		
		mysql_select_db($database_cnx, $cnx);
		
		$query_Devis = "UPDATE  devis SET  ncmp= $ncompagnie , nfrml= $nformule,  tarifs = $tarif where ndevis = $idDevis";	
		
		mysql_query($query_Devis, $cnx) or die(mysql_error());	
		
		
		mysql_close($cnx);
?>
<script type="text/javascript"> 
location.href='../souscription.php?idDevis=<?php echo $idDevis;?>';
</script>
<?php
}?>