<?php
 
/**
 * Classe clé RIB
 *
 * Cette classe permet de créer des objets de type RIB_FR stockant
 * des numéro de comptes bancaires français.
 *
 * Elle propose également les outils nécessaires pour contrôler
 * la validité d'un RIB français sans pour autant créer des objets.
 *
 * @author Hugo HAMON <webmaster@apprendre-php.com>
 * @created 2007-12-14
 * @updated 2008-01-23
 * @version 1.0
 **/
class RIB_FR
{
  /**
   * Attributs
   **/
  private $_sCodeBanque;
  private $_sCodeGuichet;
  private $_sCleRib;
  private $_sNumeroDeCompte;
 
  /**
   * Constructeur de la classe
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param string code unique de la banque
   * @param string code unique du guichet (agence où se trouve le compte)
   * @param string numéro du compte bancaire (peut contenir des lettres)
   * @param string clé rib
   * @return void
   **/
  public function __construct($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)
  {
    // Contrôle du RIB
    if(true === (self::verifierRIB($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)))
    {
      // Mise à jour des données membres
      $this->_sCodeBanque = $sCodeBanque;
      $this->_sCodeGuichet = $sCodeGuichet;
      $this->_sCleRib = $sCleRib;
      $this->_sNumeroDeCompte = $sNumeroCompte;
    }
    else
    {
      throw new Exception('Le RIB indiqué n\'est pas un RIB valide français');
    }
  }
 
  /**
   * Destructeur de la classe
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return void
   **/
  public function __destruct() { }
 
  /**
   * Méthode __toString() affichant le RIB correctement formaté
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string numéro de compte RIB complet
   **/
  public function __toString() 
  {
    return $this->_sCodeBanque .' '. $this->_sCodeGuichet .' '. $this->_sNumeroDeCompte .' '. $this->_sCleRib;
  }
 
  /**
   * Cette fonction calcule une clé RIB à partir des informations bancaires
   * La fonction implémente l'algorithme de clé RIB
   * Une clé RIB n'est valable que si elle se trouve dans l'intervalle 01 - 97
   *
   * @param string code unique de la banque
   * @param string code unique du guichet (agence où se trouve le compte)
   * @param string numéro du compte bancaire (peut contenir des lettres)
   * @return string clé rib calculée
   **/
  public static function calculerCleRib($sCodeBanque, $sCodeGuichet, $sNumeroCompte)
  {
    // Variables locales
    $iCleRib = 0;
    $sCleRib = '';
 
    // Calcul de la clé RIB à partir des informations bancaires
    $sNumeroCompte = strtr(strtoupper($sNumeroCompte), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ','12345678912345678923456789');
      $iCleRib = 97 - (int) fmod (89 * $sCodeBanque  + 15 * $sCodeGuichet + 3  * $sNumeroCompte, 97);
 
    // Valeur de retour
    if($iCleRib<0) 
    {
      $sCleRib = '0'. (string)$iCleRib;
    } else {
      $sCleRib = (string) $iCleRib;
    }
 
    return  $sCleRib;
  }
 
  /**
   * Cette fonction vérifie que la clé RIB se trouve bien dans l'intervalle 01 - 97
   *
   * @author Yves Maistriaud <http://www.expreg.com>
   * @param string clé rib
   * @return boolean true / false
   **/
  public static function verifierCleRib($sCleRib)
  {
    return preg_match('`^(0[1-9]|[1-8]\d|9[0-7])$`', $sCleRib);
  }
 
  /**
   * Cette fonction vérifie que le RIB passé en paramètre
   * est un RIB de compte bancaire français correct
   *
   * @author Hugo HAMON <webmaster@apprendre-php.com>
   * @param string code unique de la banque
   * @param string code unique du guichet (agence où se trouve le compte)
   * @param string numéro du compte bancaire (peut contenir des lettres)
   * @param string clé rib
   * @return boolean true / false
   **/
  public static function verifierRIB($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)
  {
    // Variables locales
    $bCorrect = false;
 
    // La clé RIB est-elle syntaxiquement juste ?
    if(self::verifierCleRib($sCleRib))
    {
      // La clé RIB correspond-elle avec les informations bancaires ?
      if($sCleRib === self::calculerCleRib($sCodeBanque, $sCodeGuichet, $sNumeroCompte))
      {
        $bCorrect = true;
      }
    }
 
    // Valeur de retour
    return $bCorrect;
  }
 
  /**
   * Cette fonction retourne le code banque
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string code banque
   **/
  public function getCodeBanque()
  {
    return $this->_sCodeBanque;
  }
 
 
  /**
   * Cette fonction retourne le code guichet
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string code guichet
   **/
  public function getCodeGuichet()
  {
    return $this->_sCodeGuichet;
  }
 
  /**
   * Cette fonction retourne la clé rib
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string clé rib
   **/
  public function getCleRib()
  {
    return $this->_sCleRib;
  }
 
  /**
   * Cette fonction retourne le numéro de compte
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string numéro de compte
   **/
  public function getNumeroDeCompte()
  {
    return $this->_sNumeroDeCompte;
  }
}
 
?>