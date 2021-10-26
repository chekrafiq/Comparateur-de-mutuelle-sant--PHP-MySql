<?php

header("Content-type: text/vnd.wap.wml");
echo "<?xml version=\"1.0\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\"" . 
     " \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";

?>

<wml>
<head> 
<meta http-equiv="Cache-Control" content="max-age=60"/> 
</head>

<card>

<?php

print("<p align=\"center\"><b>$ref->name</b></p>\n");
print("<p align=\"left\"><br/><br/>" . get_text_wap($ref->content) . "</p>");
print("<p align=\"center\"><br/><br/><u>:: navigation</u></p>\n");

$l_tabcat = get_tabsubref($ref->idref,'','');
$i = 0;
while($l_tabcat[$i])
{
     $l_namelink = ereg_replace("&", "AND", $l_tabcat[$i]["name"]);
     print("<p><a href=\"/wap/wap__" . $l_tabcat[$i]["idref"]  . ".wml\">" . $l_namelink  . "</a></p>\n");
     $i++;
}
?>

<p align="center">
<do type="prev" label="back"> <prev/>
</do>
</p>
</card>
</wml>
