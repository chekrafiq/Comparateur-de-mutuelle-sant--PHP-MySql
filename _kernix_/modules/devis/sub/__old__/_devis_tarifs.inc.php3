<?php
$l_reducfamcoef = 0.93;

if ($p_etape == 6){
  $l_prix = 0;
  $l_prixini = 0;
  if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
  else $l_nbadulte = 1;
  $l_msg = "";
  $l_rem = "";

  $tab_gamme = array();
  //$tab_gamme[1]["formule"] = array("M01", "P01", "P02", "P03", "P04", "P05");
  $tab_gamme[1]["formule"] = array("F01", "F02", "M01", "P02", "P03", "P04", "P05");
  //$tab_gamme[1]["formule"] = array("M01", "P01", "P02");
  //$tab_gamme[2]["formule"] = array("P03", "P04", "P05");
  //$tab_gamme[3]["formule"] = array("P06");
  //$tab_gamme[3]["formule"] = array("P06", "P07");

  $tab_gamme_senior = array("S01", "S02", "S03");

  $tab_devis = array();

  $l_titlestr = "cliquez ici pour voir cette formule en détail";
  $tab_gammen = array(
  "F01"=>"<span class='pdf'>Swiss Santé Astucieuses - Formule F1</span><br>",
  "F02"=>"<span class='pdf'>Swiss Santé Astucieuses - Formule F2</span><br>",
  "M01"=>"<span class='pdf'>Swiss Santé Minimale</span><br>Une mutuelle santé avec des garanties efficaces, à hauteur du ticket modérateur en secteur conventionné, et à tarif très compétitif.",
  "P01"=>"<span class='pdf'>Swiss Santé Principale - Formule P1</span><br>Tarifs très compétitifs - Formule mutuelle sans questionnaire de santé, sans délai d'attente (- 66 ans).",
  "P02"=>"<span class='pdf'>Swiss Santé Principale - Formule P2</span><br>Formule mutuelle sans questionnaire de santé, sans délai d'attente (- 66 ans) avec la chambre particulière en frais réels en durée illimitée.",
  "P03"=>"<span class='pdf'>Swiss Santé Principale - Formule P3</span><br>Formule mutuelle sans questionnaire de santé, sans délai d'attente (- 66 ans) avec le remboursement renforcé en optique et dentaire.",
  "P04"=>"<span class='pdf'>Swiss Santé Principale - Formule P4</span><br>Formule mutuelle sans questionnaire de santé, sans délai d'attente (- 66 ans) avec le remboursement des honoraires médicaux au-delà du ticket modérateur.",
  "P05"=>"<span class='pdf'>Swiss Santé Principale - Formule P5</span><br>Formule mutuelle sans questionnaire de santé, sans délai d'attente (- 66 ans) avec la prise en charge de nombreuses dépenses non remboursées par la sécurité sociale.",
  //"P06"=>"<span class='pdf'>Swiss Santé Principale - Formule P6</span><br>Une formule de mutuelle santé haut-de-gamme avec des garanties renforcées sur tous les postes.",
  //"P07"=>"<span class='pdf'>Swiss Santé Principale - Formule P7</span><br>Formule mutuelle la plus haute de Swiss Life avec des remboursements optimums."
  "S01"=>"<span class='pdf'>Swiss Santé, Génération Vitalité - Formule 1</span><br>",
  "S02"=>"<span class='pdf'>Swiss Santé, Génération Vitalité - Formule 2</span><br>",
  "S03"=>"<span class='pdf'>Swiss Santé, Génération Vitalité - Formule 3</span><br>"
  );


  $tab_gammens = array(
  "M01"=>"<a href='/?p_idref=25' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Minimale [en savoir +]</a><br>Une mutuelle santé avec des garanties efficaces, à hauteur du ticket modérateur en secteur conventionné, et à tarif très compétitif.",
  "P01"=>"<a href='/?p_idref=65' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Principale - Formule P1 [en savoir +]</a><br>Avec Swiss Santé, même si je n'ai plus 20 ans, on m'assure immédiatement !",
  "P02"=>"<a href='/?p_idref=65' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Principale - Formule P2 [en savoir +]</a><br>Les complémentaires Swiss Santé vous protègent dès votre souscription. Cette formule de mutuelle complète efficacement les remboursements de votre régime obligatoire.",
  "P03"=>"<a href='/?p_idref=65' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Principale - Formule P3 [en savoir +]</a><br>Souscription de votre mutuelle sans aucun délais d'attente, vous pouvez souscrire jusqu'à 80 ans.",
  "P04"=>"<a href='/?p_idref=65' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Principale - Formule P4 [en savoir +]</a><br>Aves Swiss Santé, nous considérons qu'une bonne complémentaire santé doit s'adapter aux besoins de chacun.",
  "P05"=>"<a href='/?p_idref=65' target='_blanck' class='pdf' title='$l_titlestr'>Swiss Santé Principale - Formule P5 [en savoir +]</a><br>Cette formule de mutuelle santé vous apporte le confort attendu pour protéger votre santé.");

  // IDREF DES PAGES DU SITE PRESENTANT LES GARANTIES
  $tab_gamgr = array(
  "F01"=>"159",
  "F02"=>"159",
  "M01"=>"25",
  "P01"=>"65",
  "P02"=>"65",
  "P03"=>"65",
  "P04"=>"65",
  "P05"=>"65",
  //"P06"=>"65",
  //"P07"=>"65"
  "S01"=>"164",
  "S02"=>"164",
  "S03"=>"164"
  );

  $tab_lgamme = array();
  $g_reducfam = 0;
  for ($i=1;$i<=$l_nbadulte;$i++)
  {
    $vl_coef = 1;
    $l_msg = "";
    $l_rem = "";
    $l_limite = "";

    //if ($tab_params[$i."_age"] > 65 && $tab_params[$i."_gamme"] == 3) $l_msg .= "Swiss Santé seniors ne comporte pas de formule haut de gamme.<br />";

    //if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3){
    if ($tab_params[$i."_age"] > 65){
      if ($tab_params[$i."_q1"] == 1) $l_msg .= "[Q1] Réponse positive : non assurable.<br />";

      //if ($tab_params[$i."_q2"] == 1 && $tab_params[$i."_gamme"] == 3) $l_msg .= "[Q2] Réponse positive : non assurable.<br />";

      if ($tab_params[$i."_q2"] == 1 && $tab_params[$i."_age"] > 65){
        $l_rem .= "[Q3] Réponse positive : chambre particulière et forfait hospitalier indemnisés 30j/an.<br />";
        //if ($tab_params[$i."_gamme"] == 2) $l_limite = "P03";
      }

      //if ($tab_params[$i."_q3"] == 1 && $tab_params[$i."_gamme"] == 3) $l_msg .= "[Q3] Réponse positive : non assurable.<br />";
      //else
      if ($tab_params[$i."_q3"] == 1 && $tab_params[$i."_age"] > 65){
        $l_rem .= "[Q3] Réponse positive : chambre particulière et forfait hospitalier indemnisés 30j/an.<br />";
        //if ($tab_params[$i."_gamme"] == 2) $l_limite = "P03";
      }

      //if ($tab_params[$i."_q4"] == 1 && $tab_params[$i."_gamme"] == 3) $vl_coef += 0.2;
      //if ($tab_params[$i."_q4"] == 1 && $tab_params[$i."_age"] > 65 && $tab_params[$i."_gamme"] == 2) $l_limite = "P03";

      //if ($tab_params[$i."_q5"] == 1 && $tab_params[$i."_gamme"] == 3) $vl_coef += 0.2;
      //if ($tab_params[$i."_q5"] == 1 && $tab_params[$i."_age"] > 65 && $tab_params[$i."_gamme"] == 2) $l_limite = "P03";

      //if (($tab_params[$i."_q61"] / ($tab_params[$i."_q62"] - 100)) >= 1.66 && $tab_params[$i."_gamme"] == 3) $l_msg .= "[Q6] Votre dossier nécessite une étude spécifique.<br />";
      //if (($tab_params[$i."_q61"] / ($tab_params[$i."_q62"] - 100)) >= 1.66 && $tab_params[$i."_age"] > 65 && $tab_params[$i."_gamme"] == 2) $l_limite = "P03";

      //if ($tab_params[$i."_q7"] == 1 && $tab_params[$i."_gamme"] == 3) $l_msg .= "[Q7] Réponse positive : non assurable.<br />";

      //if ($tab_params[$i."_q8"] == 1 && $tab_params[$i."_gamme"] == 3) $l_rem .= "[Q8] Réponse positive : les plafonds sont réduit de moitié en années 1 & 2 (à diviser par 2).<br />";
    }
    $tab_devis[$i."_msg"] = $l_msg;
    $tab_devis[$i."_rem"] = $l_rem;

    $l_sql = "SELECT coef, coef2 FROM $table_zone WHERE dept = ".$tab_params[$i."_dept"];
    //error_log($l_sql);
    $c_db->query($l_sql);
    $l_coefzone = $c_db->result(0,0);
    $l_coefzone2 = $c_db->result(0,1);
    $tab_params[$i."_coefzone"] = $l_coefzone;
    $tab_params[$i."_coefzone2"] = $l_coefzone2;

    $vl_senior = "";
    if ($tab_params[$i."_age"] > 65){
      //$vl_senior = "V";
      $l_coefzone = $l_coefzone2;
      $tab_params[$i."_coefzone"] = $tab_params[$i."_coefzone2"];
      $tab_gamme[1]["formule"] = $tab_gamme_senior;
    }

    $vl_cm = 1;
    //if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3) $vl_cm = 1.07;

    $l_sql = "SELECT CodProd as formule, Prime as prix1 FROM $table_prix WHERE Age = ".$tab_params[$i."_age"]." AND CodProd IN ('";
    //if ($l_limite != "") $vl_ftab = array($tab_params[$i."_regime"].$l_limite.$vl_senior);
    //else{
    $vl_ftab = array();
    foreach ($tab_gamme[$tab_params[$i."_gamme"]]["formule"] as $fval) $vl_ftab[] = $tab_params[$i."_regime"].$fval.$vl_senior;
    //}

    $l_sql .= implode("','",$vl_ftab)."') AND Sexe = '".$tab_params[$i."_sexe"]."' ORDER BY CodProd";
    //error_log($l_sql);
    $c_db->query($l_sql);
    if ($c_db->numrows == 0) { $l_msg = "Pas de tarif pour $i<br />."; continue; }
    else{
      while ($obj_prix = $c_db->object_result()){
        if (substr($obj_prix->formule,1,3)=="F01" || substr($obj_prix->formule,1,3)=="F02"){
          // MAJ DE MAI 2010 SUR F01 ET F02
          // $tab_lgamme[substr($obj_prix->formule,1,3)]  = $obj_prix->prix1/12;
          if($tab_params[$i."_age"]==20 && $tab_params[$i."_sexe"]=='H'){
            error_log("test ".$tab_params[$i."_age"]."==20 && ".$tab_params[$i."_sexe"]."==H");
            if (substr($obj_prix->formule,1,3)=="F01") $tab_lgamme[substr($obj_prix->formule,1,3)]  = $obj_prix->prix1 / 12 * 1.02;
            else  $tab_lgamme[substr($obj_prix->formule,1,3)]  = $obj_prix->prix1 / 12 * 1.028;
            error_log("formule=".substr($obj_prix->formule,1,3)." prix ini=".($obj_prix->prix1/12)." prix corrigé=".$tab_lgamme[substr($obj_prix->formule,1,3)]);
          }else{
            $tab_lgamme[substr($obj_prix->formule,1,3)]  = $obj_prix->prix1 / 12 * 1.028;
            //error_log("formule=".substr($obj_prix->formule,1,3)." prix ini=".($obj_prix->prix1/12)." prix corrigé=".$tab_lgamme[substr($obj_prix->formule,1,3)]);
          }
        } else {
          $tab_lgamme[substr($obj_prix->formule,1,3)]  = $obj_prix->prix1 / 12 * $l_coefzone * $vl_cm;
          //error_log("formule=".substr($obj_prix->formule,1,3)."  prix=".$obj_prix->prix1 / 12 * $l_coefzone * $vl_cm);
        }
      }
      foreach($tab_lgamme as $lgkey => $lgval){
        //echo "Prix intermed : $vl_prix &euro;<br />";
        $tab_devis[$i."_prix_".$lgkey] = $lgval;
        $tab_devis[$i."_coef_".$lgkey] = $vl_coef;

        $tab_devis["formule_".$lgkey] += ($lgval * $vl_coef);
        if ($tab_params[$i."_agis"] == 1){
          //echo "Prix AGIS : 7 &euro;<br />";
          $tab_devis["formule_ini_".$lgkey] += 7;
          $tab_devis[$i."_prix_ini_".$lgkey] = 7;
        }
        $l_nb1 = 0;
        $l_nb2 = 0;
        $l_reducfam = 0;
        //echo "Prix intermed $lgkey - $i<br />";
        for ($j=1;$j<=$tab_params["enfant"];$j++){
          if ($tab_params[($j+10)."_ad"] == $i){
            $l_reducfam = $lgkey;
            $g_reducfam = 1;
            $l_i = $tab_params[($j+10)."_ad"];
            ${"l_nb".$l_i}++;
            if (${"l_nb".$l_i} <= 2){
              $l_sql = "SELECT Prime FROM $table_prix WHERE Age = ".${"l_nb".$l_i}." AND CodProd = '".$tab_params[$i."_regime"]."$lgkey' AND Sexe = 'E'";
              //error_log($l_sql);
              $c_db->query($l_sql);
              if ($c_db->numrows == 0) { $l_msg .= "Pas de tarif pour $j<br />."; continue; }
              else{
                if ($lgkey=="F01" || $lgkey=="F02"){
                  // MAJ DE MAI 2010 SUR F01 ET F02
                  //$vl_prix = $c_db->result(0,0) / 12;
                  $vl_prix = $c_db->result(0,0) / 12 * 1.028;
                  //error_log("Enfant formule=".$lgkey." prix=".$vl_prix);
                }
                else $vl_prix = $c_db->result(0,0) / 12 * $l_coefzone;

                $tab_devis["formule_".$lgkey] += $vl_prix;
                $tab_devis[$i."_".($j+10)."_prix_".$lgkey] = $vl_prix;
                //echo "Prix intermed : $vl_prix &euro;<br />";
              }
            }
          }
        }
        /*
        if ($l_reducfam){
        //echo "Prix intermed $l_reducfam : $l_prix &euro;<br />";
        $tab_devis["formule_".$lgkey] *= $l_reducfamcoef;
        $tab_devis["formule_coef_".$lgkey] = $l_reducfamcoef;
        }
        */
      }
    }
  }
  if ($g_reducfam == 1){
    //echo "<pre>" ; print_r($tab_devis); echo "</pre>";
    foreach($tab_devis as $td_key => $td_val){
      if (substr($td_key,0,8) == "formule_" && substr($td_key,8,1) != "F"){
        //error_log("Reduc Famille formule=".substr($td_key,8)." reduc=".$l_reducfamcoef);
        $tab_devis[$td_key] *= $l_reducfamcoef;
        $tab_devis["formule_coef_".substr($td_key,8)] = $l_reducfamcoef;
      }
    }
    //echo "<pre>" ; print_r($tab_devis); echo "</pre>";
  }

  //echo "Prix intermed : $l_prix &euro;<br />";
  foreach($tab_lgamme as $lgkey => $lgval){
    $tab_devis["formule_".$lgkey] = round($tab_devis["formule_".$lgkey],2);
  }
  $MYSESSION["devis"] = $tab_devis;

  echo "<tr><td width='100%' class='contenu'>";

  $l_msg = "";
  for ($i=1;$i<=$l_nbadulte;$i++){
    if ($tab_devis[$i."_msg"]){
      $l_msg .= $tab_devis[$i."_msg"];
    }
  }
  if ($l_msg != ""){
    echo "<br />";
    echo "<strong>ATTENTION</strong>";
    echo "<br />";
    echo "<br />";
    echo "Les informations que vous nous avez indiquées ne nous permettent pas de vous donner un prix pour votre demande.";
    echo "<br />";
    echo "<br />";
    echo "<strong> $l_msg </strong>";
    echo "<br />";
    echo "<br />";
    echo "<br />";
  }else{
    $l_rem = "";
    for ($i=1;$i<=$l_nbadulte;$i++) if ($tab_devis[$i."_rem"]) $l_rem = "1";
    if ($l_rem != ""){
      echo "<strong>REMARQUES</strong>";
      echo "<br />";
      echo "<br />";
      for ($i=1;$i<=$l_nbadulte;$i++){
        if ($tab_devis[$i."_rem"]){
          echo "<strong><img src='".$g_modulespicturepath."/devis/picto_parent.gif' hspace='2' align='absmiddle'>";
          echo ($i==1 && ($tab_params["adulte"] == 1 || $tab_params["adulte"] == 3)) ? "Vous" : "Conjoint ou concubin";
          echo "</strong><br />";
          echo $tab_devis[$i."_rem"]."<br />";
        }
      }
      echo "</td></tr><tr><td align='center'><img src='$g_modulespicturepath/devis/encart_ligne.gif' width='435' height='2'><br/><br/></td></tr><tr><td width='100%' class='contenu'>";
    }

    echo "<strong>TARIFS</strong>";
    echo "<br />";
    echo "<br />";

    foreach($tab_lgamme as $lgkey => $lgval){
      echo "<input type='radio' name='p_selectformule' value='$lgkey'>&nbsp;";
      echo $tab_gammen[$lgkey];
      echo "<br />";
      echo "<br />";

      echo "<style>.lien_gar {color:#FC0019;}</style>";
      echo "&nbsp;<b>&#187; ".$tab_devis["formule_".$lgkey]." &euro; TTC / mois <a href='/?p_idref=".$tab_gamgr[$lgkey]."' target='_blanck' class='lien_gar'>[mon tableau de garantie]</a></b>";
      if ($tab_devis["formule_ini_".$lgkey] > 0) echo ", ".$tab_devis["formule_ini_".$lgkey]." &euro; TTC de droit d'entrée.";
      echo "<br />";
      echo "<br />";
      echo "<br />";
    }

    $l_sessiondescription = "";
    $l_sessiondescriptionmail = array();
    $l_detailencours = 0;
    ksort($tab_params);
    $tab_sous2 = array();
    foreach($tab_params as $pkey => $pval){
      $vl_tab = explode("_", $pkey);
      if (count($vl_tab) == 1){
        switch($pkey){
          case "adulte":
            $l_sessiondescription .= ($pval == 3) ? "2 adultes" : "1 adulte";
            $l_sessiondescriptionmail[0] .= ($pval == 3) ? "2 adultes" : "1 adulte";
            $l_sessiondescription .= "\n";
            break;
          case "enfant":
            $l_sessiondescription .= $pval . " enfant(s)";
            $l_sessiondescriptionmail[1] .= "et ".$pval." enfant(s)";
            $l_sessiondescription .= "\n";
            break;
        }
      }else{
        if ($vl_tab[0] == "infosdevis") continue;
        if ($l_detailencours != $vl_tab[0]){
          $l_detailencours = $vl_tab[0];
          $l_sessiondescription .= "Détails ";
          if ($vl_tab[0] < 10) $l_sessiondescription .= "adulte n° $l_detailencours :";
          else $l_sessiondescription .= "enfant n° " . ($l_detailencours - 10) . " :";
          $l_sessiondescription .= "\n";
        }
        switch($vl_tab[1]){
          case "sexe":
            $tab_sous2[$l_detailencours]["sexe"] = $pval;
            $l_sessiondescription .= "- sexe : $pval";
            $l_sessiondescription .= "\n";
            break;
          case "age":
            $tab_sous2[$l_detailencours]["age"] = $pval;
            $l_sessiondescription .= "- age : $pval";
            $l_sessiondescription .= "\n";
            break;
          case "dept":
            $tab_sous2[$l_detailencours]["dept"] = $pval;
            $l_sessiondescription .= "- département : $pval";
            $l_sessiondescriptionmail[2] .= " ".str_pad($pval,2,"0",STR_PAD_LEFT);
            $l_sessiondescription .= "\n";
            break;
          case "regime":
            $l_sessiondescription .= "- régime social : ";
            if ($pval == "S") { $l_sessiondescription .= "S.S."; $tab_sous2[$l_detailencours]["regime"] = "S.S."; }
            elseif ($pval == "N") { $l_sessiondescription .= "T.N.S."; $tab_sous2[$l_detailencours]["regime"] = "T.N.S."; }
            else { $l_sessiondescription .= "Agricole"; $tab_sous2[$l_detailencours]["regime"] = "Agricole"; }
            $l_sessiondescription .= "\n";
            break;
            /*
            case "gamme":
            $l_sessiondescription .= "- gamme : ";
            if ($pval == "1") $l_sessiondescription .= "économique";
            elseif ($pval == "2") $l_sessiondescription .= "principale";
            else $l_sessiondescription .= "haut de gamme";
            $l_sessiondescription .= "\n";
            break;
            */
          case "agis":
            $tab_sous2[$l_detailencours]["agis"] = 1;
            $l_sessiondescription .= ($pval == "1") ? "- souscription AGIS\n" : "";
            break;
          case "ad":
            $tab_sous2[$l_detailencours]["ad"] = $pval;
            $l_sessiondescription .= "- ayant droit de adulte n° $pval \n";
            break;
        }
      }
    }

    // ENREGISTREMENT DU CLIENT
    if (!$tab_params["idclient"]){
      $l_sql = "INSERT INTO $table_client SET firstname = '".$tab_params["infosdevis_prenom"]."', lastname = '".$tab_params["infosdevis_nom"]."', email1 = '".$tab_params["infosdevis_email"]."', phone = '".$tab_params["infosdevis_tel"]."', date = '$l_date', idportzone = 1";
      //echo "$l_sql";
      $c_db->query($l_sql);
      $p_idclient = $c_db->get_id();
      $l_sql = "UPDATE $table_visitor SET idclient = '$p_idclient' WHERE idvisitor = '$g_idvisitor'";
      $c_db->query($l_sql);
      $tab_params["idclient"] = $p_idclient;
    }else{
      $l_sql = "UPDATE $table_client SET firstname = '".$tab_params["infosdevis_prenom"]."', lastname = '".$tab_params["infosdevis_nom"]."', email1 = '".$tab_params["infosdevis_email"]."', phone = '".$tab_params["infosdevis_tel"]."', date = '$l_date', idportzone = 1 WHERE idclient = ".$tab_params["idclient"];
      //echo "$l_sql";
      $c_db->query($l_sql);
    }
    $l_sql = "REPLACE INTO $table_email (idegroup,idvisitor,emailkey,email,opt,source,flagpref,date) VALUES ('3','$g_idvisitor','3-".$tab_params["infosdevis_email"]."','".$tab_params["infosdevis_email"]."','IN','CLIENT','".$tab_params["infosdevis_pref"]."','$l_date')";
    //echo "$l_sql";
    $c_db->query($l_sql);

    $tab_sous2[1]["nom"] = $tab_params["infosdevis_nom"];
    $tab_sous2[1]["prenom"] = $tab_params["infosdevis_prenom"];
    $tab_sous2[1]["email"] = $tab_params["infosdevis_email"];
    $tab_sous2[1]["tel"] = $tab_params["infosdevis_tel"];
    $tab_sous2[1]["pref"] = $tab_params["infosdevis_pref"];

    // ENREGISTREMENT DE LA SESSION
    if (!$tab_params["idsession"]){
      $l_sql = "INSERT INTO $table_numsession (idvisitor,date) VALUES ('$g_idvisitor','$l_date')";
      $c_db->query($l_sql);
      $g_numsession = $c_db->get_id();
      $tab_params["idsession"] = $g_numsession;
    }
    $l_sql = "DELETE FROM $table_session WHERE numsession = '".$tab_params["idsession"]."'";
    $c_db->query($l_sql);
    $l_bodyformule = "";
    foreach($tab_lgamme as $lgkey => $lgval){
      $l_sql = "INSERT INTO $table_session (numsession,status,idref,idproduct,productcode,quantity,options,description,priceht,pricettc,purchasepriceht,taxe,currency,idport,portvalue,idsupplier,icon,date) VALUES ('".$tab_params["idsession"]."','2','$p_idref','1','$lgkey','1','";
      if ($tab_devis["formule_ini_".$lgkey] > 0) $l_sql .= "AGIS : ".$tab_devis["formule_ini_".$lgkey]." EUR TTC de souscription à ajouter.";
      $l_sql .= "','$l_sessiondescription','".($tab_devis["formule_".$lgkey] / 1.196)."','".$tab_devis["formule_".$lgkey]."','0','19.60','EUR','0','0','0','','$l_date')";
      $c_db->query($l_sql);
      $l_selectsession = $c_db->get_id();
      $l_bodyformule .= "Formule $lgkey : ".$tab_devis["formule_".$lgkey]." euros / mois";
      if ($tab_devis["formule_ini_".$lgkey] > 0) $l_bodyformule .= "(AGIS : ".$tab_devis["formule_ini_".$lgkey]." EUR TTC à la souscription)";
      $l_bodyformule .= ".\n\n";
    }

    if (!$tab_params["idcommand"]){
      $l_sql = "INSERT INTO $table_command (numsession, status, date) values ('".$tab_params["idsession"]."', '2', '$l_date')";
      $c_db->query($l_sql);
      $g_idcommand = $c_db->get_id();
      $tab_params["idcommand"] = $g_idcommand;
    }

    $l_sql = "UPDATE $table_session SET billdate = '$l_date' WHERE numsession = '".$tab_params["idsession"]."'";
    $c_db->query($l_sql);

    $l_sql = "UPDATE $table_command SET billdate = '$l_date', idclient = '".$tab_params["idclient"]."', status = '2', mode = 'NONE', quantity = 1, priceht = '0', pricettc = '0', pricettcport = '0', currency = 'EUR' WHERE idcommand = '".$tab_params["idcommand"]."'";
    $c_db->query($l_sql);

    // ENVOI DU DEVIS PAR MAIL AU CLIENT

    $l_sql = "SELECT * FROM $table_admsite, $table_admshop";
    $c_db->query($l_sql);
    $adm = $c_db->object_result();

    $l_sql = "SELECT * FROM $table_client WHERE idclient = ".$tab_params["idclient"];
    $c_db->query($l_sql);
    $client = $c_db->object_result();

    $l_header  = "From: ASSURSANTE <$adm->email>\n";
    $l_header .= "Reply-To: $adm->email\n";
    $l_header .= "Errors-To: $adm->email\n";
    $l_header .= "X-Mailer: KerniX WEB OFFICE\n";

    //$l_body  = "Madame, Monsieur,\n\n";
    $l_body  = $tab_params["infosdevis_prenom"]." ".$tab_params["infosdevis_nom"]." (".$tab_params["infosdevis_email"]."),\n\n";
    $l_body .= "Suite a votre demande de devis, veuillez trouver ci-après nos tarifs selon les informations communiquées par vous-même dans votre demande de devis en ligne (".$l_sessiondescriptionmail[0]." ".$l_sessiondescriptionmail[1]." ; dept. :".$l_sessiondescriptionmail[2].") :\n\n";
    $l_body .= "\n\n";
    $l_body .= $l_bodyformule;
    $l_body .= "\n\n";
    $l_body .= "Vous trouverez les garanties correspondantes aux différentes formules proposées à l'adresse suivante : http://www.assursante.fr/index.dyn.php3?p_idref=18 \n\n";
    $l_body .= "Pour souscrire, rien de plus simple, cliquez sur le lien suivant et laissez-vous guider !! \n\n";
    $l_body .= "http://www.assursante.fr/?p_idref=17 \n\n";
    $l_body .= "Nous restons à votre entière disposition au 03 44 48 21 21. pour plus d'informations.\n\n";
    $l_body .= "Cordialement.\n\n";
    $l_body .= "AssurSante\n\n";

    $l_title = "Votre demande de devis en ligne";

    if (($adm->commandwarningflag == 1) && ($g_sendflag == 1)){
      mail($adm->email, $l_title . " - commande n°".$tab_params["idcommand"], $l_body, $l_header);
    }
    if ($g_pubflag == 1) $l_body .= $g_pubmsg;
    if (($g_sendflag == 1) && $client->email1) mail($client->email1, $l_title, $l_body, $l_header);
    $tab_sous = array();
    $tab_sous["idcommand"] = $tab_params["idcommand"];
    $tab_sous["idclient"] = $tab_params["idclient"];
    $tab_sous["idsession"] = $tab_params["idsession"];
    $MYSESSION["params"] = $tab_params;
    $MYSESSION["sous"] = $tab_sous;
    $MYSESSION["sous2"] = $tab_sous2;
  }
  echo "</td></tr>";
  echo "<tr><td align='center'><img src='$g_modulespicturepath/devis/encart_ligne.gif' width='435' height='2'><br/></td></tr>";
}
?>
