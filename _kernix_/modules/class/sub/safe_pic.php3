<?

class pic
{
	var $nb_x;
	var $max_y;
	var $xscale_min;
	var $xscale;
	var $yscale_min;
	var $yscale;
	var $ref_width;
	var $ref_height;
	var $xname;
	var $yname;
	var $pic_width;
	var $pic_height;
	var $path;

	function pic ($title, $pic_width, $pic_height, $xname, $yname, $path) // constructeur
	{
		$this->maintitle = $title;
		$this->pic_width = $pic_width;
		$this->pic_height = $pic_height;
		$this->ref_width = $pic_width - 70;
		$this->ref_height = $pic_height - 100;
		$this->xname = $xname;
		$this->yname = $yname;
		$this->path = $path;
	}

	function x ($x) // fonction de translation sur l'axe des abcisses
	{
		return (32 + ($x * $this->xscale));
	}

	function y ($y) // fonction de translation sur l'axe des ordonnees
	{
		$pos = $this->pic_height - 60;
		$pos -= floor($this->yscale * $y);		
		return ($pos);
	}

	function draw_y ($image, $black, $grey, $light_grey,  $tab) // affiche les infos de l'axe des ordonnees
	{
		//le nom des valeurs
		ImageTTFText ($image, 10, 0, 3, 20, $grey, $this->path, $this->yname);

		//l'origine
		ImageTTFText ($image, 10, 0, 0, $this->y(0) + 3, $black, $this->path, 0);

		$nb_draw = floor($this->ref_height / 30);
		$i = $this->max_y / $nb_draw;
		$stop = $nb_draw * $i;

		// affiche les reperes en fonction de la hauteur de l'axe
		$compt = 0;
		while($i <= $stop)
		{
			$compt++;
imageline($image, $this->x(0) - 5, $this->y($i), $this->x(0), $this->y($i), $black);
imageline($image, $this->x(0) + 1, $this->y($i), $this->pic_width - 30, $this->y($i), $light_grey);
ImageTTFText ($image, 10, 0, 0, $this->y($i) + 3, $black, $this->path, $i);
			$i += $this->max_y / $nb_draw;
			
		}
		if ($compt == 1)
		{
			$i -= $this->max_y / $nb_draw;
imageline($image, $this->x(0) - 5, $this->y($i/2), $this->x(0), $this->y($i/2), $black);
imageline($image, $this->x(0) + 1, $this->y($i/2), $this->pic_width - 30, $this->y($i/2), $light_grey);
ImageTTFText ($image, 10, 0, 0, $this->y($i/2) + 3, $black, $this->path, $i/2);
		}
	}

	function draw_x ($image, $black, $grey, $tab, $title_color) // affiche les infos de l'axe des abcisses
	{
		//affiche le nom de l'abscisse
//		ImageTTFText ($image, 10, 0, $this->pic_width - 25, $this->pic_height - 45, $grey, $this->path, $this->xname);

		//affiche le titre de l'image
		ImageTTFText ($image, 10, 0, floor($this->pic_width / 3), 20, $title_color, $this->path, $this->maintitle);

		for ($i = 1; $i <= $this->nb_x; $i++)
		{
			//affiche les reperes sur l'axe des abscisses
			//	imageline($image, $this->x($i), $this->y(0) + 5, $this->x($i), $this->y(0), $black);
			//affiche les nom des color2 de l'axe des abcisses
			ImageTTFText ($image, 10, -45, $this->x($i) - ($this->xscale / 2), $this->y(0) + 8, $black, $this->path, $tab[$i - 1][0]);
		}
	}

	function draw_histo ($image, $tab, $blue, $black, $shadow_color) //affiche l'histogramme
	{
		for ($i = 0; $i < $this->nb_x; $i++)
		{
			// le cadre du baton
			imagerectangle($image, $this->x($i) + 4, $this->y($tab[$i][1]), $this->x($i + 1) - 4, $this->y(0), $black);
			// colore le baton
			imagefilledrectangle($image, $this->x($i) + 5, $this->y($tab[$i][1]) + 1, $this->x($i + 1) - 5, $this->y(0) - 1, $blue);
			// l'ombre du baton
			imagefilledrectangle($image, $this->x($i + 1) - 4, $this->y($tab[$i][1]) + 6, $this->x($i + 1) - 1, $this->y(0) - 1, $shadow_color);
		}
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
			$this->yscale = $this->ref_height / $this->max_y;
		}
	}

	function draw_pic ($tab)
	{
		// creation de l'image en memoire
		$image = imagecreate($this->pic_width, $this->pic_height);

		// allocation des couleurs
		$white = imagecolorallocate($image, 255, 255, 255);
//		$black = imagecolorallocate($image, 0, 0, 0);		
		$black = imagecolorallocate($image, 50, 58, 77);		
                $grey = imagecolorallocate($image, 84, 96, 117);
		$red = imagecolorallocate($image, 255, 0, 0);
		$blue = imagecolorallocate($image, 199, 205, 209);
		$light_grey = imagecolorallocate($image, 211, 217, 232);
		$title_color = $black;
		$shadow_color = $black;

		// calcul de l'echelle a utiliser pour le repere du graphique
		$this->get_xy($tab);
		$this->calc_scale();

		// affichage du repere
		imageline($image, 30, 30, 30, $this->pic_height - 60, $black);
		imageline($image, 25, $this->pic_height - 60, $this->pic_width - 30, $this->pic_height - 60,$black);

		// affichage des fleches
		imagefilledpolygon($image, array(26, 30, 34, 30, 30, 22), 3, $black);
//		imagefilledpolygon($image, array($this->pic_width - 30,  $this->pic_height - 64, $this->pic_width - 30, $this->pic_height - 56, $this->pic_width - 23,  $this->pic_height - 60), 3, $black);

		// affichage de l'echelle des ordonnees et des abcisses
		$this->draw_y($image, $black, $grey, $light_grey, $tab);
		$this->draw_x($image, $black, $grey, $tab, $title_color);

		// affichage de l'histogram et de l'echelle des abcisses
		$this->draw_histo($image, $tab, $blue, $black, $shadow_color);

		//creation et affichage de l'image finale
		imagegif($image);
	}
}






