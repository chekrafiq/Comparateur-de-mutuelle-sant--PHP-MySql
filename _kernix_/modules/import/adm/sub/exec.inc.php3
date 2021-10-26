<?php

function insert_page($parent,$pagename,$price,$where="END")
{
  global $c_db, $table_ref, $table_product;

  $sql = "SELECT * FROM $table_ref WHERE idref = $parent";
  $c_db->query($sql);
  $parent = $c_db->object_result();
  if ($where == "END")
  {
    $sql = "SELECT * FROM $table_ref WHERE up = $parent ORDER BY idorder DESC LIMIT 1";
    $c_db->query($sql);
    $prec = $c_db->object_result();
    $l_key = calc_newnodekey($prec->nodekey);
    $l_idorder = $prec->idorder+1;
    $sql = "INSERT INTO $table_ref (name,nodekey,idorder,next,prev,up) VALUES ('$pagename','$l_key',$l_idorder,0,$prec->idref,$parent)";
    $c_db->query($sql);
    $l_idref = $c_db->get_id();
    $sql = "UPDATE $table_ref SET next=$l_idref WHERE idref=$prec->idref";
    $c_db->query($sql);
    $sql = "UPDATE $table_ref SET nbsubref=nbsubref+1 WHERE idref=$parent";
    $c_db->query($sql);
    $out['idref'] = $l_idref;
    $out['idproduct'] = 0;
    if ($price > 0)
    {
      $sql = "INSERT INTO $table_product (price) VALUES ($price)";
      $c_db->query($sql);
      $l_idproduct = $c_db->get_id();
      $out['idproduct'] = $l_idproduct;
      $sql = "UPDATE $table_ref SET idproduct=$l_idproduct WHERE idref=$l_idref";
      $c_db->query($sql);
    }
  }
  return $out;
}

function tab2upd($t)
{
  $sep = '';
  $out = '';
  foreach ($t as $k => $v)
    {
      $out .= "$sep $k='$v'";
      $sep = ',';
    }
  return $out;
}


$l_base = "/home/web/$g_accountname/www/upload/files";

$page['up'] = '';
$page['name'] = '';
$page['title'] = '';
$page['keywords'] = '';
$page['description'] = '';
$page['content'] = '';
$page['data'] = '';
$page['picture'] = '';
$page['icon'] = '';
$page['idproperty'] = '10';

$product['productinfo'] = ''; 
$product['idtaxes'] = ''; 
$product['idcurrency'] = ''; 
$product['idport'] = ''; 
$product['idsupplier'] = '1'; 
$product['stock'] = '100'; 
$product['price'] = ''; 
$product['productcode'] = ''; 
$product['oldprice'] = ''; 
$product['purchaseprice'] = ''; 
$product['portvalue'] = '1'; 

$toto = $page;

$toto['idproperty'] = 2;


$row = 1;
$handle = fopen ("$l_base/$p_file","r") or die("pas de fichier");
if ($p_sep == 'TAB') $p_sep = "\t";
while ($data = fgetcsv ($handle, 5000, $p_sep)) 
{
  $pg = $page;
  $pd = $product;

// cette zone ainsi que les 2 tableaux plus haut doivent être modifiés
  $pg['up'] = $data['0'];
  $pg['name'] = $data['2'];
  $pg['title'] = $data['2'];
  $pg['keywords'] = addslashes($data['2'].", ".$data['1'].", ".$data['8']);
  $pg['content'] = addslashes($data['9']);
  $pg['data'] = addslashes("AUT;;auteur;;{$data['1']}&&TIT;;titre;;{$data['2']}&&DAT;;date;;{$data['10']}&&EDI;;éditeur;;{$data['3']}&&COL;;collection;;{$data['4']}&&FOR;;format;;{$data['5']}&&COLLA;;collation;;{$data['6']}&&REL;;reliure;;{$data['7']}&&COM;;commentaire;;");
  $pg['picture'] = $data['14'];
  $pg['icon'] = $data['13'];

  $pd['price'] = ereg_replace(',','.',$data['11']);

// --------------------------------------------------------------------

  if ($p_testflag)
  { 
    fclose ($handle);
    echo "<pre align=left>\n";
    print_r($pg);
    echo "<hr>";
    print_r($pd);
    echo "</pre>\n";
    return 1;
  }

/*  $num = count ($data);
  print "<p> $num fields in line $row: <br>\n";
  $row++;
  for ($c=0; $c < $num; $c++) 
  {
    print $data[$c] . "<br>\n";
  }*/

  $t = insert_page($pg['up'], $pg['name'], $pd['price']);
  $s = tab2upd($pg);
  $sql = "UPDATE $table_ref SET $s WHERE idref = ".$t['idref'];
  $c_db->query($sql);
  $s = tab2upd($pd);
  $sql = "UPDATE $table_ref SET $s WHERE idref = ".$t['idproduct'];
  $c_db->query($sql);

}
fclose ($handle);


?>

