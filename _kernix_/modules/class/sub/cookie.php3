<?php

class Cookie
{
  var $cookiename   = "";
  var $cookieval    = "";
  var $cookiestatus = 0;
  var $ttl          = 0;
  var $path         = "/";
  var $timelife     = 7200;
//  var $timelife     = 5;
  
  
  function Cookie ($cname,$cval)
    {
      $this->cookiename = $cname;
      $this->ttl        = time()+ 31536000;
      $this->cookieval  = $cval;
    }

  function put($key,$val)
    {
      if ($this->search($key))
      {
	$this->maj($key,$val);
      }
      else
      {
	$this->add($key,$val);
      }
      $this->cookiestatus = 1;
    }
  
  function rm($key)
    {
      $tab  = explode("&",$this->cookieval);
      $n    = sizeof($tab);
      $sep  = "";
      $this->cookieval = "";
      for ($i=0; $i<$n; $i++)
      {
	list($k,$v) = explode("=",$tab[$i]);
	if ($k != $key)
	{
	  $this->cookieval .= $sep . $tab[$i];	  
	}
	$sep = "&";
      }
      $this->cookiestatus = 1;
    }

  function search($key)
    {
      $tab = $this->make_tab();
      return $tab[$key];
    }
    
  function send()
    {
      if ($this->cookiestatus == 1)
      {
	setcookie($this->cookiename,$this->cookieval,$this->ttl,$this->path);
	//error_log("$this->cookiename,".urldecode($this->cookieval).",$this->ttl,$this->path",0);
      }
    }
  
    function add($key,$val)
    {
      if (!empty($this->cookieval)) $l_sep = "&";
      $this->cookieval .=  $l_sep . $key . "=" . urlencode($val); 
    }
  
  function maj($elt,$eltvalue)
    {
      $mytab_cookie  = explode("&",$this->cookieval);
      $mynumel_mytab = count($mytab_cookie);
      for ($i=0; $i<$mynumel_mytab; $i++)
      {
	$tab_temp = explode("=",$mytab_cookie[$i]);
	if ($tab_temp[0] == $elt)
	{
	  $tab_temp[1] = urlencode($eltvalue);
	}
	$mynewtab_cookie[$i] = implode("=",$tab_temp);
      }
      $this->cookieval = implode("&",$mynewtab_cookie);
    }

  function make_tab()
    {
      $tab = explode("&",$this->cookieval);
      $n = sizeof($tab);
      for ($i=0; $i<$n; $i++)
      {
	$tab_temp              = explode("=",$tab[$i]);
	$tab_out[$tab_temp[0]] = urldecode($tab_temp[1]);
      }
      return $tab_out;
    }
    
  function isExpired($old)
    {
      $diff = time() - $old;
      if ($diff > $this->timelife) return 1;
      else return 0;
    } 

  function setpath($p)
    {
      $this->path = $p;
    }

  function setttl($ttl)
    {
      $this->ttl = $ttl;
    }
}

?>
