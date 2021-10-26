<?php
include('_kernix_/var.inc.php3');

$table_sp_parc          = "sp_parc";
$table_sp_poche         = "sp_poche";
$table_sp_services      = "sp_services";
$table_sp_produits      = "sp_produits";
$table_sp_adresse       = "DTWH_ADRESSE";
$table_sp_servicepoche  = "DTWH_SERVICE_POCHE";
$table_sp_tarifs        = "DTWH_TARIFS";
$table_sp_ce            = "sp_clubexpress";

$l_tab = get_parc($p_parc, $p_poche);

?>

<html>
 <head>
  <title>plan</title>
<LINK HREF="/upload/css/style_main.css"   REL="stylesheet" TYPE="text/css">
 </head>

<body bgcolor=white color=black>
<span class="txt_n_arial">
<?=$l_tab["libelle"]?><br>
<?=$l_tab["adr_adresse1"]?><br>
<?php if ($l_tab["adr_adresse2"]) echo $l_tab["adr_adresse2"]."<br>"; ?>
<?=$l_tab["adr_cp"]?> <?=$l_tab["adr_ville"]?><br><br>
</span>
<img src="/upload/pictures/<?=$p_img?>">
</body>

</html>
