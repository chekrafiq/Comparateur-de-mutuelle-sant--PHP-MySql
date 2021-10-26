<?

//v2.5

class pic
{
	var $nb_x;
	var $max_y;
	var $xscale;
	var $yscale;
	var $ref_width;
	var $ref_height;
	var $xname;
	var $yname;
	var $pic_width;
	var $pic_height;
	var $path;
	var $append;
	var $x_translation;
	var $y_translation;
	var $black;
	var $origin;
	var $new_origin;

	function pic ($title, $pic_width, $pic_height, $xname, $yname, $path) // constructeur
	{
		$this->maintitle = $title;
		$this->pic_width = $pic_width;
		$this->pic_height = $pic_height;
		$this->ref_width = $pic_width - 70;
		$this->ref_height = $pic_height - 80;
		$this->xname = $xname;
		$this->yname = $yname;
		$this->path = $path;
		$this->append = 0;
		$this->y_translation = 40;
		$this->x_translation = 21;
		$this->origin = 0;
		$this->new_origin = 0;
      	}

	function x ($x) // fonction de translation sur l'axe des abcisses
	{
		return ($this->x_translation + ($x * $this->xscale));
	}

	function y ($y) // fonction de translation sur l'axe des ordonnees
	{
		$pos = $this->pic_height - $this->y_translation;
		$pos -= floor($this->yscale * $y);		
		return ($pos);
	}

	function set_size ($tab) // affiche les infos de l'axe des abcisses
	{  
	     $old_width = $this->pic_width;
	     $old_height = $this->pic_height;
	     $do_resize = 0;
	     $nb_draw = floor($this->ref_height / 30);
	     if ($nb_draw == 0)
		  $nb_draw = 0.1;
	     $i = $this->max_y / $nb_draw;
	     $stop =  $this->max_y;

             // affiche les reperes en fonction de la hauteur de l'axe
	     $compt = 0;
	     $j = $i;
	     $max_i = 1;
	     while($j <= $stop)
	     {    
		  if ($j != floor($j) && $j < 10)
		       $old_j = sprintf("%01.2f", $j);
		  else
		       $old_j = floor($j);
		  if (strlen ($old_j) > $max_i)
		       $max_i = strlen ($old_j);
		  $j += $this->max_y / $nb_draw;
	     }

	     //determine la largeur d'un caractere dans la font donne dans $this->path
	     $font_width = imagefontwidth($this->path);
	     if ($max_i > 1)
	     {
		  //  $do_resize = 1;
	    	  $this->pic_width += $max_i * ($font_width + 1);
		  $this->x_translation += $max_i * ($font_width + 1) - 10;
	     }

             

	     //on recherche les legendes qui depassent et on choisie une nouvelle taille pour l'image
	     $ytext_pos = $this->y(0) + 8;
	     $max_height = 0;
	     $max_width = 0;
	     for ($a = 1; $a <= $this->nb_x; $a++)
	     {		  
		  //si append a ete activé, on ajoute la valeur au texte de la legende de chaque baton de l'histogramme
		  if ($this->append == 1 && isset($tab[$a - 1][0]))
		       $tab[$a - 1][0] .= " (" . $tab[$a - 1][1] . ")";
		  
		  $text_len = ImageTTFBBox(10, -90, $this->path, $tab[$a - 1][0]);
		  //$text_len = round($text_len * 0.79);
		  
		  $len = round($text_len[5] * 0.79);
		  //cherche le texte le plus long depassant de l'image en hauteur
		  if ($ytext_pos + $len - $this->pic_height > $max_height)
		       $max_height = $ytext_pos + $len - $this->pic_height;

		  //cherche le texte le plus long depassant de l'image en largeur
		  $xtext_pos = $this->x($a) - ($this->xscale / 2);
		  if ($xtext_pos + $len - $this->pic_width > $max_width)
		       $max_width = $xtext_pos + $len - $this->pic_width;
		  
	     }

	     //determine s'il faut redimensionner l'image en hauteur
	     if ($max_height > 25)
	     {
		  //	  $do_resize = 1;
      		  $old_height = $this->pic_height;
		  $this->pic_height += $max_height - 25;
		  $this->y_translation += $max_height - 25;
	     }

	     //determine s'il faut redimensionner l'image en largeur
	     if ($max_width != 0)
	     {
//	          $do_resize = 1;
		  $old_width = $this->pic_width;
		  $this->pic_width += $max_width;
	     }

	     //     if ($do_resize == 1)
	     //  $this->resize_pic (&$image, $old_width, $old_height, 0);
    	}
	
