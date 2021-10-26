<?php
include("_kernix_/var.inc.php3");
$table_msg = "msg";
$l_sql = "SELECT title, description FROM $table_msg WHERE code = '" . strtoupper($p_code) . "'";
$c_db->query($l_sql);
$l_title = $c_db->result(0,"title");
$l_msg   = ereg_replace("\n","<br>",$c_db->result(0,"description"));
?>
<html>
<head>
<title><?php print("$g_sitename : $l_title"); ?></title>
<LINK HREF="<?php print("$g_skinpath/default/main"); ?>.css" REL="stylesheet" TYPE="text/css">
</head>
<body>
<p class=title align=center>::: <?php print($l_title); ?> :::</p>
<?php
print($l_msg);
?>
</body>
</html>
