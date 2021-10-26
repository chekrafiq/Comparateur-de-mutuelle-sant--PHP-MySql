<?php
 
/**
 * Classe cl� RIB
 *
 * Cette classe permet de cr�er des objets de type RIB_FR stockant
 * des num�ro de comptes bancaires fran�ais.
 *
 * Elle propose �galement les outils n�cessaires pour contr�ler
 * la validit� d'un RIB fran�ais sans pour autant cr�er des objets.
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
   * @param string code unique du guichet (agence o� se trouve le compte)
   * @param string num�ro du compte bancaire (peut contenir des lettres)
   * @param string cl� rib
   * @return void
   **/
  public function __construct($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)
  {
    // Contr�le du RIB
    if(true === (self::verifierRIB($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)))
    {
      // Mise � jour des donn�es membres
      $this->_sCodeBanque = $sCodeBanque;
      $this->_sCodeGuichet = $sCodeGuichet;
      $this->_sCleRib = $sCleRib;
      $this->_sNumeroDeCompte = $sNumeroCompte;
    }
    else
    {
      throw new Exception('Le RIB indiqu� n\'est pas un RIB valide fran�ais');
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
   * M�thode __toString() affichant le RIB correctement format�
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string num�ro de compte RIB complet
   **/
  public function __toString() 
  {
    return $this->_sCodeBanque .' '. $this->_sCodeGuichet .' '. $this->_sNumeroDeCompte .' '. $this->_sCleRib;
  }
 
  /**
   * Cette fonction calcule une cl� RIB � partir des informations bancaires
   * La fonction impl�mente l'algorithme de cl� RIB
   * Une cl� RIB n'est valable que si elle se trouve dans l'intervalle 01 - 97
   *
   * @param string code unique de la banque
   * @param string code unique du guichet (agence o� se trouve le compte)
   * @param string num�ro du compte bancaire (peut contenir des lettres)
   * @return string cl� rib calcul�e
   **/
  public static function calculerCleRib($sCodeBanque, $sCodeGuichet, $sNumeroCompte)
  {
    // Variables locales
    $iCleRib = 0;
    $sCleRib = '';
 
    // Calcul de la cl� RIB � partir des informations bancaires
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
   * Cette fonction v�rifie que la cl� RIB se trouve bien dans l'intervalle 01 - 97
   *
   * @author Yves Maistriaud <http://www.expreg.com>
   * @param string cl� rib
   * @return boolean true / false
   **/
  public static function verifierCleRib($sCleRib)
  {
    return preg_match('`^(0[1-9]|[1-8]\d|9[0-7])$`', $sCleRib);
  }
 
  /**
   * Cette fonction v�rifie que le RIB pass� en param�tre
   * est un RIB de compte bancaire fran�ais correct
   *
   * @author Hugo HAMON <webmaster@apprendre-php.com>
   * @param string code unique de la banque
   * @param string code unique du guichet (agence o� se trouve le compte)
   * @param string num�ro du compte bancaire (peut contenir des lettres)
   * @param string cl� rib
   * @return boolean true / false
   **/
  public static function verifierRIB($sCodeBanque, $sCodeGuichet, $sNumeroCompte, $sCleRib)
  {
    // Variables locales
    $bCorrect = false;
 
    // La cl� RIB est-elle syntaxiquement juste ?
    if(self::verifierCleRib($sCleRib))
    {
      // La cl� RIB correspond-elle avec les informations bancaires ?
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
   * Cette fonction retourne la cl� rib
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string cl� rib
   **/
  public function getCleRib()
  {
    return $this->_sCleRib;
  }
 
  /**
   * Cette fonction retourne le num�ro de compte
   *
   * @auhtor Hugo HAMON <webmaster@apprendre-php.com>
   * @param void
   * @return string num�ro de compte
   **/
  public function getNumeroDeCompte()
  {
    return $this->_sNumeroDeCompte;
  }
}
 
?>