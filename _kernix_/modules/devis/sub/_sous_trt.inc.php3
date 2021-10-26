<?php
if ($p_devissubaction == "next")
{
	if ($p_etape==1)
	{
		ksort($tab_sous2);
		foreach($tab_sous2 as $skey => $sval)
		{
			$l_sql = "SELECT * FROM $table_session WHERE numsession = ".$tab_sous["idsession"]." AND productcode = '$p_selectformule'";
			$c_db->query($l_sql);
			$selectsession = $c_db->object_result();
			$l_sql = "DELETE FROM $table_session WHERE numsession = ".$tab_sous["idsession"]." AND idsession <> $selectsession->idsession";
			$c_db->query($l_sql);
			$l_agisajout = 0;
			if ($selectsession->options) $l_agisajout = 7;
			$l_sql = "UPDATE $table_command SET priceht = '$selectsession->priceht', pricettc = '$selectsession->pricettc', pricettcport = '".($selectsession->pricettc + $l_agisajout)."' WHERE idcommand = '".$tab_sous["idcommand"]."'";
			$c_db->query($l_sql);

			if (!isset($sval["nom"])) $tab_sous2[$skey]["nom"] = "";
			if (!isset($sval["prenom"])) $tab_sous2[$skey]["prenom"] = "";
			if (!isset($sval["nai"])) $tab_sous2[$skey]["nai"] = "";
			if ($skey == 1 && !isset($sval["titre"])) $tab_sous2[$skey]["titre"] = "";
			if ($skey == 1 && !isset($sval["cplident"])) $tab_sous2[$skey]["cplident"] = "";
			if ($skey == 1 && !isset($sval["numero"])) $tab_sous2[$skey]["numero"] = "";
			if ($skey == 1 && !isset($sval["rue"])) $tab_sous2[$skey]["rue"] = "";
			if ($skey == 1 && !isset($sval["res"])) $tab_sous2[$skey]["res"] = "";
			if ($skey == 1 && !isset($sval["lieudit"])) $tab_sous2[$skey]["lieudit"] = "";
			if ($skey == 1 && !isset($sval["cp"])) $tab_sous2[$skey]["cp"] = "";
			if ($skey == 1 && !isset($sval["ville"])) $tab_sous2[$skey]["ville"] = "";
			if ($skey == 1 && !isset($sval["tel"])) $tab_sous2[$skey]["tel"] = "";
			if ($skey == 1 && !isset($sval["telpro"])) $tab_sous2[$skey]["telpro"] = "";
			if ($skey == 1 && !isset($sval["fax"])) $tab_sous2[$skey]["fax"] = "";
			if ($skey == 1 && !isset($sval["statut"])) $tab_sous2[$skey]["statut"] = "";
			if ($skey == 1 && !isset($sval["enfantacharge"])) $tab_sous2[$skey]["enfantacharge"] = "";
			if ($skey <= 10 && !isset($sval["secu"])) $tab_sous2[$skey]["secu"] = "";
			if ($skey <= 10 && !isset($sval["cle"])) $tab_sous2[$skey]["cle"] = "";
			if ($skey <= 10 && !isset($sval["codegr"])) $tab_sous2[$skey]["codegr"] = "";
			if ($skey <= 10 && !isset($sval["codec"])) $tab_sous2[$skey]["codec"] = "";
			//if ($skey <= 10 && $sval["regime"] == "T.N.S." && !isset($sval["tns"])) $tab_sous2[$skey]["tns"] = "";
		}
		$p_etape = 2;
		$MYSESSION["sous2"] = $tab_sous2;
	}
	elseif ($p_etape==2)
	{
		$l_error = 0;
		foreach($tab_sous2 as $skey => $sval)
		{
			foreach($sval as $sskey => $ssval)
			{
				if (isset(${"p_".$skey."_".$sskey})) $tab_sous2[$skey][$sskey] = ${"p_".$skey."_".$sskey};
			}
		}
		$tab_champs = array("codegr", "codec", "cplident", "numero", "res", "lieudit", "telpro", "fax", "enfantacharge", "pref");
		foreach($tab_sous2 as $skey => $sval)
		{
			foreach($sval as $sskey => $ssval)
			{
				if (!$ssval && !in_array($sskey, $tab_champs)) {
$l_error = 1;
 echo "<!-- error : $sskey : $ssval -->"; 
				}
				if ($sskey == "secu" && (!is_numeric($ssval) || stristr($ssval,'.') || strlen($ssval)!=13)) $l_error = 2;
				if ($sskey == "cle" && (!is_numeric($ssval) || stristr($ssval,'.') || strlen($ssval)!=2)) $l_error = 3;
				if ($sskey == "cp" && $sval["dept"] != ltrim(substr($ssval, 0, 2), "0")) $l_error = 5;
			}
		}
		if (!is_valid_email($tab_sous2[1]["email"])) $l_error = 4;

		$MYSESSION["sous2"] = $tab_sous2;
		if ($l_error >= 1)
		{
			$p_etape = 2;
		}
		else
		{
			$p_etape = 3;
			$l_sql = "UPDATE $table_client SET title = '".$tab_sous2[1]["titre"]."', firstname = '".$tab_sous2[1]["prenom"]."', lastname = '".$tab_sous2[1]["nom"]."', email1 = '".$tab_sous2[1]["email"]."', phone = '".$tab_sous2[1]["tel"]."', address = '".$tab_sous2[1]["numero"]." ".$tab_sous2[1]["rue"]." - ".$tab_sous2[1]["res"]." - ".$tab_sous2[1]["lieudit"]."', zipcode = '".$tab_sous2[1]["cp"]."', town = '".$tab_sous2[1]["ville"]."', workphone = '".$tab_sous2[1]["telpro"]."', fax = '".$tab_sous2[1]["fax"]."', flagpref='".$tab_sous2[1]["pref"]."', date = '$l_date', idportzone = 1 WHERE idclient = ".$tab_sous["idclient"];
			//echo "$l_sql";
			$c_db->query($l_sql);

			$l_sql = "SELECT * FROM $table_command WHERE idcommand = ".$tab_sous["idcommand"];
			$c_db->query($l_sql);
			$command = $c_db->object_result();
			$l_sql = "SELECT * FROM $table_session WHERE numsession = ".$tab_sous["idsession"];
			$c_db->query($l_sql);
			$session = $c_db->object_result();
		}
	}
	elseif ($p_etape==3)
	{
		$l_sql = "SELECT * FROM $table_command WHERE idcommand = ".$tab_sous["idcommand"];
		$c_db->query($l_sql);
		$command = $c_db->object_result();
		$l_sql = "SELECT * FROM $table_session WHERE numsession = ".$tab_sous["idsession"];
		$c_db->query($l_sql);
		$session = $c_db->object_result();
		$l_error = 0;
		if ($p_codeclient) $tab_sous["codeclient"] = $p_codeclient;
		if ($p_dateeffet) $tab_sous["dateeffet"] = $p_dateeffet;
		else $l_error = 1;
		if ($p_mp) $tab_sous["mp"] = $p_mp;
		else $l_error = 2;
		if ($tab_sous["mp"] == "cb" || $tab_sous["mp"] == "pa")
		{
			$tab_sous["prelevement"] = $p_prelevement;
			$tab_sous["rib_banque"] = $p_rib_banque;
			$tab_sous["rib_guichet"] = $p_rib_guichet;
			$tab_sous["rib_compte"] = $p_rib_compte;
			$tab_sous["rib_cle"] = $p_rib_cle;
			if (!$p_rib_banque || !$p_rib_guichet || !$p_rib_compte || !$p_rib_cle) $l_error = 3;
		}
		$MYSESSION["sous"] = $tab_sous;
		if ($l_error >= 1)
		{
			$p_etape = 3;
		}
		else
		{
			ob_start();
			echo "### Informations Souscription ###\n";
			print_r($tab_sous2);
			echo "\n\n### Informations Paiement ###\n";
			print_r($tab_sous);
			$l_description = "\n"."### Informations Devis ###\n".$session->description . ob_get_contents();
			ob_end_clean();
			if ($tab_sous["mp"] == "ch6" || $tab_sous["mp"] == "ch12")
			{
				$l_nbm = ($tab_sous["mp"] == "ch6") ? 6 : 12 ;
				$l_newprice = $l_nbm * $session->pricettc;

				$l_sql = "UPDATE $table_session SET quantity = ".$l_nbm.", description = '$l_description' WHERE numsession = '".$tab_sous["idsession"]."'";
				$c_db->query($l_sql);
				$l_agisajout = 0;
				if ($selectsession->options) $l_agisajout = 7;

				$l_sql = "UPDATE $table_command SET priceht = '".($l_newprice/1.196)."', pricettc = '$l_newprice', pricettcport = '".($l_newprice + $l_agisajout)."' WHERE idcommand = '".$tab_sous["idcommand"]."'";
				$c_db->query($l_sql);
			}
			else
			{
				$l_sql = "UPDATE $table_session SET description = '$l_description' WHERE numsession = '".$tab_sous["idsession"]."'";
				$c_db->query($l_sql);
			}
			if ($tab_sous["mp"] == "ch6" || $tab_sous["mp"] == "ch12") $l_paymentmode = "CHQ";
			elseif ($tab_sous["mp"] == "pa") $l_paymentmode = "PRE";
?>
  <form method="POST" action="<?= $g_externpath . "/payment/exec.php3"?>" name="exec" id="exec">
   <input type=hidden name="p_paymentmode"        value="<?=$l_paymentmode?>">
   <input type=hidden name="p_fromref"            value="<?=$p_idref?>">
  </form>
<SCRIPT LANGUAGE=JAVASCRIPT>
document.exec.submit()
</script>
<?php
$p_etape = 2;
		}
	}
	else
	{
		$p_etape = 2;
	}
}

if ($p_devissubaction=="prev")
{
	$p_etape--;
}
?>
