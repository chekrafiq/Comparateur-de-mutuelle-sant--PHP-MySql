<?php

$l_name = strtoupper($p_name);

if ($p_formflag == "create")
{
     $l_sql = "SELECT * FROM $table_form WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_name > déjà présent.");
	  include("sub/listform.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_form (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idform = $c_db->get_id();
}

$i = 1;
while (isset(${"p_name$i"}))
{
     $l_fieldstring .= $l_sepchar;
     $l_fieldstring .= ${"p_name$i"} . ";;" . ${"p_type$i"} . ";;" . ${"p_value$i"} . ";;" . ${"p_required$i"};
     $l_sepchar = "&&";
     $i++;
}

//print("$l_fieldstring");

$l_sql = "UPDATE $table_form SET name = '$l_name', fieldstring = '$l_fieldstring', email = '$p_email', emailflag = '$p_emailflag', subject = '$p_subject' WHERE idform = '$p_idform'";
//print("<br>$l_sql");
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/viewform.inc.php3");
?>


