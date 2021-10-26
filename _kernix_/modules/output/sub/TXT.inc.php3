<?php

//function bdd2txt($p_text)
//{
//     $l_text = ereg_replace("<br>", "\n", $p_text);
//     $l_text = strip_tags($p_text);
//     $l_text = stripslashes($l_text);
//     return $l_text;
//}

header ("Content-Type: text/plain");

print($ref->name . "\n\n");
print(wordwrap(bdd2txt($ref->content),70,"\n") . "\n");

?>
