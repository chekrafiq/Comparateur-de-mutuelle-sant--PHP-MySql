<?php

function insert_page($idparent,$pagename,$price,$where="END")
{
  global $c_db, $table_ref, $table_product;

  if ($idparent<=0) return -1;

  $sql = "SELECT * FROM $table_ref WHERE idref = $idparent";
  $c_db->query($sql);
  $parent = $c_db->object_result();
  if ($where == "END")
  {
    $sql = "SELECT * FROM $table_ref WHERE up = $idparent ORDER BY idorder DESC LIMIT 1";
    $c_db->query($sql);
    $prec = null;
    if ($c_db->numrows>0)
    {    
      $prec = $c_db->object_result();
      $l_prev = $prec->idref;
      $l_idorder = $prec->idorder;
      $l_key = calc_newnodekey($prec->nodekey);
    }
    else 
    {
      $l_prev = 0;
      $l_idorder = 1;
      $l_key = $parent->nodekey."01";
    }

    $l_idorder++;
    $sql = "INSERT INTO $table_ref (name,nodekey,idorder,next,prev,up) VALUES ('$pagename','$l_key',$l_idorder,0,$l_prev,$idparent)";
    $c_db->query($sql);
    $l_idref = $c_db->get_id();
//    echo "$sql<br>[ $idparent - $l_idref ]<hr>";
    if ($prec)
    {
      $sql = "UPDATE $table_ref SET next=$l_idref WHERE idref=$prec->idref";
      $c_db->query($sql);
    }
    $sql = "UPDATE $table_ref SET nbsubref=nbsubref+1 WHERE idref=$idparent";
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


// attention bcp de val en null = no
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
$product['port_value'] = '1'; 


$row = 1;
$handle = fopen ("$l_base/$p_file","r") or die("pas de fichier");
if ($p_sep == 'TAB') $p_sep = "\t";

$nbp = 0;

while ($data = fgetcsv ($handle, 5000, $p_sep)) 
{
  $pg = $page;
  $pd = $product;

  $k = 0;
  foreach ($data as $val)
    {
      $data[$k] = addslashes($val);
      $k++;
    }

  if (sizeof($data)<=2)
  {
    echo (sizeof($data)." - PB ... le caractère de separation ne doit pas être bon");
    continue;
  }
// cette zone ainsi que les 2 tableaux plus haut doivent être modifiés
  $pg['up'] = $data['0'];
  $pg['name'] = $data['3'];
  $pg['title'] = $data['3'];
  $pg['keywords'] = $data['3'].", ".$data['2'].", ".$data['9'];
  $pg['content'] = $data['10'];
  $pg['data'] = "AUT;;auteur;;{$data['2']}&&TIT;;titre;;{$data['3']}&&DAT;;date;;{$data['11']}&&EDI;;éditeur;;{$data['4']}&&COL;;collection;;{$data['5']}&&FOR;;format;;{$data['6']}&&COLLA;;collation;;{$data['7']}&&REL;;reliure;;{$data['8']}&&COM;;commentaire;;";
  $pg['picture'] = $data['15'];
  $pg['icon'] = $data['14'];

  $pd['productcode'] = ereg_replace(',','.',$data['1']);
  $pd['price'] = ereg_replace(',','.',$data['12']);

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

  $t = insert_page($pg['up'], $pg['name'], $pd['price']);
  if ($t == -1) 
  {
    echo "PB avec [".$pg['name']."],";
    continue;
  }
  if ($p_showflag) echo $t['idref'].", ";
  $s = tab2upd($pg);
  $sql = "UPDATE $table_ref SET $s WHERE idref = ".$t['idref'];
  $c_db->query($sql);
  $s = tab2upd($pd);
  $sql = "UPDATE $table_product SET $s WHERE idproduct = ".$t['idproduct'];
  $c_db->query($sql);
  echo $sql."<br>";

  $nbp++;

}
fclose ($handle);

show_response("< $nbp > pages importées");

?>

