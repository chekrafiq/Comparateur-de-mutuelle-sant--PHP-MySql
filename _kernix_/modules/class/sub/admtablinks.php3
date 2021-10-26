<?php

class AdmTabLinks
{
  var $color = "white";
  var $dot   = "<img src=/pictures/adm/point.gif border=0 hspace=2>";
  
  function AdmTabLinks()
    {
    }
  
  function startTab($title)
    {
      print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=93%><tr><td  class=admtablinkstitle>");
      print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
      print("<tr><td class=admtablinkstitle>");
      print("<img src=/pictures/adm/button_title.gif align=absbottom> $title");
      print("</td></tr>");
    }
  
  function addRow($link,$str,$title)
    {
      global $g_kwotarget;
      print("\n<tr><td class=admtablinks onmouseover=\"this.style.background='#C7CBD1'\" onmouseout=\"this.style.background='#D8DBE0'\">&nbsp;");
      if (!empty($g_kwotarget))
	print("<a href=\"$link\" class=leftlinks $g_kwotarget title=\"Ouverture sur l'écran de droite de : $title\">$this->dot</a>");
	else
	  print("$this->dot");
      print("<a href=\"$link\" class=leftlinks title=\"$title\">$str</a>\n");
      print("</td></tr>");
    }
  
  function addRowExt($link,$str,$title)
    {
      print("\n<tr><td class=admtablinks onmouseover=\"this.style.background='#C7CBD1'\" onmouseout=\"this.style.background='#D8DBE0'\">");
      print("$this->dot <a href=\"$link\" target=ext title=\"$title\">\n");
      print("$str</a>");
	       print("</td></tr>");
    }

  function endTab()
    {
      print("</table>");
      print("</td></tr></table>\n");
    }
}


?>
