<?php
switch ($p_caddiecookieaction)
{
  
 case "add" :
   
   if ( !(($p_quantity > 0) && ($p_fromref > 0)) ) return 2;

   $l_sql = "SELECT R.idref, R.name, R.icon, P.* FROM $table_ref AS R, $table_product AS P WHERE R.idref = '$p_fromref' AND R.idproduct = P.idproduct";
   $c_db->query($l_sql);
   $ref = $c_db->object_result();

   $ref->price = $p_prix;

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

//   $l_description = addslashes($ref->name . " $ref->productinfo");
   $l_description = addslashes(urldecode($p_description));
   $l_options   =  $p_dateresa ."!". $p_codepoche ."!". $p_codeparc;
   if (isset($p_tabopt))
   {
     $l_options   =  addslashes(make_options());
   }
//   $l_description = strtr($l_description,"'\"","  ");
//   $l_options     = strtr($l_options,"'\"","  ");


   $l_icon = $ref->icon;
   $l_idsupplier = $ref->idsupplier;
   
   $l_sql = "DELETE FROM $table_session WHERE numsession = '$g_numsession'";
   $c_db->query($l_sql);
   $l_sql = "INSERT INTO $table_session (numsession,status,idref,idproduct,productcode,quantity,options,description,priceht,pricettc,purchasepriceht,taxe,currency,idport,portvalue,idsupplier,icon,date) VALUES ('$g_numsession','2','$p_fromref','$ref->idproduct','$ref->productcode','$p_quantity','$l_options','$l_description','$l_priceht','$l_pricettc','$l_purchasepriceht','$taxe->rate','$l_currency','$l_idport','$l_portvalue','$l_idsupplier','$l_icon','$l_date')";
   $c_db->query($l_sql);

   break;
}
?>