	function draw ($image, $black, $grey, $light_grey, $tab, $title_color)
	{
	     $stop =  $this->max_y;
	     $nb_draw = floor($this->ref_height / 30);
	     
             // affiche les reperes en fonction de la hauteur de l'axe
	     $compt = 0;
	     $j = $i;
	     $max_i = 1;
	     while($j <= $stop)
	     {    
		  if ($j != floor($j) && $j < 10)
		       $old_j = sprintf("%01.2f", $j);
		  else
		       $old_j = floor($j);
		  if (strlen ($old_j) > $max_i)
		       $max_i = strlen ($old_j);
		  $j += $this->max_y / $nb_draw;
	     }
	     
//le nom des valeurs
	     ImageTTFText ($image, 10, 0, 3, 10, $grey, $this->path, $this->yname);
	     
	     //l'origine 
	     ImageTTFText ($image, 10, 0, 0, $this->y(0) + 10, $black, $this->path, $this->origin);
	    
	     //affiche le nom de l'abscisse
//	     ImageTTFText ($image, 10, 0, $this->pic_width - 25, $this->pic_height - 45, $grey, $this->path, $this->xname);
	     
	     //affiche le titre de l'image au milieu
	     $title_len = ImageTTFBBox(10, 0, $this->path, $this->maintitle);
	     $pos = ($this->pic_width / 2) - (($title_len[0] + $title_len[2]) / 2); 
	     ImageTTFText ($image, 10, 0, $pos, 10, $title_color, $this->path, $this->maintitle);

	     //dessine les lignes de reperes
	     while($i <= $stop)
	     {
		  $compt++;
		  imageline($image, $this->x(0) - 5, $this->y($i), $this->x(0), $this->y($i), $black);
		  imageline($image, $this->x(0) + 1, $this->y($i), $this->pic_width - $this->x_translation - 20, $this->y($i), $light_grey);
		  if ($i != floor($i) && $i < 10)
		       $old_i = sprintf("%01.2f", $i + $this->origin);
		  else
		       $old_i = floor($i + $this->origin);
		  if ($this->y($i) + 3 < $this->y(0) - 5)
		       ImageTTFText ($image, 10, 0, 0, $this->y($i) + 3, $black, $this->path, $old_i);
		  $i += $this->max_y / $nb_draw;
	     }
	   
	     //rajoute une ligne de repere si la hauteur du diagramme est petite (afin d'avoir au moins deux transitions)
	     if ($compt == 1)
	     {
		  $i -= $this->max_y / $nb_draw;
		  imageline($image, $this->x(0) - 5, $this->y($i/2), $this->x(0), $this->y($i/2), $black);
		  imageline($image, $this->x(0) + 1, $this->y($i/2), $this->pic_width - 30, $this->y($i/2), $light_grey);
		  ImageTTFText ($image, 10, 0, 0, $this->y($i/2) + 3, $black, $this->path, $i/2);
	     }

	     //affiche les legendes des reperes
	     $ytext_pos = $this->y(0) + 8;
	     for ($i = 1; $i <= $this->nb_x; $i++)
	     {
		  //affiche les reperes sur l'axe des abscisses
		  //	imageline($image, $this->x($i), $this->y(0) + 5, $this->x($i), $this->y(0), $black);
		  
		  //affiche le texte coorespondant
		   ImageTTFText ($image, 10, -45, $this->x($i) - ($this->xscale / 2), $ytext_pos/*$this->y(0) + 8*/, $black, $this->path, $tab[$i - 1][0]);
	     }

	}
	
