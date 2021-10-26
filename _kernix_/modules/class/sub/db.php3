<?php

class Db
{
  var $server      = '';
  var $login       = '';
  var $password    = '';
  var $idbdd       = 0;
  var $bdd         = '';
  var $queryresult = '';
  var $sqlquery    = '';
  var $numrows     = 0;
  var $affectrows  = 0;
  var $ERRCON      = 'PB CONNECT';
  var $ERRSELDB    = 'PB SELECT';
  var $ERRQUERY    = 'PB QUERY';

  function Db($l_server = '', $l_login = '', $l_password = '')
  {
    global $g_server, $g_login, $g_password;

    if ($l_server == '')   $l_server = $g_server;
    if ($l_password == '') $l_password = $g_password;
    if ($l_login == '')    $l_login = $g_login;
    $this->server   = $l_server;
    $this->login    = $l_login;
    $this->password = $l_password;
    $this->idbdd    = mysql_connect($this->server, $this->login, $this->password) or print $ERRCON;
    // persistent connexion
    // $this->idbdd = mysql_pconnect($this->server, $this->login, $this->password) or print $ERRCON;
  }

  function open($bdd)
  {
    $this->bdd = $bdd;
    mysql_select_db($this->bdd,$this->idbdd) or print $ERRSELDB;
  }

  function close()
  {
    //	       mysql_free_result($this->queryresult);
    mysql_close($this->idbdd);
  }

  function query($sql) {
    $this->sqlquery = ucfirst(ltrim($sql));
    //echo "$this->sqlquery";
    $this->queryresult = mysql_query($this->sqlquery, $this->idbdd) or print $ERRQUERY;
    if ($this->queryresult) {
      if ($this->sqlquery[0] == "S") $this->numrows = mysql_num_rows($this->queryresult);
      else $this->affectrows = mysql_affected_rows($this->idbdd);
    }
  }

  //--- old
  /*
  function query($sql)
  {
  $this->sqlquery = "$sql";
  //	       mysql_free_result($this->queryresult);
  $this->queryresult = mysql_query($this->sqlquery, $this->idbdd) or print $ERRQUERY;
  if ($this->queryresult > 1): $this->numrows = mysql_num_rows($this->queryresult); endif;
  $this->affectrows = mysql_affected_rows($this->idbdd);
  }
  */
  //---END old

  function dbquery($bdd, $sql)
  {
    mysql_free_result($this->queryresult);
    $this->queryresult = mysql_db_query($bdd, $this->sqlquery, $this->idbdd) or print $ERRQUERY;
    if ($this->queryresult > 1): $this->numrows = mysql_num_rows($this->queryresult); endif;
    $this->affectrows = mysql_affected_rows($this->idbdd);
  }

  function result($row, $elt) {
    return mysql_result($this->queryresult, $row, $elt);
  }

  function object_result()
  {
    if (!($this->numrows > 0) || !($this->queryresult)) return false;
    $row = mysql_fetch_object($this->queryresult);
    return $row;
  }

  function tab_result()
  {
    $row = mysql_fetch_row($this->queryresult);
    return $row;
  }

  function goto_row($row)
  {
    $row--;
    mysql_data_seek($this->queryresult,$row);
  }

  function get_id()
  {
    return (mysql_insert_id($this->idbdd));
  }

  function get_tabcolumns($table)
  {
    $this->sqlquery = "SELECT * FROM $table";
    $this->queryresult = mysql_query($this->sqlquery, $this->idbdd) or print $ERRQUERY;
    $i = 0;
    while ($i < mysql_num_fields ($this->queryresult))
    {
      $meta = mysql_fetch_field ($this->queryresult);
      $tab_columns[$i] = $meta->name;
      $i++;
    }
    return $tab_columns;
  }
  function protect($s) { return mysql_real_escape_string($s); }
}

?>
