<?php

$table_keywords = "keywords";
 
$HTSEARCH_PROG = "htsearch";
//$HTSEARCH_PROG = "htsearch"; 
$HTDIG_CONF = "$g_absolutepath/_kernix_/conf/htdig.conf";


if (!isset($words))
{
  return 0;
}

if (!isset($page) && !empty($words))
{
  $mywords = strtoupper($words);
  $l_sql = "INSERT INTO $table_keywords (keyword,date,idvisitor) VALUES ('$mywords','$l_date','$g_idvisitor')";
  $c_db->query($l_sql);
}
$words = urlencode($words);
if (isset($page))
{
  $query = "words=$words&page=$page&p_fromref=$p_fromref";
}
     else
{
  $query = "words=$words&p_fromref=$p_fromref";
}
$query .= "&p_za=search&p_idref=0";
$command = "$HTSEARCH_PROG -c $HTDIG_CONF $query";

?>

<table width=95% align=center>
<tr><td class="contenu">

<?php

$result = system($command); 

?>

</td></tr></table>
