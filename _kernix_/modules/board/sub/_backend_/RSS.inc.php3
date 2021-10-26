<?php
header("content-type: text/xml");
print("<?xml version=\"1.0\"?>\n");
?>

<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN"
          "http://my.netscape.com/publish/formats/rss-0.91.dtd" >
<rss version="0.91">
 <channel>

<?php

print("<title>$board->title</title>\n");
print("<language>fr</language>\n");
print("<link>$g_urlroot</link>\n");
print("<description>$board->description</description>\n");

$l_nb = $board->nbeleminlisttopic;

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND level = '0' AND validflag = '1' ORDER BY date DESC LIMIT 0, $l_nb";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("<item>\n");
  print("<title>$obj->title</title>\n");
  print("<link>$g_urldyn?p_idref=$p_idref&p_za=board&p_boardaction=topic_view&p_idpost=$obj->idpost</link>\n");
  print("</item>\n");
}
?>

 </channel>
</rss>
