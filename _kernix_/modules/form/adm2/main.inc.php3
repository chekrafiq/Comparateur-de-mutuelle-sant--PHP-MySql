<?php

$table_form = "form";
$table_result = "formresult";

$l_nbfields = 10;

if (isset($p_formaction))
{
     include("sub/$p_formaction.inc.php3");
}
else
{
     include("sub/listform.inc.php3");
     
}

?>


