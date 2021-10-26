<?php 
	include('inc_dyn/gezip.php');
	include('config/cnx.php'); 
 	include('inc_dyn/domain_config.php');
?>
<?php
		if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
				{
				  if (PHP_VERSION < 6) {
				    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
				  }

  		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

			  switch ($theType) {
			    case "text":
			      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			      break;    
			    case "long":
			    case "int":
			      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
			      break;
			    case "double":
			      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			      break;
			    case "date":
			      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			      break;
			    case "defined":
			      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			      break;
			  }
			  return $theValue;
			}
		}

			mysql_select_db($database_cnx, $cnx);
			$query_rsRegime = "SELECT * FROM vw_regimes order by NREGIME";
					$rsRegime = mysql_query($query_rsRegime, $cnx) or die(mysql_error());
					$row_rsRegime = mysql_fetch_assoc($rsRegime);
					$totalRows_rsRegime = mysql_num_rows($rsRegime);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Devis MUTUELLE - AssurSanté, mutuelle et complémentaire santé : Devis en 
ligne - etape 2</title>
<?php include_once('inc_meta/meta.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/940_10_10_10.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/min.style.smartSocialCount.css" rel="stylesheet" type="text/css" />
<link href="css/css_tarificateur.css" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/jsapi?key=INSERT-YOUR-KEY" type="text/javascript"></script>
<script type="text/javascript">
  google.load("jquery", "1.4.2");
</script>

	<?php include_once('inc_js/validat_etap2.php'); ?>

</head>

<body class="si_layout">

<div class="container_10 wrapper">
		
	<?php require_once('inc_file/header.php'); ?>
		
	<?php require_once('inc_file/inc_menu/menu.php'); ?>
	</div>
<div class="container_10 wrapper m_t_10">
	<div id="content" class="grid_2">
		
		<?php require_once('inc_file/inc_menu/menu_devis.php'); ?>
		</div>
	<div id="content" class="grid_5">
	<h1>Devis Mutuelle En Ligne :</h1>

	<?php require_once('inc_form/t_form_2.php'); ?>
	</div>
	<div class="grid_3">
		<p></p>

		<div class="box"><h3>
			<img alt="Etre appele"  src="<?php echo ROOT_PATH ;?>images/picto_aide.gif"/>
				Régime ? :</h3><p><strong style="color:black">S.S </strong>: Personnes affiliées au régime de la sécurité sociale. Les salaries de l’industrie et du commerce sont affiliés au régime général de la sécurité sociale.</p>
				<p><strong style="color:black">T.N.S</strong> : Travailleurs Non-Salariés, c’est-à-dire les professions non salariées non agricoles. </p>
				<p><strong style="color:black">Agricole</strong> : Dans ce régime sont affiliés tous les exploitants agricoles non-salariés.</p>
				</div>

	</div>
	
	<div class="clearfix">
	</div>
</div>
			<?php include_once('inc_file/footer.php'); ?>

</body>

</html>
