<?
include("_kernix_/var.inc.php3");

header("Content-type: image/png");

include ("$g_classpath/pic.php3");

$x = 300;
$y = 180;
$font = "verdana.ttf";
$title = "KerniX graph";
$abstitle = "x";
$ordtitle = "y";

if (isset($p_code))
{
     include("$g_modulespath/$p_code");
}
else
{
     $l_data[0][0] = "janvier";
     $l_data[0][1] = 20;
     $l_data[1][0] = "fevrier";
     $l_data[1][1] = 100;
     $l_data[2][0] = "mars";
     $l_data[2][1] = 10;
     $l_data[3][0] = "avril";
     $l_data[3][1] = 70;
     $l_data[4][0] = "mai";
     $l_data[4][1] = 110;
     $l_data[5][0] = "juin";
     $l_data[5][1] = 20;
     $l_data[6][0] = "juillet";
     $l_data[6][1] = 40;
     $l_data[7][0] = "aout";
     $l_data[7][1] = 35;
     $l_data[8][0] = "septembre";
     $l_data[8][1] = 120;
     $l_data[9][0] = "octobre";
     $l_data[9][1] = 160;
     $l_data[10][0] = "novembre";
     $l_data[10][1] = 150;
     $l_data[11][0] = "decembre";
     $l_data[11][1] = 140;
}

if (isset($p_x))
{
     $x = $p_x;
}

if (isset($p_y))
{
     $y = $p_y;
}

if (isset($p_font))
{
     $font = $p_font;
}

if (isset($p_title))
{
     $title = $p_title;
}

if (isset($p_abstitle))
{
     $abstitle = $p_abstitle;
}

if (isset($p_ordtitle))
{
     $ordtitle = $p_ordtitle;
}


$pathfont = "$g_absolutepath/_kernix_/opt/font/$font";

$img = new pic($title, $x, $y, $abstitle, $ordtitle, $pathfont);

if (isset($p_append))
{
     $img->setappend();
}

$img->draw_pic($l_data);

?>
