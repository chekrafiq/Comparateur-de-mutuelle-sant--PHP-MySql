<?php

// CLASS KPG : KerniX Pix Generator
// Author    : Fxbois
// Date      : 24/07/2001 - 24/07/2001
// Version   : 0.1


class kpg
{
  //-- GLOBALES
  var $font;
  var $fonth;
  
  //-- CONSTRUCTOR
  function kpg ($pix_title, $pix_width, $pix_height, $x_title, $y_title)
    {
      $this->font  = "$g_absolutepath/_kernix_/opt/font/verdana.ttf";
      $this->fonth = 7;
    }

  function draw($tab)
    {
      
    }
  
  function set_font ($font_name)
    {
      $this->font = "$g_absolutepath/_kernix_/opt/font/" . $font_name;
    }
?>
