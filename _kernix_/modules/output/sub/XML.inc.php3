<?php

function bdd2xml($s)
{
  global $l_tags;
  $s = eregi_replace('<br>', '\n', $s);
  $s = strip_tags($s, $l_tags);
//  $s = utf8_encode($s);
  return $s;
}

$l_tags = '<b>';

header('content-type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" standalone=\"yes\" ?>\n";

if (!empty($ref->data))
{
  $tab = get_datasbycode($ref->data);
}

if (isset($p_withdtd))
{
  print("\n<!DOCTYPE KERNIXPAGE [\n");
  print("<!ELEMENT KINFOS (KDIREF, KNAME, KTITLE, KDATE, KCDATE, KMDATE, KURL, KSOFT, KSOFTVERSION) >\n");
  print("<!ELEMENT KIDREF (#PCDATA) >\n");
  print("<!ELEMENT KNAME (#PCDATA) >\n");
  print("<!ELEMENT KTITLE (#PCDATA) >\n");
  print("<!ELEMENT KDATE (#PCDATA) >\n");
  print("<!ELEMENT KCDATEF (#PCDATA) >\n");
  print("<!ELEMENT KMDATE (#PCDATA) >\n");
  print("<!ELEMENT KURL (#PCDATA) >\n");
  print("<!ELEMENT KSOFT (#PCDATA) >\n");
  print("<!ELEMENT KSOFTVERSION (#PCDATA) >\n");
  if (!empty($ref->data))
  {
    foreach ($tab as $code => $content)
      {
	$l_tmp .= ", $code";
	$l_str .= "<!ELEMENT $code (#PCDATA) >\n";
      }
  }
  print("<!ELEMENT KDATAS (KDESCRIPTION, KCONTENT$l_tmp, KVALUE1, KVALUE2, KVALUE3, KVALUE4) >\n");
  print("<!ELEMENT KDESCRIPTION (#PCDATA) >\n");
  print("<!ELEMENT KCONTENT (#PCDATA) >\n");
  print($l_str);
  print("<!ELEMENT KVALUE1 (#PCDATA) >\n");
  print("<!ELEMENT KVALUE2 (#PCDATA) >\n");
  print("<!ELEMENT KVALUE3 (#PCDATA) >\n");
  print("<!ELEMENT KVALUE4 (#PCDATA) >\n");
  if ($ref->idproduct > 0)
  {
    print("<!ELEMENT KPRODUCT (KPRODREF, KPRODPRICE, KPRODSTOCK) >\n");
    print("<!ELEMENT KPRODREF (#PCDATA) >\n");
    print("<!ELEMENT KPRODPRICE (#PCDATA) >\n");
    print("<!ELEMENT KPRODSTOCK (#PCDATA) >\n");
  }
  print("<!ELEMENT KNAVIG (KPREV, KNEXT, KUP) >\n");
  print("<!ELEMENT KPREV (#PCDATA) >\n");
  print("<!ELEMENT KNEXT (#PCDATA) >\n");
  print("<!ELEMENT KUP (#PCDATA) >\n");
  print("]>\n");
}

?>

<KERNIXPAGE>
<KINFOS>
<KIDREF><?=$ref->idref?></KIDREF>
<KNAME><?php echo bdd2xml($ref->name); ?></KNAME>
<KTITLE><?php echo bdd2xml($ref->title); ?></KTITLE>
<KDATE><?php echo date("Y-m-d G:i:s"); ?></KDATE>
<KCDATE><?=$ref->creationdate?></KCDATE>
<KMDATE><?=$ref->updatedate?></KMDATE>
<KURL><?=$g_urlroot?></KURL>
<KSOFT><?=$g_softname?></KSOFT>
<KSOFTVERSION><?=$g_softversion?></KSOFTVERSION>
</KINFOS>
<KDATAS>
<KDESCRIPTION><?php echo bdd2xml($ref->description); ?></KDESCRIPTION>
<KCONTENT><?php echo bdd2xml($ref->content); ?></KCONTENT>
<?php
if (!empty($ref->data))
{
  foreach ($tab as $code => $content)
    {
      print("<$code>" . bdd2xml($content) . "</$code>\n");
    }
}
?>
<KVALUE1><?php echo bdd2xml($ref->val1); ?></KVALUE1>
<KVALUE2><?php echo bdd2xml($ref->val2); ?></KVALUE2>
<KVALUE3><?php echo bdd2xml($ref->val3); ?></KVALUE3>
<KVALUE4><?php echo bdd2xml($ref->val4); ?></KVALUE4>
</KDATAS>
<?php 
if ($ref->idproduct > 0) :
$l_sql = "SELECT * FROM $table_product WHERE idproduct = '$ref->idproduct'";
$c_db->query($l_sql);
$prod = $c_db->object_result();
?>
<KPRODUCT>
<KPRODREF><?php echo bdd2xml($prod->productcode); ?></KPRODREF>
<KPRODPRICE><?=$prod->price?></KPRODPRICE>
<KPRODSTOCK><?=$prod->stock?></KPRODSTOCK>
</KPRODUCT>
<?php endif; ?>
<KNAVIG>
<KPREV><?=$ref->prev?></KPREV>
<KNEXT><?=$ref->next?></KNEXT>
<KUP><?=$ref->up?></KUP>
</KNAVIG>
</KERNIXPAGE>

