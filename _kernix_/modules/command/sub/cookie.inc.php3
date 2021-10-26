<?php

// VARS : caddie numsession nbrref sumref


if (($p_caddiecookieaction == "storenumsession"))
{
  $c_cookie->put("numsession",$p_numsession);
  $g_numsession = $p_numsession;
 return 1;
}


function make_options()
{
  global $p_tabopt;

  return (join("&",$p_tabopt));
}

// recupération du numero de session

if ( !(($g_numsession = $c_cookie->search("numsession")) > 0) && ($p_caddiecookieaction != "command"))
{
  if ($p_caddiecookieaction != "add")
  { 
    header("Location: $g_urldyn?p_idref=$p_fromref&p_parc=$p_parc&p_poche=$p_poche"); 
    return 0;
  }
  $l_sql = "INSERT INTO $table_numsession (idvisitor,date) VALUES ('$g_idvisitor','$l_date')";
  $c_db->query($l_sql);
  $g_numsession = $c_db->get_id();
  $c_cookie->put("numsession",$g_numsession);
}

switch ($p_caddiecookieaction)
{

 case "null" : 

   break;

 case "add" :

   include("cookie_sceta.inc.php3");
/*
   if ( !(($p_quantity > 0) && ($p_fromref > 0)) ) return 2;

   $l_sql = "SELECT R.idref, R.name, R.icon, P.* FROM $table_ref AS R, $table_product AS P WHERE R.idref = '$p_fromref' AND R.idproduct = P.idproduct";
   $c_db->query($l_sql);
   $ref = $c_db->object_result();

   if ($ref->price == 0) return 3;
   if ($adm->stockmodeflag == 1)
   {
     if ($p_quantity > $ref->stock) return 4; 
     if ((($ref->stock - $p_quantity) <= $adm->stocklimit) && $adm->stocklimit && ($g_sendflag == 1))
     {
       mail($adm->email,"stock critique : $ref->name [$ref->idref]"," #code $ref->productcode : stock = $ref->stock\n - $p_quantity commande(s)","From: KWO <$adm->email>\nErrors-to: $adm->email\n");
     }
   }

   $l_idtaxe = get_proper_taxe($ref, $adm);
   $l_sql    = "SELECT rate FROM $table_taxes WHERE idtaxes = '$l_idtaxe'";
   $c_db->query($l_sql);
   $taxe     = $c_db->object_result();

   if ($adm->idpriceentermode == 1) 
   { 
     // mode HT
     $l_priceht  = $ref->price;
     $l_pricettc = calc_taxe($ref->price, $taxe->rate, 1); 
   }
   else
   {
     // mode TTC
     $l_pricettc = $ref->price;
     $l_priceht  = calc_taxe($ref->price, $taxe->rate, -1);
   }
   
   $l_purchasepriceht  = $ref->purchaseprice;

   $l_sql = "SELECT isocode FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
   $c_db->query($l_sql);
   $l_currency = $c_db->result(0,"isocode");
   
   $l_idcurrency    = get_proper_currency($ref, $adm);
   if ($adm->idcurrency != $l_idcurrency)
   {
     $l_sql           = "SELECT value FROM  $table_currency WHERE idcurrency = '$l_idcurrency'";
     $c_db->query($l_sql);
     $l_currencyvalue = $c_db->result(0,"value");
     $l_pricettc     *= $l_currencyvalue;
     $l_priceht      *= $l_currencyvalue;
   }

   $l_idport      = $ref->idport;
   $l_portvalue   = $ref->port_value;

   $l_description = addslashes($ref->name . " $ref->productinfo");
   if (isset($p_tabopt))
   {
     $l_options   =  addslashes(make_options());
   }
//   $l_description = strtr($l_description,"'\"","  ");
//   $l_options     = strtr($l_options,"'\"","  ");


   $l_icon = $ref->icon;
   $l_idsupplier = $ref->idsupplier;
   
   $l_sql = "INSERT INTO $table_session (numsession,status,idref,idproduct,productcode,quantity,options,description,priceht,pricettc,purchasepriceht,taxe,currency,idport,portvalue,idsupplier,icon,date) VALUES ('$g_numsession','2','$p_fromref','$ref->idproduct','$ref->productcode','$p_quantity','$l_options','$l_description','$l_priceht','$l_pricettc','$l_purchasepriceht','$taxe->rate','$l_currency','$l_idport','$l_portvalue','$l_idsupplier','$l_icon','$l_date')";
   $c_db->query($l_sql);

*/

   break;

 case "chgq" :
 
   if (!($p_fromref > 0)) return 2;

   $l_sql = "SELECT R.idref, R.name, R.icon, P.* FROM $table_ref AS R, $table_product AS P WHERE R.idref = '$p_fromref' AND R.idproduct = P.idproduct";
   $c_db->query($l_sql);
   $ref = $c_db->object_result();
   
   if ($p_quantity == 0)
   {
     $l_sql = "DELETE FROM $table_session WHERE idsession = '$p_idsession' AND status < '4'";
     $c_db->query($l_sql);
     $l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession'";
     $c_db->query($l_sql);
     if ($c_db->numrows == 0)
     { 
       $c_cookie->rm("numsession");
       header("Location: $g_urldyn?p_idref=$p_fromref");
     }
   }
   else
   {
     if ($adm->stockmodeflag == 1)
     {
       $g_cookiemsg     .= " - q=$p_quantity # s=$ref->stock, $ref->name, $ref->icon, $p_fromref -";
       if ($p_quantity > $ref->stock) return 4;
       if ((($ref->stock - $p_quantity) <= $adm->stocklimit) && $adm->stocklimit && ($g_sendflag == 1))
       {
	 mail($adm->email,"stock critique : $ref->name [$ref->idref]"," #code $ref->productcode : stock = $ref->stock\n - $p_quantity commande(s)","From: KWO <$adm->email>\nErrors-to: $adm->email\n");
       }
     }
     $l_sql = "UPDATE $table_session SET status = '2', quantity = '$p_quantity' WHERE idsession = '$p_idsession' AND status < '4'";
     $c_db->query($l_sql);
   }
   break;

// sub n'est plus utilisé, il faut mettrequantité à zero

 case "sub" :

   $l_sql = "DELETE FROM $table_session WHERE idsession = '$p_idsession' AND status < '4'";
   $c_db->query($l_sql);
   $l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession'";
   $c_db->query($l_sql);
   if ($c_db->numrows == 0)
   { 
     $c_cookie->rm("numsession");
     header("Location: $g_urldyn?p_idref=$p_fromref");
   }
   break;

 case "empty":
   $l_sql = "UPDATE $table_command SET status = '2' WHERE numsession = '$g_numsession' AND status < '4'";
   $c_db->query($l_sql);
   $l_sql = "UPDATE $table_session SET status = '2' WHERE numsession = '$g_numsession' AND status < '4'";
   $c_db->query($l_sql);
   $c_cookie->rm("numsession");
   header("Location: $g_urldyn?p_idref=$p_fromref&p_parc=$p_parc&p_poche=$p_poche");
   break;

 case "command":
   $c_cookie->rm("numsession");
   break;

}

return 1;

?>
