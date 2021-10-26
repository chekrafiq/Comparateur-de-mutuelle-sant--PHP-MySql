<?php
if ($p_devissubaction=="next"){
  if ($p_etape==1){
    //echo "traitement etape n°1";
    if ($tab_params["adulte"] != $p_adulte || $tab_params["enfant"] != $p_enfant) $tab_params = array();
    $tab_params["adulte"] = $p_adulte;
    $tab_params["enfant"] = $p_enfant;
    $MYSESSION["params"] = $tab_params;

    $p_etape = 2;
  }elseif ($p_etape==2){
    //echo "traitement etape n°2";

    if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
    else $l_nbadulte = 1;
    for ($i=1;$i<=$l_nbadulte;$i++){
      $tab_params[$i."_sexe"] = ${"p_".$i."_sexe"};
      $tab_params[$i."_age"] = ${"p_".$i."_age"};
      $tab_params[$i."_dept"] = ${"p_".$i."_dept"};
      $tab_params[$i."_regime"] = ${"p_".$i."_regime"};
      if ($i == 1) $tab_params[$i."_scpt"] = $p_1_scpt;
      else $tab_params[$i."_scpt"] = ($p_1_scpt == 1) ? 0 : 1;
      if ($tab_params[$i."_age"] > 65 && $tab_params["enfant"]>0) $l_erreuretape2=1;
      //error_log(var_export($tab_params,TRUE));
    }

    for ($i=1;$i<=$tab_params["enfant"];$i++) $tab_params[($i+10)."_ad"] = ($tab_params["adulte"] == 3) ? ${"p_".($i+10)."_ad"} : 1;

    $MYSESSION["params"] = $tab_params;
    if ($l_erreuretape2==1){
      $p_etape = 2;
    }else{
      $p_etape = 3;
    }
  }elseif ($p_etape==3){
    //echo "traitement etape n°3";

    $l_etape4 = 0;
    if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
    else $l_nbadulte = 1;
    $l_erreur = 0;
    for ($i=1;$i<=$l_nbadulte;$i++){
      //$tab_params[$i."_gamme"] = ${"p_".$i."_gamme"};
      $tab_params[$i."_gamme"] = ${"p_1_gamme"};
      $tab_params[$i."_agis"] = ($tab_params[$i."_regime"] == "N") ? ${"p_".$i."_agis"} : 0;
      //if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3) $l_etape4 = 1;
    }

    $MYSESSION["params"] = $tab_params;
    $p_etape = ($l_etape4 == 1) ? 4 : 5;
    if ($p_idref == 17 && $p_etape == 5) $p_etape = 6;
  }elseif ($p_etape==4){
    //echo "traitement etape n°4";

    if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
    else $l_nbadulte = 1;
    for ($i=1;$i<=$l_nbadulte;$i++){
      if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3){
        $tab_params[$i."_q1"] = ${"p_".$i."_q1"};
        $tab_params[$i."_q2"] = ${"p_".$i."_q2"};
        $tab_params[$i."_q3"] = ${"p_".$i."_q3"};
        $tab_params[$i."_q4"] = ${"p_".$i."_q4"};
        $tab_params[$i."_q5"] = ${"p_".$i."_q5"};
        $tab_params[$i."_q61"] = ${"p_".$i."_q61"};
        $tab_params[$i."_q62"] = ${"p_".$i."_q62"};
        $tab_params[$i."_q7"] = ($tab_params[$i."_sexe"] == "F" && $tab_params[$i."_gamme"] == 3) ? ${"p_".$i."_q7"} : 0;
        $tab_params[$i."_q8"]  = ($tab_params[$i."_gamme"] == 3) ? ${"p_".$i."_q8"} : 0;
      }
    }

    $MYSESSION["params"] = $tab_params;
    $p_etape = 5;
    if ($p_idref == 17) $p_etape = 6;
  }elseif ($p_etape==5){
    if (!empty($p_nom) && !empty($p_prenom) && is_valid_email($p_email) && !empty($p_tel)){
      $tab_params["infosdevis"] = 1;
      $tab_params["infosdevis_nom"] = $p_nom;
      $tab_params["infosdevis_prenom"] = $p_prenom;
      $tab_params["infosdevis_email"] = $p_email;
      $tab_params["infosdevis_tel"] = $p_tel;
      $tab_params["infosdevis_pref"] = $p_pref;
      $p_etape = 6;
    }else{
      $tab_params["infosdevis"] = 2;
      $p_etape = 5;
    }
    $MYSESSION["params"] = $tab_params;
  }elseif ($p_etape==6){
    $MYSESSION["params"] = $tab_params;
    $p_devisaction = "sousetape";
    $p_devissubaction = "next";
    $p_etape = 1;
    include("sous.inc.php3");
    return;
  }else{
    $p_etape = 1;
  }
}

if ($p_devissubaction=="prev"){
  $p_etape--;

  if ($p_etape == 5 && $p_idref == 17) $p_etape--;

  if ($p_etape == 4){
    if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
    else $l_nbadulte = 1;
    //for ($i=1;$i<=$l_nbadulte;$i++) if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3) { $p_etape++; break; }
    $p_etape--;
  }
}
?>