	function draw_histo ($image, $tab, $blue, $black, $shadow_color) //affiche l'histogramme
	{
		for ($i = 0; $i < $this->nb_x; $i++)
		{
			// le cadre du baton
			imagerectangle($image, $this->x($i) + 4, $this->y($tab[$i][1] - $this->origin), $this->x($i + 1) - 4, $this->y(0), $black);
			// colore le baton
			imagefilledrectangle($image, $this->x($i) + 5, $this->y($tab[$i][1] - $this->origin) + 1, $this->x($i + 1) - 5, $this->y(0) - 1, $blue);
			// l'ombre du baton
			imagefilledrectangle($image, $this->x($i + 1) - 4, $this->y($tab[$i][1] - $this->origin) + 6, $this->x($i + 1) - 1, $this->y(0) - 1, $shadow_color);
		}
	}

	function setappend ()
	{
	     $this->append = 1;
	}

	function setorigin ($start_value)
	{
	     $this->origin = $start_value;
	}

	function get_xy ($tab) //recherche la valeur max en ordonnees et le nombre de color2 en abscisses
	{
		$i = 0;
		$this->nb_x = 0;
		$this->max_y = 0;
		
		while (isset($tab[$i][0]))
		{
			$this->nb_x++;
			if ($tab[$i][1] > $this->max_y)
				$this->max_y = $tab[$i][1];
			$i++;
		}
	}
				
	function calc_scale () //determine les echelles a adopter sur les deux axes
	{
		if ($this->nb_x < 3) //definis un ninimum de 3  
			$this->nb_x = 3;
		if ($this->ref_width < $this->nb_x)
			die ("error, there is too much x values !!");
		else
		{
			$this->xscale = floor($this->ref_width / $this->nb_x);
			$this->yscale = $this->ref_height / ($this->max_y - $this->origin);
		}
	}

	function draw_pic ($tab)
	{ 
             // calcul de l'echelle a utiliser pour le repere du graphique
	     $this->get_xy($tab);
	     $this->calc_scale();
	     
             //rdetermine s'il faut resizer
	     $this->set_size($tab);
	     
             // creation de l'image en memoire
	     $image = imagecreate($this->pic_width, $this->pic_height);
	     
	     
	     // allocation des couleurs
	     $white = imagecolorallocate($image, 255, 255, 255);
	     $black = imagecolorallocate($image, 50, 58, 77);		
	     $grey = imagecolorallocate($image, 84, 96, 117);
	     $red = imagecolorallocate($image, 255, 0, 0);
	     $blue = imagecolorallocate($image, 199, 205, 209);
	     $light_grey = imagecolorallocate($image, 211, 217, 232);
	     $title_color = $black;
	     $shadow_color = $black;
	     
	     
	     // affichage de l'echelle des ordonnees et des abcisses
	     $this->draw(&$image, $black, $grey, $light_grey, $tab, $title_color, $vtranslation);
	     
	     
	     // affichage des fleches d'orientation des axes
	     
	     //en ordonnées
	     imagefilledpolygon($image, array($this->x_translation - 4, 23, $this->x_translation + 4, 23, $this->x_translation, 15), 3, $black);
	     
	     //en abscisses
	     imagefilledpolygon($image, array($this->pic_width - $this->x_translation - 20,  $this->pic_height - $this->y_translation- 4, $this->pic_width - $this->x_translation - 20, $this->pic_height - $this->y_translation+ 4, $this->pic_width - $this->x_translation - 13,  $this->pic_height - $this->y_translation), 3, $black);
	     
	     
	     // affichage du repere
	     imageline($image, $this->x_translation, 20, $this->x_translation, $this->pic_height - $this->y_translation, $black);
	     imageline($image, $this->x_translation - 5, $this->pic_height - $this->y_translation, $this->pic_width - $this->x_translation - 20, $this->pic_height - $this->y_translation,$black);
	     
	     
	     // affichage de l'histogram et de l'echelle des abcisses
	     $this->draw_histo($image, $tab, $blue, $black, $shadow_color);
	     
	     
	     //creation et affichage de l'image finale
	     imagepng($image);
	}
}
?>
