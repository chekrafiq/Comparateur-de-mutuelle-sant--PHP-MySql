<?php

class Links
{
  var $color = "white";
  var $color1 = "#C8B80A";
  var $color2 = "#DEE6EF";
  
  function Links()
    {
    }
  
  function startTab($title)
    {
      print("\n<table  align=center border=2 background=#52639b borderColor=#000000 borderColorDark=#FFFFFF borderColorLight=#000000 cellPadding=0 cellSpacing=0  width=100%>\n");
      print("<tr>");
	 // print("<td class=titlelinks>\n");
	 //print("&nbsp; $title\n");
	 //print("</td>\n");
       }
     
     function addRow($link,$str)
       {
	 print("<td class=links onmouseover=\"this.style.background='" . $this->color1 . "'\" onmouseout=\"this.style.background='" . $this->color2 . "'\" valign=middle align=center>\n");
	 print("<a href=\"$link\" class=categorylink>");
	 print("$str</a>\n");
	 print("</td>\n");
       }
     
     function addRowExt($link,$str)
       {
	 print("<tr><td class=links onmouseover=\"this.style.background='" . $this->color1 . "'\" onmouseout=\"this.style.background='" . $this->color2 . "'\">\n");
	 print("&nbsp; . &nbsp; <a href=\"$link\" target=ext class=truelink>\n");
	 print("$str</a>\n");
	 print("</td></tr>\n");
       }
     
     function endTab()
       {
	 print("\n</tr></table>");
       }
}


?>
